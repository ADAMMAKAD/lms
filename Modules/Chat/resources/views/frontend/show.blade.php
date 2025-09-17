@extends('frontend.layouts.master')

@section('meta_title', 'Chat: ' . $chat->subject)

@section('contents')
<div class="container py-5" data-chat-id="{{ $chat->id }}">
    <div class="row">
        <div class="col-12">
            <!-- Chat Header -->
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1">{{ $chat->subject }}</h4>
                            <div class="d-flex gap-3 align-items-center">
                                <span class="badge bg-{{ $chat->status_badge }}">{{ ucfirst($chat->status) }}</span>
                                <span class="badge bg-{{ $chat->priority_badge }}">{{ ucfirst($chat->priority) }} Priority</span>
                                @if($chat->admin)
                                    <small class="text-muted">
                                        <i class="fas fa-user-tie me-1"></i>Assigned to: {{ $chat->admin->name }}
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('chat.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>Back to Chats
                            </a>
                            @if($chat->status !== 'resolved')
                                <button type="button" class="btn btn-success btn-sm" onclick="resolveChat()">
                                    <i class="fas fa-check me-1"></i>Mark as Resolved
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chat Messages -->
            <div class="card">
                <div class="card-body p-0">
                    <div id="chat-messages" class="chat-messages" style="height: 500px; overflow-y: auto; padding: 1rem;">
                        @foreach($chat->messages as $message)
                            <div class="message-item mb-3 {{ $message->sender_type === 'admin' ? 'admin-message' : 'user-message' }}">
                                <div class="d-flex {{ $message->sender_type === 'admin' ? '' : 'justify-content-end' }}">
                                    <div class="message-content {{ $message->sender_type === 'admin' ? 'bg-light' : 'bg-primary text-white' }} p-3 rounded" style="max-width: 70%;">
                                        <div class="d-flex align-items-center mb-2">
                                            @if($message->sender_type === 'admin')
                                                <img src="{{ $message->sender_avatar }}" alt="{{ $message->sender_name }}" 
                                                     class="rounded-circle me-2" width="24" height="24">
                                            @endif
                                            <small class="{{ $message->sender_type === 'admin' ? 'text-muted' : 'text-white-50' }}">
                                                <strong>{{ $message->sender_name }}</strong>
                                                <span class="ms-2">{{ $message->created_at->format('M j, Y g:i A') }}</span>
                                            </small>
                                            @if($message->sender_type !== 'admin')
                                                <img src="{{ $message->sender_avatar }}" alt="{{ $message->sender_name }}" 
                                                     class="rounded-circle ms-2" width="24" height="24">
                                            @endif
                                        </div>
                                        <div class="message-text">
                                            {{ $message->message }}
                                        </div>
                                        @if($message->hasAttachment())
                                            <div class="mt-2">
                                                <a href="{{ $message->attachment_url }}" target="_blank" 
                                                   class="{{ $message->sender_type === 'admin' ? 'text-primary' : 'text-white' }}">
                                                    <i class="fas fa-paperclip me-1"></i>{{ $message->attachment_name }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                @if($chat->status !== 'closed')
                    <div class="card-footer">
                        <form id="message-form" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-2">
                                <div class="col">
                                    <textarea id="message-input" class="form-control" rows="2" 
                                              placeholder="Type your message..." maxlength="1000" required></textarea>
                                </div>
                                <div class="col-auto d-flex flex-column gap-1">
                                    <input type="file" id="attachment-input" class="d-none" 
                                           accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" 
                                            onclick="document.getElementById('attachment-input').click()">
                                        <i class="fas fa-paperclip"></i>
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="attachment-preview" class="mt-2 d-none">
                                <small class="text-muted">
                                    <i class="fas fa-paperclip me-1"></i>
                                    <span id="attachment-name"></span>
                                    <button type="button" class="btn btn-link btn-sm p-0 ms-2" onclick="removeAttachment()">
                                        <i class="fas fa-times text-danger"></i>
                                    </button>
                                </small>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="card-footer text-center text-muted">
                        <i class="fas fa-lock me-2"></i>This chat has been closed and no longer accepts new messages.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('modules/chat/js/chat-realtime.js') }}"></script>
<script>
const chatId = document.querySelector('.container').dataset.chatId;
let isSubmitting = false;

// Auto-scroll to bottom
function scrollToBottom() {
    const chatMessages = document.getElementById('chat-messages');
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

// Initial scroll to bottom
scrollToBottom();

// Initialize real-time chat
if (typeof ChatRealtime !== 'undefined') {
    new ChatRealtime(chatId, 'frontend');
}

// Handle message form submission
document.getElementById('message-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (isSubmitting) return;
    
    const messageInput = document.getElementById('message-input');
    const attachmentInput = document.getElementById('attachment-input');
    const message = messageInput.value.trim();
    
    if (!message) {
        alert('Please enter a message');
        return;
    }
    
    isSubmitting = true;
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    submitBtn.disabled = true;
    
    const formData = new FormData();
    formData.append('message', message);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    
    if (attachmentInput.files[0]) {
        formData.append('attachment', attachmentInput.files[0]);
    }
    
    fetch(`/chat/${chatId}/message`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Add message to chat
            addMessageToChat(data.message, 'user');
            
            // Clear form
            messageInput.value = '';
            removeAttachment();
            
            // Scroll to bottom
            scrollToBottom();
        } else {
            alert('Error: ' + (data.message || 'Something went wrong'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while sending the message.');
    })
    .finally(() => {
        isSubmitting = false;
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
});

// Add message to chat UI
function addMessageToChat(message, senderType) {
    const chatMessages = document.getElementById('chat-messages');
    const messageHtml = `
        <div class="message-item mb-3 ${senderType === 'admin' ? 'admin-message' : 'user-message'}">
            <div class="d-flex ${senderType === 'admin' ? '' : 'justify-content-end'}">
                <div class="message-content ${senderType === 'admin' ? 'bg-light' : 'bg-primary text-white'} p-3 rounded" style="max-width: 70%;">
                    <div class="d-flex align-items-center mb-2">
                        ${senderType === 'admin' ? `<img src="${message.sender_avatar}" alt="${message.sender_name}" class="rounded-circle me-2" width="24" height="24">` : ''}
                        <small class="${senderType === 'admin' ? 'text-muted' : 'text-white-50'}">
                            <strong>${message.sender_name}</strong>
                            <span class="ms-2">${new Date(message.created_at).toLocaleString()}</span>
                        </small>
                        ${senderType !== 'admin' ? `<img src="${message.sender_avatar}" alt="${message.sender_name}" class="rounded-circle ms-2" width="24" height="24">` : ''}
                    </div>
                    <div class="message-text">${message.message}</div>
                    ${message.attachment_url ? `
                        <div class="mt-2">
                            <a href="${message.attachment_url}" target="_blank" class="${senderType === 'admin' ? 'text-primary' : 'text-white'}">
                                <i class="fas fa-paperclip me-1"></i>${message.attachment_name}
                            </a>
                        </div>
                    ` : ''}
                </div>
            </div>
        </div>
    `;
    chatMessages.insertAdjacentHTML('beforeend', messageHtml);
}

// Handle attachment selection
document.getElementById('attachment-input').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const maxSize = 5 * 1024 * 1024; // 5MB
        if (file.size > maxSize) {
            alert('File size must be less than 5MB');
            this.value = '';
            return;
        }
        
        document.getElementById('attachment-name').textContent = file.name;
        document.getElementById('attachment-preview').classList.remove('d-none');
    }
});

// Remove attachment
function removeAttachment() {
    document.getElementById('attachment-input').value = '';
    document.getElementById('attachment-preview').classList.add('d-none');
}

// Resolve chat
function resolveChat() {
    if (confirm('Are you sure you want to mark this chat as resolved?')) {
        fetch(`/chat/${chatId}/resolve`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + (data.message || 'Something went wrong'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while resolving the chat.');
        });
    }
}

// Auto-refresh messages every 10 seconds
setInterval(function() {
    fetch(`/chat/${chatId}/messages`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const currentMessages = document.querySelectorAll('.message-item').length;
                if (data.messages.length > currentMessages) {
                    // New messages available, reload to show them
                    location.reload();
                }
            }
        })
        .catch(error => console.error('Error checking for new messages:', error));
}, 10000);
</script>
@endpush