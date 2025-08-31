/**
 * Real-time Chat Functionality
 * Handles real-time updates for chat messages using polling
 */

class ChatRealtime {
    constructor(options = {}) {
        this.chatId = options.chatId;
        this.isAdmin = options.isAdmin || false;
        this.pollInterval = options.pollInterval || 5000; // 5 seconds
        this.lastMessageId = options.lastMessageId || 0;
        this.isPolling = false;
        this.pollTimer = null;
        this.messagesContainer = options.messagesContainer || '#messages-container';
        this.unreadCountElement = options.unreadCountElement || '.unread-count';
        
        this.init();
    }
    
    init() {
        // Start polling when page is visible
        this.startPolling();
        
        // Handle page visibility changes
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                this.stopPolling();
            } else {
                this.startPolling();
            }
        });
        
        // Stop polling when page is unloaded
        window.addEventListener('beforeunload', () => {
            this.stopPolling();
        });
        
        // Handle focus/blur events
        window.addEventListener('focus', () => {
            this.markMessagesAsRead();
        });
    }
    
    startPolling() {
        if (this.isPolling || !this.chatId) return;
        
        this.isPolling = true;
        this.poll();
        
        this.pollTimer = setInterval(() => {
            this.poll();
        }, this.pollInterval);
    }
    
    stopPolling() {
        this.isPolling = false;
        if (this.pollTimer) {
            clearInterval(this.pollTimer);
            this.pollTimer = null;
        }
    }
    
    async poll() {
        if (!this.isPolling) return;
        
        try {
            const endpoint = this.isAdmin 
                ? `/admin/chat/${this.chatId}/messages?since=${this.lastMessageId}`
                : `/chat/${this.chatId}/messages?since=${this.lastMessageId}`;
                
            const response = await fetch(endpoint, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
            
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }
            
            const data = await response.json();
            
            if (data.success && data.messages && data.messages.length > 0) {
                this.handleNewMessages(data.messages);
                this.updateUnreadCount(data.unread_count);
            }
        } catch (error) {
            console.error('Polling error:', error);
            // Reduce polling frequency on error
            this.pollInterval = Math.min(this.pollInterval * 1.5, 30000);
        }
    }
    
    handleNewMessages(messages) {
        const container = document.querySelector(this.messagesContainer);
        if (!container) return;
        
        messages.forEach(message => {
            this.appendMessage(message);
            this.lastMessageId = Math.max(this.lastMessageId, message.id);
        });
        
        // Scroll to bottom if user is near bottom
        this.scrollToBottomIfNeeded(container);
        
        // Play notification sound for new messages (if not from current user)
        if (!this.isCurrentUserMessage(messages[messages.length - 1])) {
            this.playNotificationSound();
            this.showDesktopNotification(messages[messages.length - 1]);
        }
        
        // Mark messages as read if window is focused
        if (!document.hidden) {
            setTimeout(() => this.markMessagesAsRead(), 1000);
        }
    }
    
    appendMessage(message) {
        const container = document.querySelector(this.messagesContainer);
        if (!container) return;
        
        const messageElement = this.createMessageElement(message);
        
        // Check if message already exists
        const existingMessage = container.querySelector(`[data-message-id="${message.id}"]`);
        if (existingMessage) return;
        
        // Remove "no messages" placeholder if exists
        const placeholder = container.querySelector('.text-center.py-5');
        if (placeholder) {
            placeholder.remove();
        }
        
        container.appendChild(messageElement);
    }
    
    createMessageElement(message) {
        const isAdmin = message.sender_type === 'admin';
        const isCurrentUser = this.isCurrentUserMessage(message);
        
        const messageDiv = document.createElement('div');
        messageDiv.className = `message-item p-3 border-bottom ${isAdmin ? 'admin-message' : 'user-message'}`;
        messageDiv.setAttribute('data-message-id', message.id);
        
        const alignClass = isAdmin ? 'justify-content-end' : 'justify-content-start';
        const bgClass = isAdmin ? 'bg-primary text-white' : 'bg-light';
        const textClass = isAdmin ? 'text-white' : 'text-dark';
        const mutedClass = isAdmin ? 'text-white-50' : 'text-muted';
        
        messageDiv.innerHTML = `
            <div class="d-flex ${alignClass}">
                <div class="message-content ${bgClass} rounded p-3" style="max-width: 70%;">
                    <div class="message-header mb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong class="${textClass}">
                                ${isAdmin ? (message.admin_name || 'Admin') : message.sender_name}
                            </strong>
                            <small class="${mutedClass}">
                                ${this.formatMessageTime(message.created_at)}
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
        `;
        
        return messageDiv;
    }
    
    isCurrentUserMessage(message) {
        if (this.isAdmin) {
            return message.sender_type === 'admin';
        } else {
            return message.sender_type !== 'admin';
        }
    }
    
    scrollToBottomIfNeeded(container) {
        const threshold = 100; // pixels from bottom
        const isNearBottom = container.scrollTop + container.clientHeight >= container.scrollHeight - threshold;
        
        if (isNearBottom) {
            container.scrollTop = container.scrollHeight;
        }
    }
    
    updateUnreadCount(count) {
        const elements = document.querySelectorAll(this.unreadCountElement);
        elements.forEach(element => {
            if (count > 0) {
                element.textContent = count;
                element.style.display = 'inline';
            } else {
                element.style.display = 'none';
            }
        });
        
        // Update page title
        this.updatePageTitle(count);
    }
    
    updatePageTitle(unreadCount) {
        const originalTitle = document.title.replace(/^\(\d+\) /, '');
        document.title = unreadCount > 0 ? `(${unreadCount}) ${originalTitle}` : originalTitle;
    }
    
    async markMessagesAsRead() {
        if (!this.chatId) return;
        
        try {
            const endpoint = this.isAdmin 
                ? `/admin/chat/${this.chatId}/mark-read`
                : `/chat/${this.chatId}/mark-read`;
                
            await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
        } catch (error) {
            console.error('Error marking messages as read:', error);
        }
    }
    
    playNotificationSound() {
        // Create and play a subtle notification sound
        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
        const oscillator = audioContext.createOscillator();
        const gainNode = audioContext.createGain();
        
        oscillator.connect(gainNode);
        gainNode.connect(audioContext.destination);
        
        oscillator.frequency.setValueAtTime(800, audioContext.currentTime);
        oscillator.frequency.setValueAtTime(600, audioContext.currentTime + 0.1);
        
        gainNode.gain.setValueAtTime(0, audioContext.currentTime);
        gainNode.gain.linearRampToValueAtTime(0.1, audioContext.currentTime + 0.01);
        gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.2);
        
        oscillator.start(audioContext.currentTime);
        oscillator.stop(audioContext.currentTime + 0.2);
    }
    
    showDesktopNotification(message) {
        if (!('Notification' in window)) return;
        
        if (Notification.permission === 'granted') {
            const notification = new Notification('New Chat Message', {
                body: `${message.sender_name}: ${message.message.substring(0, 100)}${message.message.length > 100 ? '...' : ''}`,
                icon: '/favicon.ico',
                tag: `chat-${this.chatId}`,
                requireInteraction: false
            });
            
            setTimeout(() => notification.close(), 5000);
        } else if (Notification.permission !== 'denied') {
            Notification.requestPermission();
        }
    }
    
    formatMessageTime(timestamp) {
        const date = new Date(timestamp);
        const now = new Date();
        const diffInHours = (now - date) / (1000 * 60 * 60);
        
        if (diffInHours < 24) {
            return date.toLocaleTimeString('en-US', { 
                hour: '2-digit', 
                minute: '2-digit' 
            });
        } else {
            return date.toLocaleDateString('en-US', { 
                month: 'short', 
                day: 'numeric',
                hour: '2-digit', 
                minute: '2-digit' 
            });
        }
    }
    
    // Public methods
    updateLastMessageId(messageId) {
        this.lastMessageId = Math.max(this.lastMessageId, messageId);
    }
    
    setPollInterval(interval) {
        this.pollInterval = interval;
        if (this.isPolling) {
            this.stopPolling();
            this.startPolling();
        }
    }
    
    destroy() {
        this.stopPolling();
        document.removeEventListener('visibilitychange', this.handleVisibilityChange);
        window.removeEventListener('beforeunload', this.handleBeforeUnload);
        window.removeEventListener('focus', this.handleFocus);
    }
}

// Export for use in other scripts
window.ChatRealtime = ChatRealtime;

// Auto-initialize for chat pages
document.addEventListener('DOMContentLoaded', function() {
    const chatContainer = document.querySelector('[data-chat-id]');
    if (chatContainer) {
        const chatId = chatContainer.getAttribute('data-chat-id');
        const isAdmin = window.location.pathname.includes('/admin/');
        const messagesContainer = document.querySelector('#messages-container');
        
        if (messagesContainer) {
            // Get last message ID from existing messages
            const lastMessage = messagesContainer.querySelector('[data-message-id]:last-child');
            const lastMessageId = lastMessage ? parseInt(lastMessage.getAttribute('data-message-id')) : 0;
            
            window.chatRealtime = new ChatRealtime({
                chatId: chatId,
                isAdmin: isAdmin,
                lastMessageId: lastMessageId,
                messagesContainer: '#messages-container',
                unreadCountElement: '.unread-count'
            });
        }
    }
});