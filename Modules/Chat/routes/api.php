<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Chat\app\Http\Controllers\ChatController;
use Modules\Chat\app\Http\Controllers\Admin\AdminChatController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Frontend Chat API Routes
Route::prefix('chat')->name('api.chat.')->group(function () {
    // Public API routes
    Route::post('/guest/create', [ChatController::class, 'store'])->name('guest.create');
    Route::get('/{chat}/messages', [ChatController::class, 'getMessages'])->name('messages');
    Route::post('/{chat}/message', [ChatController::class, 'sendMessage'])->name('send-message');
    
    // Authenticated user routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/my-chats', [ChatController::class, 'index'])->name('my-chats');
        Route::post('/{chat}/resolve', [ChatController::class, 'resolve'])->name('resolve');
    });
    
    // Widget data
    Route::get('/widget-data', [ChatController::class, 'getWidgetData'])->name('widget-data');
});

// Admin Chat API Routes
Route::prefix('admin/chat')->name('api.admin.chat.')->middleware(['auth:sanctum', 'admin'])->group(function () {
    // Chat management
    Route::get('/', [AdminChatController::class, 'index'])->name('index');
    Route::get('/{chat}', [AdminChatController::class, 'show'])->name('show');
    Route::get('/{chat}/messages', [AdminChatController::class, 'getMessages'])->name('messages');
    Route::post('/{chat}/message', [AdminChatController::class, 'sendMessage'])->name('send-message');
    
    // Chat actions
    Route::patch('/{chat}/status', [AdminChatController::class, 'updateStatus'])->name('update-status');
    Route::patch('/{chat}/priority', [AdminChatController::class, 'updatePriority'])->name('update-priority');
    Route::patch('/{chat}/assign', [AdminChatController::class, 'assignToAdmin'])->name('assign');
    Route::delete('/{chat}', [AdminChatController::class, 'destroy'])->name('destroy');
    
    // Bulk actions
    Route::post('/bulk-action', [AdminChatController::class, 'bulkAction'])->name('bulk-action');
    
    // Statistics
    Route::get('/stats/dashboard', function () {
        return response()->json([
            'total_chats' => \Modules\Chat\app\Models\Chat::count(),
            'open_chats' => \Modules\Chat\app\Models\Chat::where('status', 'open')->count(),
            'in_progress_chats' => \Modules\Chat\app\Models\Chat::where('status', 'in_progress')->count(),
            'resolved_chats' => \Modules\Chat\app\Models\Chat::where('status', 'resolved')->count(),
            'unread_messages' => \Modules\Chat\app\Models\ChatMessage::where('sender_type', 'user')
                ->where('is_read', false)->count(),
            'today_chats' => \Modules\Chat\app\Models\Chat::whereDate('created_at', today())->count()
        ]);
    })->name('stats');
    
    // Widget data
    Route::get('/widget-data', [AdminChatController::class, 'getWidgetData'])->name('widget-data');
});