<div id="chat-widget" class="chat-widget" data-is-admin="{{ $isAdmin ? 'true' : 'false' }}">
    <!-- Chat Toggle Button -->
    <div id="chat-toggle" class="chat-toggle" onclick="toggleChatWidget()">
        <i class="fas fa-comments"></i>
        <span id="chat-badge" class="chat-badge" style="display: none;">0</span>
    </div>

    <!-- Chat Widget Panel -->
    <div id="chat-panel" class="chat-panel" style="display: none;">
        <div class="chat-header">
            <h5 class="mb-0">{{ $isAdmin ? 'Chat Management' : 'Support Chat' }}</h5>
            <button type="button" class="btn-close" onclick="toggleChatWidget()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="chat-body">
            @if($isAdmin)
                <!-- Admin Chat Interface -->
                <div id="admin-chat-interface">
                    <!-- Chat List/Selector -->
                    <div class="chat-list-container" id="chat-list-container">
                        <div class="chat-list-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Active Chats</h6>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="refreshChatList()">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                        <div class="chat-list" id="admin-chat-list">
                            <div class="text-center py-3">
                                <i class="fas fa-spinner fa-spin"></i>
                                <p class="mb-0 mt-2">Loading chats...</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Chat Messages Area -->
                    <div class="chat-conversation" id="chat-conversation" style="display: none;">
                        <div class="chat-header d-flex justify-content-between align-items-center">
                            <div class="chat-info">
                                <h6 class="mb-0" id="current-chat-subject">Chat Subject</h6>
                                <small class="text-muted" id="current-chat-user">User Name</small>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="showChatList()">
                                <i class="fas fa-arrow-left"></i>
                            </button>
                        </div>
                        <div class="chat-messages" id="chat-messages">
                            <div class="text-center py-3">
                                <i class="fas fa-spinner fa-spin"></i>
                                <p class="mb-0 mt-2">Loading messages...</p>
                            </div>
                        </div>
                        <div class="chat-input-area">
                            <form id="admin-reply-form" class="d-flex gap-2 mb-2">
                                <input type="text" id="admin-message-input" class="form-control" placeholder="Type your reply..." required>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </form>
                            <div class="d-flex justify-content-center">
                                <button type="button" id="admin-end-chat-btn" class="btn btn-outline-danger btn-sm" onclick="endChat()">
                                    <i class="fas fa-times-circle me-1"></i>End Chat
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- User Chat Interface -->
                <div id="user-chat-interface">
                    <div class="chat-messages" id="chat-messages">
                        <div class="welcome-message">
                            <div class="message admin-message">
                                <div class="message-content">
                                    <p>Hello! How can we help you today?</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-input-area">
                        <form id="user-message-form" class="d-flex gap-2 mb-2">
                            <input type="text" id="user-message-input" class="form-control" placeholder="Type your message..." required>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                        <div class="d-flex justify-content-center">
                            <button type="button" id="user-end-chat-btn" class="btn btn-outline-danger btn-sm" onclick="endChat()">
                                <i class="fas fa-times-circle me-1"></i>End Chat
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.chat-widget {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 9999;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.chat-toggle {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
    position: relative;
}

.chat-toggle:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.2);
}

.chat-toggle i {
    color: white;
    font-size: 24px;
}

.chat-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #ff4757;
    color: white;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
    border: 2px solid white;
}

.chat-panel {
    position: absolute;
    bottom: 80px;
    right: 0;
    width: 350px;
    max-height: 500px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    border: 1px solid #e1e8ed;
    overflow: hidden;
    animation: slideUp 0.3s ease;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.chat-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chat-header h5 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
}

.btn-close {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    padding: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background-color 0.2s;
}

.btn-close:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

.chat-body {
    padding: 0;
    max-height: 400px;
    display: flex;
    flex-direction: column;
}

.chat-messages {
    flex: 1;
    padding: 15px;
    max-height: 300px;
    overflow-y: auto;
    background: #f8f9fa;
}

.message {
    margin-bottom: 15px;
    display: flex;
    flex-direction: column;
}

.user-message {
    align-items: flex-end;
}

.admin-message {
    align-items: flex-start;
}

.message-content {
    max-width: 80%;
    padding: 10px 15px;
    border-radius: 18px;
    word-wrap: break-word;
}

.user-message .message-content {
    background: white;
    color: #333;
    border: 1px solid #e1e8ed;
}

.admin-message .message-content {
    background: white;
    color: #333;
    border: 1px solid #e1e8ed;
}

.sender-name {
    font-size: 11px;
    font-weight: 600;
    color: #666;
    margin-bottom: 4px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.message-time {
    font-size: 11px;
    color: #666;
    margin-top: 5px;
    padding: 0 5px;
}

.chat-input-area {
    padding: 15px;
    border-top: 1px solid #e1e8ed;
    background: white;
}

/* Chat List Styles */
.chat-list-container {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.chat-list-header {
    padding: 15px;
    border-bottom: 1px solid #e9ecef;
    background: #f8f9fa;
}

.chat-list {
    flex: 1;
    overflow-y: auto;
    max-height: 300px;
}

.chat-item {
    padding: 12px 15px;
    border-bottom: 1px solid #e9ecef;
    cursor: pointer;
    transition: background-color 0.2s;
}

.chat-item:hover {
    background-color: #f8f9fa;
}

.chat-item.active {
    background-color: #e3f2fd;
    border-left: 3px solid #2196f3;
}

.chat-item-subject {
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 4px;
    color: #333;
}

.chat-item-user {
    font-size: 12px;
    color: #666;
    margin-bottom: 4px;
}

.chat-item-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 11px;
    color: #999;
}

.chat-item-status {
    padding: 2px 6px;
    border-radius: 10px;
    font-size: 10px;
    font-weight: 500;
}

.chat-item-status.open {
    background-color: #e8f5e8;
    color: #2e7d32;
}

.chat-item-status.in_progress {
    background-color: #fff3e0;
    color: #f57c00;
}

.chat-item-unread {
    background-color: #f44336;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 10px;
    margin-left: auto;
}

.chat-conversation {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.chat-conversation .chat-header {
    padding: 15px;
    border-bottom: 1px solid #e9ecef;
    background: #f8f9fa;
    color: #333;
}

.form-control {
    border-radius: 20px;
    border: 1px solid #e1e8ed;
    padding: 10px 15px;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.chat-status {
    font-size: 11px;
    padding: 2px 8px;
    border-radius: 12px;
    text-transform: uppercase;
    font-weight: 600;
}

.status-open {
    background-color: #e3f2fd;
    color: #1976d2;
}

.status-in_progress {
    background-color: #fff3e0;
    color: #f57c00;
}

.status-resolved {
    background-color: #e8f5e8;
    color: #388e3c;
}

.chat-meta {
    font-size: 12px;
    color: #666;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.unread-count {
    background: #ff4757;
    color: white;
    border-radius: 10px;
    padding: 2px 6px;
    font-size: 11px;
    font-weight: bold;
    min-width: 18px;
    text-align: center;
}

.chat-actions {
    border-top: 1px solid #f1f3f4;
    padding-top: 15px;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.2s;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

.btn-outline-primary {
    border-color: #667eea;
    color: #667eea;
}

.btn-outline-primary:hover {
    background: #667eea;
    border-color: #667eea;
    transform: translateY(-1px);
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .chat-panel {
        width: 300px;
        right: -10px;
    }
    
    .chat-widget {
        bottom: 15px;
        right: 15px;
    }
}

@media (max-width: 480px) {
    .chat-panel {
        width: calc(100vw - 40px);
        right: -10px;
    }
}
</style>

<script>
let chatWidgetOpen = false;
let chatWidgetData = null;
let chatWidgetRefreshInterval = null;
let backgroundPollingInterval = null;

function toggleChatWidget() {
    const panel = document.getElementById('chat-panel');
    const toggle = document.getElementById('chat-toggle');
    
    chatWidgetOpen = !chatWidgetOpen;
    
    if (chatWidgetOpen) {
        panel.style.display = 'block';
        toggle.style.transform = 'rotate(180deg)';
        loadChatWidgetData();
        
        // Start auto-refresh
        if (chatWidgetRefreshInterval) {
            clearInterval(chatWidgetRefreshInterval);
        }
        chatWidgetRefreshInterval = setInterval(loadChatWidgetData, 5000); // Refresh every 5 seconds
    } else {
        panel.style.display = 'none';
        toggle.style.transform = 'rotate(0deg)';
        
        // Stop auto-refresh
        if (chatWidgetRefreshInterval) {
            clearInterval(chatWidgetRefreshInterval);
            chatWidgetRefreshInterval = null;
        }
        
        // Stop message polling
        stopMessagePolling();
    }
}

// Simple chat widget functionality
let currentChatId = null;
let messagePollingInterval = null;
let adminChatList = [];

function loadChatWidgetData() {
    const isAdmin = document.getElementById('chat-widget').dataset.isAdmin === 'true';
    
    if (isAdmin) {
        loadAdminChatList();
    } else {
        loadUserMessages();
    }
}

function startBackgroundPolling() {
    // Poll every 10 seconds for new messages to update notification badge
    backgroundPollingInterval = setInterval(function() {
        if (!chatWidgetOpen) {
            // Only poll when widget is closed to update badge
            loadAdminChatListForBadge();
        }
    }, 10000);
}

function loadAdminChatListForBadge() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    fetch('/admin/chat/list', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        updateChatBadge(data.total_unread || 0);
    })
    .catch(error => {
        console.error('Error loading chat list for badge:', error);
    });
}

function loadAdminChatList() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    fetch('/admin/chat/list', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'same-origin'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            adminChatList = data.chats || [];
            renderAdminChatList();
        } else {
            console.error('Failed to load chat list:', data.message);
        }
        updateChatBadge(data.total_unread || 0);
    })
    .catch(error => {
        console.error('Error loading chat list:', error);
        const container = document.getElementById('admin-chat-list');
        if (container) {
            container.innerHTML = '<div class="text-center py-3"><p class="text-danger">Failed to load chats</p></div>';
        }
    });
}

function renderAdminChatList() {
    const container = document.getElementById('admin-chat-list');
    if (!container) return;
    
    if (adminChatList.length === 0) {
        container.innerHTML = '<div class="text-center py-3"><p class="text-muted">No active chats</p></div>';
        return;
    }
    
    const chatHtml = adminChatList.map(chat => `
        <div class="chat-item" onclick="selectChat(${chat.id})" data-chat-id="${chat.id}">
            <div class="chat-item-subject">${chat.subject || 'General Support'}</div>
            <div class="chat-item-user">${chat.user_name || 'Guest User'}</div>
            <div class="chat-item-meta">
                <span class="chat-item-time">${formatDate(chat.updated_at)}</span>
                <span class="chat-item-status ${chat.status}">${chat.status.replace('_', ' ')}</span>
                ${chat.unread_count > 0 ? `<span class="chat-item-unread">${chat.unread_count}</span>` : ''}
            </div>
        </div>
    `).join('');
    
    container.innerHTML = chatHtml;
}

function selectChat(chatId) {
    currentChatId = chatId;
    const chat = adminChatList.find(c => c.id === chatId);
    
    if (chat) {
        const subjectEl = document.getElementById('current-chat-subject');
        const userEl = document.getElementById('current-chat-user');
        
        if (subjectEl) subjectEl.textContent = chat.subject || 'General Support';
        if (userEl) userEl.textContent = chat.user_name || 'Guest User';
        
        // Hide chat list and show conversation
        const listContainer = document.getElementById('chat-list-container');
        const conversationContainer = document.getElementById('chat-conversation');
        
        if (listContainer) listContainer.style.display = 'none';
        if (conversationContainer) conversationContainer.style.display = 'block';
        
        // Load messages for this chat
        loadChatMessages(chatId);
        
        // Start polling for new messages in this chat
        startMessagePolling(chatId);
    }
}

function showChatList() {
    const conversationContainer = document.getElementById('chat-conversation');
    const listContainer = document.getElementById('chat-list-container');
    
    if (conversationContainer) conversationContainer.style.display = 'none';
    if (listContainer) listContainer.style.display = 'block';
    currentChatId = null;
    
    // Stop message polling
    stopMessagePolling();
    
    // Refresh the chat list
    loadAdminChatList();
}

function refreshChatList() {
    loadAdminChatList();
}

function startMessagePolling(chatId) {
    // Stop any existing polling
    stopMessagePolling();
    
    // Poll every 3 seconds for new messages in the selected chat
    messagePollingInterval = setInterval(function() {
        if (currentChatId === chatId) {
            loadChatMessages(chatId, true); // true = silent update
        }
    }, 3000);
}

function stopMessagePolling() {
    if (messagePollingInterval) {
        clearInterval(messagePollingInterval);
        messagePollingInterval = null;
    }
}

function loadChatMessages(chatId, silent = false) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    fetch(`/admin/chat/${chatId}/messages`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'same-origin'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            renderMessages(data.messages);
        } else {
            console.error('Failed to load messages:', data.message);
        }
    })
    .catch(error => {
        console.error('Error loading chat messages:', error);
    });
}

function loadAdminMessages() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    fetch('/admin/chat/widget-messages', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'same-origin'
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.chat_id) {
                currentChatId = data.chat_id;
                renderMessages(data.messages || []);
                updateChatBadge(data.unread_count || 0);
            } else {
                const container = document.getElementById('chat-messages');
                if (container) {
                    container.innerHTML = '<div class="text-center py-3"><p class="text-muted">No active chats</p></div>';
                }
            }
        })
        .catch(error => {
            console.error('Error loading messages:', error);
            const container = document.getElementById('chat-messages');
            if (container) {
                container.innerHTML = '<div class="text-center py-3"><p class="text-danger">Failed to load messages</p></div>';
            }
        });
}

function loadUserMessages() {
    fetch('/chat/widget-messages')
        .then(response => response.json())
        .then(data => {
            currentChatId = data.chat_id;
            renderMessages(data.messages || []);
            updateChatBadge(data.unread_count || 0);
        })
        .catch(error => {
            console.error('Error loading messages:', error);
            // Keep the welcome message for users
        });
}

function renderMessages(messages) {
    const container = document.getElementById('chat-messages');
    if (!container) return;

    if (messages.length === 0) {
        const isAdmin = document.getElementById('chat-widget').dataset.isAdmin === 'true';
        if (!isAdmin) {
            // Keep welcome message for users
            return;
        } else {
            container.innerHTML = '<div class="text-center py-3"><p class="text-muted">No messages yet</p></div>';
            return;
        }
    }

    const messageHtml = messages.map(message => `
        <div class="message ${message.is_admin ? 'admin-message' : 'user-message'}">
            <div class="message-content">
                <div class="sender-name">${message.sender_name || (message.is_admin ? 'Admin' : 'Guest User')}</div>
                <p>${message.message}</p>
            </div>
            <div class="message-time">${formatDate(message.created_at)}</div>
        </div>
    `).join('');

    container.innerHTML = messageHtml;
    container.scrollTop = container.scrollHeight;
}

function updateChatBadge(count) {
    const badge = document.getElementById('chat-badge');
    if (badge) {
        if (count > 0) {
            badge.textContent = count > 99 ? '99+' : count;
            badge.style.display = 'flex';
        } else {
            badge.style.display = 'none';
        }
    }
}

function sendMessage(form, messageInput) {
    const message = messageInput.value.trim();
    if (!message) return;

    const isAdmin = document.getElementById('chat-widget').dataset.isAdmin === 'true';
    
    // For admin, require a selected chat
    if (isAdmin && !currentChatId) {
        alert('Please select a chat first');
        return;
    }
    
    const endpoint = isAdmin ? '/admin/chat/send-message' : '/chat/send-message';
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    // Immediately display the message in the UI
    displayMessageImmediately(message, isAdmin);
    
    const formData = new FormData();
    formData.append('message', message);
    if (currentChatId) {
        formData.append('chat_id', currentChatId);
    }
    formData.append('_token', csrfToken);

    messageInput.value = '';
    messageInput.disabled = true;

    const fetchOptions = {
        method: 'POST',
        body: formData,
        credentials: 'same-origin'
    };
    
    // Add CSRF token and headers for all requests
    if (csrfToken) {
        fetchOptions.headers = {
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
        };
    }

    fetch(endpoint, fetchOptions)
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            if (!currentChatId) {
                currentChatId = data.chat_id;
            }
            // Reload messages after a short delay to ensure the message is saved
            setTimeout(() => {
                if (isAdmin) {
                    loadChatMessages(currentChatId);
                    loadAdminChatList(); // Refresh chat list to update unread counts
                } else {
                    loadChatWidgetData();
                }
            }, 500);
        } else {
            console.error('Server returned error:', data);
            alert('Failed to send message: ' + (data.message || 'Unknown error'));
            // Reload to remove the optimistically displayed message
            loadChatWidgetData();
        }
    })
    .catch(error => {
        console.error('Error sending message:', error);
        alert('Failed to send message: ' + error.message);
        // Reload to remove the optimistically displayed message
        loadChatWidgetData();
    })
    .finally(() => {
        messageInput.disabled = false;
    });
}

function displayMessageImmediately(message, isAdmin) {
    const container = document.getElementById('chat-messages');
    if (!container) return;
    
    // Remove welcome message if it exists
    const welcomeMsg = container.querySelector('.text-center');
    if (welcomeMsg && welcomeMsg.textContent.includes('Welcome')) {
        welcomeMsg.remove();
    }
    
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${isAdmin ? 'admin-message' : 'user-message'}`;
    const senderName = isAdmin ? 'Admin' : 'Guest User';
    messageDiv.innerHTML = `
        <div class="message-content">
            <div class="sender-name">${senderName}</div>
            <p>${message}</p>
        </div>
        <div class="message-time">${formatDate(new Date().toISOString())}</div>
    `;
    
    container.appendChild(messageDiv);
    container.scrollTop = container.scrollHeight;
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
}



function endChat() {
    if (!confirm('Are you sure you want to end this chat session?')) {
        return;
    }
    
    const chatWidget = document.getElementById('chat-widget');
    const isAdmin = chatWidget ? chatWidget.getAttribute('data-is-admin') === 'true' : false;
    
    // For admin, require a selected chat
    if (isAdmin && !currentChatId) {
        alert('Please select a chat first');
        return;
    }
    
    const endpoint = isAdmin ? '/admin/chat/end-chat' : '/chat/end-chat';
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    const formData = new FormData();
    if (isAdmin && currentChatId) {
        formData.append('chat_id', currentChatId);
    }
    
    const fetchOptions = {
        method: 'POST',
        body: formData,
        credentials: 'same-origin'
    };
    
    // Add CSRF token and headers for all requests
    if (csrfToken) {
        fetchOptions.headers = {
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
        };
    }
    
    fetch(endpoint, fetchOptions)
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (isAdmin) {
                // Go back to chat list and refresh
                showChatList();
            } else {
                // Clear the chat messages
                const messagesContainer = document.getElementById('chat-messages');
                if (messagesContainer) {
                    messagesContainer.innerHTML = '<div class="text-center p-3">Chat session ended</div>';
                }
                
                // Reset current chat ID
                currentChatId = null;
                
                // Close the widget after a short delay
                setTimeout(() => {
                    toggleChatWidget();
                }, 1500);
            }
        } else {
            alert('Failed to end chat session');
        }
    })
    .catch(error => {
        console.error('Error ending chat:', error);
        alert('Failed to end chat session');
    });
}

// Initialize widget data on page load
document.addEventListener('DOMContentLoaded', function() {
    // Load initial data after a short delay
    setTimeout(loadChatWidgetData, 1000);
    
    // Start background polling for admin users to update notification badge
    const isAdmin = document.getElementById('chat-widget').dataset.isAdmin === 'true';
    if (isAdmin) {
        startBackgroundPolling();
    }
    
    // Setup form handlers
    const adminForm = document.getElementById('admin-reply-form');
    const userForm = document.getElementById('user-message-form');
    
    if (adminForm) {
        adminForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const input = document.getElementById('admin-message-input');
            sendMessage(this, input);
        });
    }
    
    if (userForm) {
        userForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const input = document.getElementById('user-message-input');
            sendMessage(this, input);
        });
    }
});

// Close widget when clicking outside
document.addEventListener('click', function(event) {
    const widget = document.getElementById('chat-widget');
    if (chatWidgetOpen && !widget.contains(event.target)) {
        toggleChatWidget();
    }
});
</script>