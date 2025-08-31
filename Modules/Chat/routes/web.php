<?php

use Illuminate\Support\Facades\Route;
use Modules\Chat\app\Http\Controllers\ChatController;
use Modules\Chat\app\Http\Controllers\Admin\AdminChatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Frontend Chat Routes
Route::prefix('chat')->name('chat.')->group(function () {
    // Widget routes (must come before parameterized routes)
    Route::get('/widget-messages', [ChatController::class, 'getWidgetMessages'])->name('widget-messages');
    Route::post('/send-message', [ChatController::class, 'sendWidgetMessage'])->name('chat.send-widget-message');
    Route::post('/end-chat', [ChatController::class, 'endChat'])->name('end-chat');
    
    // Public routes (for guests)
    Route::get('/', [ChatController::class, 'index'])->name('index');
    Route::get('/create', [ChatController::class, 'create'])->name('create');
    Route::post('/store', [ChatController::class, 'store'])->name('store');
    Route::get('/{chat}', [ChatController::class, 'show'])->name('show');
    
    // AJAX routes
    Route::post('/{chat}/message', [ChatController::class, 'sendMessage'])->name('send-message');
    Route::get('/{chat}/messages', [ChatController::class, 'getMessages'])->name('get-messages');
    Route::post('/{chat}/resolve', [ChatController::class, 'resolve'])->name('resolve');
});

// Admin Chat Routes
Route::prefix('admin/chat')->name('admin.chat.')->middleware(['auth:admin'])->group(function () {
    // Dashboard and management
    Route::get('/', [AdminChatController::class, 'index'])->name('index');
    Route::get('/{chat}', [AdminChatController::class, 'show'])->name('show');
    Route::delete('/{chat}', [AdminChatController::class, 'destroy'])->name('destroy');
    
    // AJAX routes for admin
    Route::post('/{chat}/message', [AdminChatController::class, 'sendMessage'])->name('send-message');
    Route::get('/{chat}/messages', [AdminChatController::class, 'getMessages'])->name('get-messages');
    Route::patch('/{chat}/status', [AdminChatController::class, 'updateStatus'])->name('update-status');
    Route::patch('/{chat}/priority', [AdminChatController::class, 'updatePriority'])->name('update-priority');
    Route::patch('/{chat}/assign', [AdminChatController::class, 'assignToAdmin'])->name('assign');
    
    // Bulk actions
    Route::post('/bulk-action', [AdminChatController::class, 'bulkAction'])->name('bulk-action');
    
    // Widget routes
    Route::get('/widget-messages', [AdminChatController::class, 'getWidgetMessages'])->name('widget-messages');
    Route::post('/send-message', [AdminChatController::class, 'sendWidgetMessage'])->name('admin.chat.send-widget-message');
    Route::post('/end-chat', [AdminChatController::class, 'endChat'])->name('end-chat');
    Route::get('/list', [AdminChatController::class, 'getChatList']);
    Route::get('/{chatId}/messages', [AdminChatController::class, 'getChatMessages']);
});