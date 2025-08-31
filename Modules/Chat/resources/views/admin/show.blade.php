@extends('admin.master_layout')

@section('title')
    <title>{{ __('Chat: ') . $chat->subject }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="margin-top: 2rem; padding-left: 30px; padding-right: 30px;">
<div class="container-fluid" data-chat-id="{{ $chat->id }}">
    <!-- Chat Header -->
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h4 class="mb-1">{{ $chat->subject }}</h4>
                    <div class="d-flex gap-3 text-muted small">
                        <span><i class="fas fa-user me-1"></i>{{ $chat->user_name }}</span>
                        <span><i class="fas fa-envelope me-1"></i>{{ $chat->user_email }}</span>
                        <span><i class="fas fa-clock me-1"></i>{{ $chat->created_at->format('M d, Y H:i') }}</span>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.chat.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Back to Chats
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" id="chat-status" data-chat-id="{{ $chat->id }}">
                        <option value="open" {{ $chat->status == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="in_progress" {{ $chat->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="resolved" {{ $chat->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="closed" {{ $chat->status == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Priority</label>
                    <select class="form-select" id="chat-priority" data-chat-id="{{ $chat->id }}">
                        <option value="low" {{ $chat->priority == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ $chat->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ $chat->priority == 'high' ? 'selected' : '' }}>High</option>
                        <option value="urgent" {{ $chat->priority == 'urgent' ? 'selected' : '' }}>Urgent</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Assign to Admin</label>
                    <select class="form-select" id="chat-admin" data-chat-id="{{ $chat->id }}">
                        <option value="">Unassigned</option>
                        @foreach($admins as $admin)
                            <option value="{{ $admin->id }}" {{ $chat->admin_id == $admin->id ? 'selected' : '' }}>
                                {{ $admin->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="button" class="btn btn-danger" onclick="deleteChat()">
                        <i class="fas fa-trash me-1"></i>Delete Chat
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Messages Section -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Messages ({{ $chat->messages->count() }})</h5>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="refreshMessages()">
                        <i class="fas fa-sync-alt me-1"></i>Refresh
                    </button>
                </div>
                <div class="card-body p-0">
                    <div id="messages-container" class="chat-messages" style="height: 500px; overflow-y: auto;">
                        @forelse($chat->messages as $message)
                            <div class="message-item p-3 border-bottom {{ $message->sender_type === 'admin' ? 'admin-message' : 'user-message' }}">
                                <div class="d-flex {{ $message->sender_type === 'admin' ? 'justify-content-end' : 'justify-content-start' }}">
                                    <div class="message-content {{ $message->sender_type === 'admin' ? 'bg-primary text-white' : 'bg-light' }} rounded p-3" style="max-width: 70%;">
                                        <div class="message-header mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <strong class="{{ $message->sender_type === 'admin' ? 'text-white' : 'text-dark' }}">
                                                    @if($message->sender_type === 'admin')
                                                        {{ $message->admin ? $message->admin->name : 'Admin' }}
                                                    @else
                                                        {{ $message->sender_name }}
                                                    @endif
                                                </strong>
                                                <small class="{{ $message->sender_type === 'admin' ? 'text-white-50' : 'text-muted' }}">
                                                    {{ $message->created_at->format('M d, H:i') }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="message-text">
                                            {!! nl2br(e($message->message)) !!}
                                        </div>
                                        @if($message->attachment_path)
                                            <div class="message-attachment mt-2">
                                                <div class="attachment-item p-2 border rounded {{ $message->sender_type === 'admin' ? 'border-light' : 'border-secondary' }}">
                                                    <i class="fas fa-paperclip me-1"></i>
                                                    <a href="{{ Storage::url($message->attachment_path) }}" 
                                                       target="_blank" 
                                                       class="{{ $message->sender_type === 'admin' ? 'text-white' : 'text-primary' }}">
                                                        {{ $message->attachment_name }}
                                                    </a>
                                                    <small class="{{ $message->sender_type === 'admin' ? 'text-white-50' : 'text-muted' }} ms-2">
                                                        ({{ $message->attachment_type }})
                                                    </small>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No messages yet</h5>
                                <p class="text-muted">Be the first to send a message in this chat.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Reply Form -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">Send Reply</h6>
                </div>
                <div class="card-body">
                    <form id="reply-form" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" id="message" class="form-control" rows="4" 
                                      placeholder="Type your reply..." required></textarea>
                            <div class="form-text">Maximum 1000 characters</div>
                        </div>
                        <div class="mb-3">
                            <label for="attachment" class="form-label">Attachment (Optional)</label>
                            <input type="file" name="attachment" id="attachment" class="form-control" 
                                   accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.txt,.zip">
                            <div class="form-text">Max file size: 5MB. Allowed types: images, PDF, documents, text files, ZIP</div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="mark-resolved">
                                <label class="form-check-label" for="mark-resolved">
                                    Mark as resolved after sending
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-1"></i>Send Reply
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Chat Info Sidebar -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Chat Information</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label text-muted">User Details</label>
                        <div class="border rounded p-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-user text-primary me-2"></i>
                                <strong>{{ $chat->user_name }}</strong>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-envelope text-primary me-2"></i>
                                <a href="mailto:{{ $chat->user_email }}">{{ $chat->user_email }}</a>
                            </div>
                            @if($chat->user)
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-id-badge text-primary me-2"></i>
                                    <span>User ID: {{ $chat->user->id }}</span>
                                </div>
                            @else
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-slash text-muted me-2"></i>
                                    <span class="text-muted">Guest User</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Chat Statistics</label>
                        <div class="border rounded p-3">
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="border-end">
                                        <h5 class="mb-0 text-primary">{{ $chat->messages->count() }}</h5>
                                        <small class="text-muted">Messages</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h5 class="mb-0 text-warning">{{ $chat->messages->where('is_read', false)->where('sender_type', '!=', 'admin')->count() }}</h5>
                                    <small class="text-muted">Unread</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Timeline</label>
                        <div class="border rounded p-3">
                            <div class="mb-2">
                                <small class="text-muted">Created:</small>
                                <div>{{ $chat->created_at->format('M d, Y H:i') }}</div>
                            </div>
                            @if($chat->last_message_at)
                                <div class="mb-2">
                                    <small class="text-muted">Last Message:</small>
                                    <div>{{ $chat->last_message_at->format('M d, Y H:i') }}</div>
                                </div>
                            @endif
                            <div>
                                <small class="text-muted">Updated:</small>
                                <div>{{ $chat->updated_at->format('M d, Y H:i') }}</div>
                            </div>
                        </div>
                    </div>

                    @if($chat->messages->where('attachment_path', '!=', null)->count() > 0)
                        <div class="mb-3">
                            <label class="form-label text-muted">Attachments</label>
                            <div class="border rounded p-3">
                                @foreach($chat->messages->where('attachment_path', '!=', null) as $message)
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-paperclip text-primary me-2"></i>
                                        <a href="{{ Storage::url($message->attachment_path) }}" target="_blank" class="text-decoration-none">
                                            {{ Str::limit($message->attachment_name, 25) }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('modules/chat/js/chat-realtime.js') }}"></script>
<script>
const chatId = document.querySelector('.container-fluid').getAttribute('data-chat-id');

// Auto-scroll to bottom of messages
function scrollToBottom() {
    const container = document.getElementById('messages-container');
    container.scrollTop = container.scrollHeight;
}

// Scroll to bottom on page load
document.addEventListener('DOMContentLoaded', function() {
    scrollToBottom();
    markMessagesAsRead();
    
    // Initialize real-time chat
    if (typeof ChatRealtime !== 'undefined') {
        new ChatRealtime(chatId, 'admin');
    }
});

// Handle reply form submission
document.getElementById('reply-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    // Disable submit button
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Sending...';
    
    fetch(`/admin/chat/${chatId}/reply`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Clear form
            document.getElementById('message').value = '';
            document.getElementById('attachment').value = '';
            document.getElementById('mark-resolved').checked = false;
            
            // Refresh messages
            refreshMessages();
            
            // Update status if marked as resolved
            if (document.getElementById('mark-resolved').checked) {
                document.getElementById('chat-status').value = 'resolved';
                updateChatField('status', 'resolved');
            }
        } else {
            alert('Error: ' + (data.message || 'Something went wrong'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while sending the reply.');
    })
    .finally(() => {
        // Re-enable submit button
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    });
});

// Handle status, priority, and admin assignment changes
document.getElementById('chat-status').addEventListener('change', function() {
    updateChatField('status', this.value);
});

document.getElementById('chat-priority').addEventListener('change', function() {
    updateChatField('priority', this.value);
});

document.getElementById('chat-admin').addEventListener('change', function() {
    updateChatField('admin_id', this.value);
});

// Update chat field
function updateChatField(field, value) {
    fetch(`/admin/chat/${chatId}/update`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ [field]: value })
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            alert('Error: ' + (data.message || 'Something went wrong'));
            // Revert the change
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the chat.');
        location.reload();
    });
}

// Refresh messages
function refreshMessages() {
    fetch(`/admin/chat/${chatId}/messages`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update messages container
                updateMessagesContainer(data.messages);
                scrollToBottom();
                markMessagesAsRead();
            }
        })
        .catch(error => {
            console.error('Error refreshing messages:', error);
        });
}

// Update messages container
function updateMessagesContainer(messages) {
    const container = document.getElementById('messages-container');
    
    if (messages.length === 0) {
        container.innerHTML = `
            <div class="text-center py-5">
                <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No messages yet</h5>
                <p class="text-muted">Be the first to send a message in this chat.</p>
            </div>
        `;
        return;
    }
    
    let html = '';
    messages.forEach(message => {
        const isAdmin = message.sender_type === 'admin';
        const alignClass = isAdmin ? 'justify-content-end' : 'justify-content-start';
        const bgClass = isAdmin ? 'bg-primary text-white' : 'bg-light';
        const textClass = isAdmin ? 'text-white' : 'text-dark';
        const mutedClass = isAdmin ? 'text-white-50' : 'text-muted';
        
        html += `
            <div class="message-item p-3 border-bottom ${isAdmin ? 'admin-message' : 'user-message'}">
                <div class="d-flex ${alignClass}">
                    <div class="message-content ${bgClass} rounded p-3" style="max-width: 70%;">
                        <div class="message-header mb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong class="${textClass}">
                                    ${isAdmin ? (message.admin_name || 'Admin') : message.sender_name}
                                </strong>
                                <small class="${mutedClass}">
                                    ${new Date(message.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' })}
                                </small>
                            </div>
                        </div>
                        <div class="message-text">
                            ${message.message.replace(/\n/g, '<br>')}
                        </div>
                        ${message.attachment_path ? `
                            <div class="message-attachment mt-2">
                                <div class="attachment-item p-2 border rounded ${isAdmin ? 'border-light' : 'border-secondary'}">
                                    <i class="fas fa-paperclip me-1"></i>
                                    <a href="/storage/${message.attachment_path}" target="_blank" class="${isAdmin ? 'text-white' : 'text-primary'}">
                                        ${message.attachment_name}
                                    </a>
                                    <small class="${mutedClass} ms-2">
                                        (${message.attachment_type})
                                    </small>
                                </div>
                            </div>
                        ` : ''}
                    </div>
                </div>
            </div>
        `;
    });
    
    container.innerHTML = html;
}

// Mark messages as read
function markMessagesAsRead() {
    fetch(`/admin/chat/${chatId}/mark-read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .catch(error => {
        console.error('Error marking messages as read:', error);
    });
}

// Delete chat
function deleteChat() {
    if (confirm('Are you sure you want to delete this chat? This action cannot be undone.')) {
        fetch(`/admin/chat/${chatId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '/admin/chat';
            } else {
                alert('Error: ' + (data.message || 'Something went wrong'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the chat.');
        });
    }
}

// Auto-refresh messages every 30 seconds
setInterval(refreshMessages, 30000);
</script>
@endpush