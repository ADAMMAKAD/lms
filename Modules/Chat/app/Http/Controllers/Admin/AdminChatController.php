<?php

namespace Modules\Chat\app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Chat\app\Models\Chat;
use Modules\Chat\app\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Admin;

class AdminChatController extends Controller
{
    /**
     * Display chat dashboard for admins
     */
    public function index(Request $request): View
    {
        checkAdminHasPermissionAndThrowException('chat.view');
        
        $query = Chat::with(['user', 'admin', 'latestMessage'])
            ->withCount(['unreadMessagesForAdmin as unread_count']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Filter by assigned admin
        if ($request->filled('admin_id')) {
            $query->where('admin_id', $request->admin_id);
        }

        // Search by subject or user
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('subject', 'like', "%{$search}%")
                  ->orWhere('user_name', 'like', "%{$search}%")
                  ->orWhere('user_email', 'like', "%{$search}%");
            });
        }

        $chats = $query->orderBy('last_message_at', 'desc')
            ->paginate(20)
            ->appends($request->query());

        $admins = Admin::select('id', 'name')->get();
        
        $stats = [
            'total' => Chat::count(),
            'open' => Chat::where('status', 'open')->count(),
            'in_progress' => Chat::where('status', 'in_progress')->count(),
            'resolved' => Chat::where('status', 'resolved')->count(),
            'unread' => ChatMessage::where('sender_type', 'user')
                ->where('is_read', false)->count()
        ];

        return view('chat::admin.index', compact('chats', 'admins', 'stats'));
    }

    /**
     * Show specific chat conversation for admin
     */
    public function show($chatId): View
    {
        checkAdminHasPermissionAndThrowException('chat.view');
        
        $chat = Chat::with(['user', 'admin', 'messages.user', 'messages.admin'])
            ->findOrFail($chatId);
        
        // Mark user messages as read
        $chat->messages()
            ->where('sender_type', 'user')
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);
        
        $admins = Admin::select('id', 'name')->get();
        
        return view('chat::admin.show', compact('chat', 'admins'));
    }

    /**
     * Send admin reply to chat
     */
    public function sendMessage(Request $request, $chatId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:1000',
            'attachment' => 'nullable|file|max:5120|mimes:jpg,jpeg,png,gif,pdf,doc,docx'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $admin = Auth::guard('admin')->user();
        $chat = Chat::findOrFail($chatId);

        // Handle file attachment
        $attachmentPath = null;
        $attachmentName = null;
        $attachmentType = null;
        
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $attachmentPath = $file->storeAs('chat', $filename, 'public');
            $attachmentName = $file->getClientOriginalName();
            $attachmentType = $file->getClientMimeType();
        }

        // Create message
        $message = ChatMessage::create([
            'chat_id' => $chat->id,
            'sender_id' => $admin->id,
            'sender_type' => 'admin',
            'message' => $request->message,
            'attachment_path' => $attachmentPath,
            'attachment_name' => $attachmentName,
            'attachment_type' => $attachmentType
        ]);

        // Update chat
        $chat->update([
            'last_message_at' => now(),
            'admin_id' => $admin->id,
            'status' => $chat->status === 'open' ? 'in_progress' : $chat->status
        ]);

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $message->id,
                'message' => $message->message,
                'sender_name' => $message->sender_name,
                'sender_avatar' => $message->sender_avatar,
                'created_at' => $message->created_at->format('Y-m-d H:i:s'),
                'attachment_url' => $message->attachment_url,
                'attachment_name' => $message->attachment_name
            ]
        ]);
    }

    /**
     * Update chat status
     */
    public function updateStatus(Request $request, $chatId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:open,in_progress,resolved,closed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $chat = Chat::findOrFail($chatId);
        $chat->update([
            'status' => $request->status,
            'is_resolved' => $request->status === 'resolved'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Chat status updated successfully!'
        ]);
    }

    /**
     * Update chat priority
     */
    public function updatePriority(Request $request, $chatId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'priority' => 'required|in:low,medium,high,urgent'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $chat = Chat::findOrFail($chatId);
        $chat->update(['priority' => $request->priority]);

        return response()->json([
            'success' => true,
            'message' => 'Chat priority updated successfully!'
        ]);
    }

    /**
     * Assign chat to admin
     */
    public function assignToAdmin(Request $request, $chatId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'admin_id' => 'required|exists:admins,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $chat = Chat::findOrFail($chatId);
        $chat->update(['admin_id' => $request->admin_id]);

        return response()->json([
            'success' => true,
            'message' => 'Chat assigned successfully!'
        ]);
    }

    /**
     * Get chat messages (AJAX)
     */
    public function getMessages(Request $request, $chatId): JsonResponse
    {
        $chat = Chat::findOrFail($chatId);
        
        $query = $chat->messages()->with(['user', 'admin'])->orderBy('created_at');
        
        // Support for real-time polling - get messages since a specific ID
        if ($request->has('since') && $request->since > 0) {
            $query->where('id', '>', $request->since);
        }
        
        $messages = $query->get();
        
        // Get unread count (messages not read by admin)
        $unreadCount = $chat->messages()
            ->where('sender_type', '!=', 'admin')
            ->where('is_read', false)
            ->count();

        return response()->json([
            'success' => true,
            'messages' => $messages->map(function($message) {
                return [
                    'id' => $message->id,
                    'message' => $message->message,
                    'sender_name' => $message->sender_name,
                    'sender_avatar' => $message->sender_avatar,
                    'sender_type' => $message->sender_type,
                    'created_at' => $message->created_at->toISOString(),
                    'attachment_url' => $message->attachment_url,
                    'attachment_name' => $message->attachment_name,
                    'is_read' => $message->is_read
                ];
            }),
            'unread_count' => $unreadCount
        ]);
    }

    /**
     * Delete chat
     */
    public function destroy($chatId): JsonResponse
    {
        checkAdminHasPermissionAndThrowException('chat.delete');
        
        $chat = Chat::findOrFail($chatId);
        
        // Delete associated files
        $messages = $chat->messages()->whereNotNull('attachment_path')->get();
        foreach ($messages as $message) {
            if ($message->attachment_path && Storage::disk('public')->exists($message->attachment_path)) {
                Storage::disk('public')->delete($message->attachment_path);
            }
        }
        
        $chat->delete();

        return response()->json([
            'success' => true,
            'message' => 'Chat deleted successfully!'
        ]);
    }

    /**
     * Bulk actions for chats
     */
    public function bulkAction(Request $request): JsonResponse
    {
        checkAdminHasPermissionAndThrowException('chat.management');
        
        $validator = Validator::make($request->all(), [
            'action' => 'required|in:delete,assign,update_status,update_priority',
            'chat_ids' => 'required|array',
            'chat_ids.*' => 'exists:chats,id',
            'admin_id' => 'required_if:action,assign|exists:admins,id',
            'status' => 'required_if:action,update_status|in:open,in_progress,resolved,closed',
            'priority' => 'required_if:action,update_priority|in:low,medium,high,urgent'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $chats = Chat::whereIn('id', $request->chat_ids);
        $count = $chats->count();

        switch ($request->action) {
            case 'delete':
                // Delete associated files first
                $messages = ChatMessage::whereIn('chat_id', $request->chat_ids)
                    ->whereNotNull('attachment_path')->get();
                foreach ($messages as $message) {
                    if (Storage::disk('public')->exists($message->attachment_path)) {
                        Storage::disk('public')->delete($message->attachment_path);
                    }
                }
                $chats->delete();
                $message = "{$count} chats deleted successfully!";
                break;
                
            case 'assign':
                $chats->update(['admin_id' => $request->admin_id]);
                $message = "{$count} chats assigned successfully!";
                break;
                
            case 'update_status':
                $chats->update([
                    'status' => $request->status,
                    'is_resolved' => $request->status === 'resolved'
                ]);
                $message = "{$count} chats status updated successfully!";
                break;
                
            case 'update_priority':
                $chats->update(['priority' => $request->priority]);
                $message = "{$count} chats priority updated successfully!";
                break;
        }

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }
     
     /**
      * Get widget messages for admin
      */
     public function getWidgetMessages(): JsonResponse
     {
         // Get the most recent active chat for admin to respond to
         $chat = Chat::with(['user', 'admin'])
             ->where('status', '!=', 'resolved')
             ->whereHas('messages', function($query) {
                 $query->where('sender_type', 'user')
                     ->where('is_read', false);
             })
             ->orderBy('last_message_at', 'desc')
             ->first();
             
         if (!$chat) {
             // If no unread chats, get the most recent active chat
             $chat = Chat::with(['user', 'admin'])
                 ->where('status', '!=', 'resolved')
                 ->orderBy('last_message_at', 'desc')
                 ->first();
         }
         
         if (!$chat) {
             return response()->json([
                 'success' => true,
                 'chat_id' => null,
                 'messages' => [],
                 'unread_count' => 0
             ]);
         }
         
         $messages = $chat->messages()->with(['user', 'admin'])->orderBy('created_at')->get();
         
         // Get unread count for admin
         $unreadCount = $chat->messages()
             ->where('sender_type', 'user')
             ->where('is_read', false)
             ->count();
             
         // Mark user messages as read
         $chat->messages()
             ->where('sender_type', 'user')
             ->where('is_read', false)
             ->update(['is_read' => true, 'read_at' => now()]);
         
         return response()->json([
             'success' => true,
             'chat_id' => $chat->id,
             'messages' => $messages->map(function($message) {
                 return [
                     'id' => $message->id,
                     'message' => $message->message,
                     'is_admin' => $message->sender_type === 'admin',
                     'sender_name' => $message->sender_name,
                     'created_at' => $message->created_at->format('Y-m-d H:i:s')
                 ];
             }),
             'unread_count' => 0 // Reset to 0 since we marked as read
         ]);
     }
     
     /**
      * Send message from admin widget
      */
     public function sendWidgetMessage(Request $request): JsonResponse
     {
         $validator = Validator::make($request->all(), [
             'message' => 'required|string|max:1000',
             'chat_id' => 'required|exists:chats,id'
         ]);
         
         if ($validator->fails()) {
             return response()->json([
                 'success' => false,
                 'errors' => $validator->errors()
             ], 422);
         }
         
         $admin = Auth::guard('admin')->user();
         $chat = Chat::findOrFail($request->chat_id);
         
         // Create message
         $message = ChatMessage::create([
             'chat_id' => $chat->id,
             'sender_id' => $admin->id,
             'sender_type' => 'admin',
             'message' => $request->message
         ]);
         
         // Update chat
         $chat->update([
             'last_message_at' => now(),
             'admin_id' => $admin->id,
             'status' => $chat->status === 'open' ? 'in_progress' : $chat->status
         ]);
         
         return response()->json([
             'success' => true,
             'chat_id' => $chat->id,
             'message' => [
                 'id' => $message->id,
                 'message' => $message->message,
                 'is_admin' => true,
                 'sender_name' => $message->sender_name,
                 'created_at' => $message->created_at->format('Y-m-d H:i:s')
             ]
         ]);
     }
 
     /**
     * Get widget data for admin chat widget
     */
    public function getWidgetData(): JsonResponse
   {
        $chats = Chat::with(['user'])
            ->withCount(['unreadMessagesForAdmin as unread_count'])
            ->where('status', '!=', 'resolved')
            ->orderBy('last_message_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function($chat) {
                return [
                    'id' => $chat->id,
                    'subject' => $chat->subject,
                    'status' => $chat->status,
                    'priority' => $chat->priority,
                    'user_name' => $chat->user_name,
                    'unread_count' => $chat->unread_count,
                    'last_message_at' => $chat->last_message_at ? $chat->last_message_at->diffForHumans() : null
                ];
            });
        
        $unreadCount = ChatMessage::where('sender_type', '!=', 'admin')
            ->where('is_read', false)
            ->count();
        
        return response()->json([
            'success' => true,
            'chats' => $chats,
            'unread_count' => $unreadCount
        ]);
    }

    /**
     * Get chat list for admin widget
     */
    public function getChatList(): JsonResponse
    {
        $chats = Chat::with(['user'])
            ->withCount(['unreadMessagesForAdmin as unread_count'])
            ->where('status', '!=', 'resolved')
            ->orderBy('last_message_at', 'desc')
            ->get()
            ->map(function($chat) {
                return [
                    'id' => $chat->id,
                    'subject' => $chat->subject,
                    'status' => $chat->status,
                    'priority' => $chat->priority,
                    'user_name' => $chat->user_name,
                    'unread_count' => $chat->unread_count,
                    'updated_at' => $chat->last_message_at ? $chat->last_message_at->format('Y-m-d H:i:s') : $chat->updated_at->format('Y-m-d H:i:s')
                ];
            });
        
        $totalUnread = ChatMessage::where('sender_type', '!=', 'admin')
            ->where('is_read', false)
            ->count();
        
        return response()->json([
            'success' => true,
            'chats' => $chats,
            'total_unread' => $totalUnread
        ]);
    }

    /**
     * Get messages for a specific chat
     */
    public function getChatMessages($chatId): JsonResponse
    {
        $chat = Chat::findOrFail($chatId);
        
        $messages = $chat->messages()->with(['user', 'admin'])->orderBy('created_at')->get();
        
        // Mark user messages as read
        $chat->messages()
            ->where('sender_type', 'user')
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);
        
        return response()->json([
            'success' => true,
            'messages' => $messages->map(function($message) {
                return [
                    'id' => $message->id,
                    'message' => $message->message,
                    'is_admin' => $message->sender_type === 'admin',
                    'sender_name' => $message->sender_name,
                    'created_at' => $message->created_at->format('Y-m-d H:i:s')
                ];
            })
        ]);
    }

    /**
     * End a chat session
     */
    public function endChat(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'chat_id' => 'required|exists:chats,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid chat ID'
            ], 400);
        }

        $chat = Chat::find($request->chat_id);
        
        if (!$chat) {
            return response()->json([
                'success' => false,
                'message' => 'Chat not found'
            ], 404);
        }

        // Update chat status to resolved
        $chat->update([
            'status' => 'resolved',
            'resolved_at' => now(),
            'admin_id' => Auth::guard('admin')->id()
        ]);

        // Add a system message indicating the chat was ended
        ChatMessage::create([
            'chat_id' => $chat->id,
            'message' => 'Chat session ended by admin',
            'sender_type' => 'system',
            'sender_name' => 'System',
            'is_read' => true
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Chat session ended successfully'
        ]);
    }
}