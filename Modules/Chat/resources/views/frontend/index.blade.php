@extends('frontend.layouts.master')

@section('meta_title', 'My Chats')

@section('contents')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">My Chats</h2>
                <a href="{{ route('chat.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Start New Chat
                </a>
            </div>

            @if($chats->count() > 0)
                <div class="row">
                    @foreach($chats as $chat)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 text-truncate" title="{{ $chat->subject }}">
                                        {{ Str::limit($chat->subject, 30) }}
                                    </h6>
                                    <span class="badge bg-{{ $chat->status_badge }}">
                                        {{ ucfirst($chat->status) }}
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <small class="text-muted">
                                            Priority: 
                                            <span class="badge bg-{{ $chat->priority_badge }}">
                                                {{ ucfirst($chat->priority) }}
                                            </span>
                                        </small>
                                        @if($chat->unreadMessagesForUser->count() > 0)
                                            <span class="badge bg-danger rounded-pill">
                                                {{ $chat->unreadMessagesForUser->count() }} new
                                            </span>
                                        @endif
                                    </div>
                                    
                                    @if($chat->messages->first())
                                        <p class="card-text text-muted small mb-2">
                                            {{ Str::limit($chat->messages->first()->message, 80) }}
                                        </p>
                                    @endif
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            @if($chat->last_message_at)
                                                {{ $chat->last_message_at->diffForHumans() }}
                                            @else
                                                {{ $chat->created_at->diffForHumans() }}
                                            @endif
                                        </small>
                                        @if($chat->admin)
                                            <small class="text-success">
                                                <i class="fas fa-user-tie me-1"></i>{{ $chat->admin->name ?? 'Admin' }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('chat.show', $chat->id) }}" class="btn btn-primary btn-sm flex-fill">
                                            <i class="fas fa-comments me-1"></i>View Chat
                                        </a>
                                        @if($chat->status !== 'resolved')
                                            <button type="button" class="btn btn-outline-success btn-sm" 
                                                    data-chat-id="{{ $chat->id }}" onclick="resolveChat(this.dataset.chatId)">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-comments fa-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">No chats yet</h4>
                    <p class="text-muted mb-4">Start a conversation with our support team</p>
                    <a href="{{ route('chat.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Start Your First Chat
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function resolveChat(chatId) {
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
</script>
@endpush