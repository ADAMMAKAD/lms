@extends('admin.master_layout')

@section('title')
    <title>{{ __('Chat Management') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="margin-top: 2rem; padding-left: 30px; padding-right: 30px;">
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Chat Management</h1>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-outline-secondary" onclick="refreshChats()">
                <i class="fas fa-sync-alt me-1"></i>Refresh
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $stats['total'] }}</h4>
                            <small>Total Chats</small>
                        </div>
                        <i class="fas fa-comments fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $stats['open'] }}</h4>
                            <small>Open</small>
                        </div>
                        <i class="fas fa-envelope-open fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $stats['in_progress'] }}</h4>
                            <small>In Progress</small>
                        </div>
                        <i class="fas fa-clock fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $stats['resolved'] }}</h4>
                            <small>Resolved</small>
                        </div>
                        <i class="fas fa-check-circle fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $stats['unread'] }}</h4>
                            <small>Unread</small>
                        </div>
                        <i class="fas fa-exclamation-circle fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.chat.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="priority" class="form-label">Priority</label>
                    <select name="priority" id="priority" class="form-select">
                        <option value="">All Priorities</option>
                        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                        <option value="urgent" {{ request('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="admin_id" class="form-label">Assigned Admin</label>
                    <select name="admin_id" id="admin_id" class="form-select">
                        <option value="">All Admins</option>
                        @foreach($admins as $admin)
                            <option value="{{ $admin->id }}" {{ request('admin_id') == $admin->id ? 'selected' : '' }}>
                                {{ $admin->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="search" class="form-label">Search</label>
                    <div class="input-group">
                        <input type="text" name="search" id="search" class="form-control" 
                               placeholder="Subject, name, email..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Chats Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Chats ({{ $chats->total() }})</h5>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="bulkAction('delete')" 
                        id="bulk-delete-btn" style="display: none;">
                    <i class="fas fa-trash me-1"></i>Delete Selected
                </button>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" 
                            data-bs-toggle="dropdown" id="bulk-actions-btn" style="display: none;">
                        Bulk Actions
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" onclick="showBulkAssignModal()">Assign to Admin</a></li>
                        <li><a class="dropdown-item" href="#" onclick="showBulkStatusModal()">Update Status</a></li>
                        <li><a class="dropdown-item" href="#" onclick="showBulkPriorityModal()">Update Priority</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            @if($chats->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="40">
                                    <input type="checkbox" id="select-all" class="form-check-input">
                                </th>
                                <th>Subject</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Priority</th>
                                <th>Assigned To</th>
                                <th>Unread</th>
                                <th>Last Message</th>
                                <th width="120">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chats as $chat)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-check-input chat-checkbox" 
                                               value="{{ $chat->id }}">
                                    </td>
                                    <td>
                                        <div>
                                            <strong>{{ Str::limit($chat->subject, 40) }}</strong>
                                            @if($chat->unread_count > 0)
                                                <span class="badge bg-danger ms-1">{{ $chat->unread_count }}</span>
                                            @endif
                                        </div>
                                        <small class="text-muted">Created {{ $chat->created_at->diffForHumans() }}</small>
                                    </td>
                                    <td>
                                        <div>
                                            <strong>{{ $chat->user_name }}</strong>
                                        </div>
                                        <small class="text-muted">{{ $chat->user_email }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $chat->status_badge }}">
                                            {{ ucfirst($chat->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $chat->priority_badge }}">
                                            {{ ucfirst($chat->priority) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($chat->admin)
                                            <small class="text-success">
                                                <i class="fas fa-user-tie me-1"></i>{{ $chat->admin->name }}
                                            </small>
                                        @else
                                            <small class="text-muted">Unassigned</small>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($chat->unread_count > 0)
                                            <span class="badge bg-danger rounded-pill">{{ $chat->unread_count }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($chat->last_message_at)
                                            <small>{{ $chat->last_message_at->diffForHumans() }}</small>
                                        @else
                                            <small class="text-muted">No messages</small>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.chat.show', $chat->id) }}" 
                                               class="btn btn-outline-primary" title="View Chat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger delete-chat-btn" 
                                                    data-chat-id="{{ $chat->id }}" title="Delete Chat">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="card-footer">
                    {{ $chats->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No chats found</h5>
                    <p class="text-muted">No chats match your current filters.</p>
                </div>
            @endif
        </div>
    </div>
</div>
</div>

<!-- Bulk Action Modals -->
@include('chat::admin.modals.bulk-assign')
@include('chat::admin.modals.bulk-status')
@include('chat::admin.modals.bulk-priority')
@endsection

@push('scripts')
<script>
// Select all functionality
document.getElementById('select-all').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.chat-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    toggleBulkActions();
});

// Individual checkbox change
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('chat-checkbox')) {
        toggleBulkActions();
        
        // Update select all checkbox
        const allCheckboxes = document.querySelectorAll('.chat-checkbox');
        const checkedCheckboxes = document.querySelectorAll('.chat-checkbox:checked');
        const selectAllCheckbox = document.getElementById('select-all');
        
        if (checkedCheckboxes.length === 0) {
            selectAllCheckbox.indeterminate = false;
            selectAllCheckbox.checked = false;
        } else if (checkedCheckboxes.length === allCheckboxes.length) {
            selectAllCheckbox.indeterminate = false;
            selectAllCheckbox.checked = true;
        } else {
            selectAllCheckbox.indeterminate = true;
        }
    }
});

// Toggle bulk action buttons
function toggleBulkActions() {
    const checkedCheckboxes = document.querySelectorAll('.chat-checkbox:checked');
    const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
    const bulkActionsBtn = document.getElementById('bulk-actions-btn');
    
    if (checkedCheckboxes.length > 0) {
        bulkDeleteBtn.style.display = 'inline-block';
        bulkActionsBtn.style.display = 'inline-block';
    } else {
        bulkDeleteBtn.style.display = 'none';
        bulkActionsBtn.style.display = 'none';
    }
}

// Delete single chat
function deleteChat(chatId) {
    if (confirm('Are you sure you want to delete this chat? This action cannot be undone.')) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            alert('CSRF token not found. Please refresh the page and try again.');
            return;
        }
        
        fetch(`/admin/chat/${chatId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + (data.message || 'Something went wrong'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the chat: ' + error.message);
        });
    }
}

// Handle delete button clicks
document.addEventListener('click', function(e) {
    if (e.target.closest('.delete-chat-btn')) {
        const chatId = e.target.closest('.delete-chat-btn').getAttribute('data-chat-id');
        deleteChat(chatId);
    }
});

// Bulk delete
function bulkAction(action) {
    const checkedCheckboxes = document.querySelectorAll('.chat-checkbox:checked');
    const chatIds = Array.from(checkedCheckboxes).map(cb => cb.value);
    
    if (chatIds.length === 0) {
        alert('Please select at least one chat.');
        return;
    }
    
    if (action === 'delete') {
        if (confirm(`Are you sure you want to delete ${chatIds.length} chat(s)? This action cannot be undone.`)) {
            performBulkAction('delete', { chat_ids: chatIds });
        }
    }
}

// Perform bulk action
function performBulkAction(action, data) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        alert('CSRF token not found. Please refresh the page and try again.');
        return;
    }
    
    fetch('/admin/chat/bulk-action', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({ action: action, ...data })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error: ' + (data.message || 'Something went wrong'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while performing the bulk action: ' + error.message);
    });
}

// Refresh chats
function refreshChats() {
    location.reload();
}

// Show bulk action modals (these functions will be implemented with the modal files)
function showBulkAssignModal() {
    // Implementation will be added with modal
}

function showBulkStatusModal() {
    // Implementation will be added with modal
}

function showBulkPriorityModal() {
    // Implementation will be added with modal
}
</script>
@endpush