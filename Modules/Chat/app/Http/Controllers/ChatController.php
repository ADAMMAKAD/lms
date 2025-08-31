<?php

namespace Modules\Chat\app\Http\Controllers;

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

class ChatController extends Controller
{
    /**
     * Display chat interface for users
     */
    public function index(): View
    {
        $user = Auth::user();
        $chats = collect();
        
        if ($user) {
            $chats = Chat::where('user_id', $user->id)
                ->with(['messages' => function($query) {
                    $query->latest()->limit(1);
                }])
                ->orderBy('last_message_at', 'desc')
                ->get();
        }
        
        return view('chat::frontend.index', compact('chats'));
    }

    /**
     * Show specific chat conversation
     */
    public function show($chatId): View
    {
        $user = Auth::user();
        
        $chat = Chat::with(['messages.user', 'messages.admin'])
            ->where('id', $chatId)
            ->when($user, function($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
            ->firstOrFail();
        
        // Mark admin messages as read
        $chat->messages()
            ->where('sender_type', 'admin')
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);
        
        return view('chat::frontend.show', compact('chat'));
    }

    /**
     * Create a new chat (for guests and users)
     */
    public function create(): View
    {
        return view('chat::frontend.create');
    }

    /**
     * Store a new chat
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'name' => 'required_without:user_id|string|max:255',
            'email' => 'required_without:user_id|email|max:255',
            'priority' => 'in:low,medium,high,urgent',
            'attachment' => 'nullable|file|max:5120|mimes:jpg,jpeg,png,gif,pdf,doc,docx'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        
        // Create chat
        $chat = Chat::create([
            'user_id' => $user ? $user->id : null,
            'subject' => $request->subject,
            'priority' => $request->priority ?? 'medium',
            'user_name' => $user ? $user->name : $request->name,
            'user_email' => $user ? $user->email : $request->email,
            'last_message_at' => now()
        ]);

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

        // Create first message
        ChatMessage::create([
            'chat_id' => $chat->id,
            'sender_id' => $user ? $user->id : null,
            'sender_type' => $user ? 'user' : 'guest',
            'message' => $request->message,
            'attachment_path' => $attachmentPath,
            'attachment_name' => $attachmentName,
            'attachment_type' => $attachmentType
        ]);

        return redirect()->route('chat.show', $chat->id)
            ->with('success', 'Your message has been sent successfully!');
    }

    /**
     * Send a new message to existing chat
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

        $user = Auth::user();
        
        $chat = Chat::where('id', $chatId)
            ->when($user, function($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
            ->firstOrFail();

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
            'sender_id' => $user ? $user->id : null,
            'sender_type' => $user ? 'user' : 'guest',
            'message' => $request->message,
            'attachment_path' => $attachmentPath,
            'attachment_name' => $attachmentName,
            'attachment_type' => $attachmentType
        ]);

        // Update chat last message time and reopen if resolved
        $chat->update([
            'last_message_at' => now(),
            'status' => $chat->status === 'resolved' ? 'open' : $chat->status
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
     * Get messages for a chat (AJAX)
     */
    public function getMessages(Request $request, $chatId): JsonResponse
    {
        $user = Auth::user();
        
        $chat = Chat::where('id', $chatId)
            ->when($user, function($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
            ->firstOrFail();

        $query = $chat->messages()->with(['user', 'admin'])->orderBy('created_at');
        
        // Support for real-time polling - get messages since a specific ID
        if ($request->has('since') && $request->since > 0) {
            $query->where('id', '>', $request->since);
        }
        
        $messages = $query->get();
        
        // Get unread count for current user
        $unreadCount = $chat->messages()
            ->where('sender_type', '!=', $user ? 'user' : 'guest')
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
                    'created_at' => $message->created_at->format('Y-m-d H:i:s'),
                    'attachment_url' => $message->attachment_url,
                    'attachment_name' => $message->attachment_name,
                    'is_read' => $message->is_read
                ];
            }),
            'unread_count' => $unreadCount
        ]);
    }

    /**
     * Get widget messages for current user
     */
    public function getWidgetMessages(): JsonResponse
    {
        $user = Auth::user();
        
        // Get or create user's active chat
        $chat = null;
        if ($user) {
            $chat = Chat::where('user_id', $user->id)
                ->where('status', '!=', 'resolved')
                ->orderBy('last_message_at', 'desc')
                ->first();
        } else {
            // For guest users, try to get chat from session
            $sessionChatId = session('guest_chat_id');
            if ($sessionChatId) {
                $chat = Chat::where('id', $sessionChatId)
                    ->where('status', '!=', 'resolved')
                    ->first();
            }
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
        
        // Get unread count for current user
        $unreadCount = $chat->messages()
            ->where('sender_type', 'admin')
            ->where('is_read', false)
            ->count();
            
        // Mark admin messages as read
        $chat->messages()
            ->where('sender_type', 'admin')
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
     * Send message from widget
     */
    public function sendWidgetMessage(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:1000',
            'chat_id' => 'nullable|exists:chats,id'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        
        $user = Auth::user();
        $chat = null;
        
        if ($request->chat_id) {
            $chat = Chat::find($request->chat_id);
        }
        
        // Create new chat if none exists
        if (!$chat) {
            $chat = Chat::create([
                'user_id' => $user ? $user->id : null,
                'user_name' => $user ? $user->name : 'Guest',
                'user_email' => $user ? $user->email : null,
                'subject' => 'Support Chat',
                'status' => 'open',
                'priority' => 'medium',
                'last_message_at' => now()
            ]);
            
            // Store chat ID in session for guest users
            if (!$user) {
                session(['guest_chat_id' => $chat->id]);
            }
        }
        
        // Create message
        $message = ChatMessage::create([
            'chat_id' => $chat->id,
            'sender_id' => $user ? $user->id : null,
            'sender_type' => $user ? 'user' : 'guest',
            'message' => $request->message
        ]);
        
        // Update chat
        $chat->update([
            'last_message_at' => now(),
            'status' => $chat->status === 'resolved' ? 'open' : $chat->status
        ]);
        
        return response()->json([
            'success' => true,
            'chat_id' => $chat->id,
            'message' => [
                'id' => $message->id,
                'message' => $message->message,
                'is_admin' => false,
                'sender_name' => $message->sender_name,
                'created_at' => $message->created_at->format('Y-m-d H:i:s')
            ]
        ]);
    }

    /**
     * Mark chat as resolved by user
     */
    public function resolve($chatId): JsonResponse
    {
        $user = Auth::user();
        
        $chat = Chat::where('id', $chatId)
            ->when($user, function($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
            ->firstOrFail();

        $chat->markAsResolved();

        return response()->json([
            'success' => true,
            'message' => 'Chat resolved successfully!'
        ]);
    }

    /**
     * End a chat session for users
     */
    public function endChat(): JsonResponse
    {
        $user = Auth::user();
        
        // Get user's active chat
        $chat = null;
        if ($user) {
            $chat = Chat::where('user_id', $user->id)
                ->where('status', '!=', 'resolved')
                ->orderBy('last_message_at', 'desc')
                ->first();
        } else {
            // For guest users, try to get chat from session
            $sessionChatId = session('guest_chat_id');
            if ($sessionChatId) {
                $chat = Chat::where('id', $sessionChatId)
                    ->where('status', '!=', 'resolved')
                    ->first();
            }
        }
        
        if (!$chat) {
            return response()->json([
                'success' => false,
                'message' => 'No active chat found'
            ], 404);
        }

        // Update chat status to resolved
        $chat->update([
            'status' => 'resolved',
            'resolved_at' => now()
        ]);

        // Add a system message indicating the chat was ended
        ChatMessage::create([
            'chat_id' => $chat->id,
            'message' => 'Chat session ended by user',
            'sender_type' => 'system',
            'sender_name' => 'System',
            'is_read' => true
        ]);

        // Clear guest chat session if applicable
        if (!$user) {
            session()->forget('guest_chat_id');
        }

        return response()->json([
            'success' => true,
            'message' => 'Chat session ended successfully'
        ]);
    }

    /**
     * Get widget data for chat widget
     */
    public function getWidgetData(): JsonResponse
    {
        $user = Auth::user();
        $chats = collect();
        $unreadCount = 0;
        
        if ($user) {
            $chats = Chat::where('user_id', $user->id)
                ->with(['admin'])
                ->withCount(['unreadMessagesForUser as unread_count'])
                ->orderBy('last_message_at', 'desc')
                ->limit(5)
                ->get()
                ->map(function($chat) {
                    return [
                        'id' => $chat->id,
                        'subject' => $chat->subject,
                        'status' => $chat->status,
                        'priority' => $chat->priority,
                        'admin_name' => $chat->admin ? $chat->admin->name : null,
                        'unread_count' => $chat->unread_count,
                        'last_message_at' => $chat->last_message_at ? $chat->last_message_at->diffForHumans() : null
                    ];
                });
            
            $unreadCount = ChatMessage::whereIn('chat_id', Chat::where('user_id', $user->id)->pluck('id'))
                ->where('sender_type', 'admin')
                ->where('is_read', false)
                ->count();
        }
        
        return response()->json([
            'success' => true,
            'chats' => $chats,
            'unread_count' => $unreadCount
        ]);
    }
}