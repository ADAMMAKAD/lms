@extends('frontend.instructor-dashboard.layouts.master')

@section('dashboard-content')
    <div class="modern-chat-container">
        <!-- Professional Header -->
        <div class="chat-header">
            <div class="header-content">
                <div class="header-info">
                    <h2 class="page-title">{{ __('Chat with Students') }}</h2>
                    <p class="page-subtitle">{{ __('Communicate directly with your students in real-time') }}</p>
                </div>
                <div class="header-actions">
                    <button class="btn btn-primary">
                        <i class="fas fa-users me-2"></i>{{ __('Manage Students') }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Chat Interface -->
        <div class="chat-interface">
            <div class="row g-0" style="height: 650px;">
                <!-- Students List -->
                <div class="col-lg-4 col-md-5">
                    <div class="students-list">
                        <div class="students-header">
                            <h5 class="section-title">{{ __('Students') }}</h5>
                            <div class="search-container">
                                <div class="search-box">
                                    <input type="text" class="form-control" placeholder="{{ __('Search students...') }}" id="studentSearch">
                                    <i class="fas fa-search search-icon"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="students-scroll">
                            @foreach($students as $student)
                                <div class="student-item" data-student-id="{{ $student->id }}" data-student-name="{{ $student->name }}">
                                    <div class="student-avatar">
                                        @if($student->image)
                                            <img src="{{ asset($student->image) }}" alt="{{ $student->name }}">
                                        @else
                                            <div class="avatar-placeholder">
                                                {{ substr($student->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <span class="online-status"></span>
                                    </div>
                                    <div class="student-info">
                                        <h6 class="student-name">{{ $student->name }}</h6>
                                        <p class="last-message">{{ __('Click to start conversation') }}</p>
                                        <small class="message-time">{{ __('Online') }}</small>
                                    </div>
                                    <div class="unread-count">
                                        <span class="badge bg-primary">2</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Chat Area -->
                <div class="col-lg-8 col-md-7">
                    <div class="chat-area">
                        <!-- Professional Chat Header -->
                        <div class="chat-area-header">
                            <div class="chat-user-info">
                                <div class="chat-avatar">
                                    <div class="avatar-placeholder">S</div>
                                </div>
                                <div class="chat-user-details">
                                    <h6 class="chat-user-name" id="chatUserName">{{ __('Select a student') }}</h6>
                                    <small class="chat-user-status" id="chatUserStatus">{{ __('to start conversation') }}</small>
                                </div>
                            </div>
                            <div class="chat-actions">
                                <button class="action-btn video-btn" id="videoCallBtn" disabled title="{{ __('Start Video Call') }}">
                                    <i class="fas fa-video"></i>
                                    <span class="btn-text">{{ __('Video') }}</span>
                                </button>
                                <button class="action-btn schedule-btn" id="scheduleBtn" disabled title="{{ __('Schedule Meeting') }}">
                                    <i class="fas fa-calendar"></i>
                                    <span class="btn-text">{{ __('Schedule') }}</span>
                                </button>
                                <button class="action-btn more-btn" id="moreBtn" disabled title="{{ __('More Options') }}">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Messages Area -->
                        <div class="messages-area" id="messagesArea">
                            <div class="welcome-message">
                                <div class="welcome-icon">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <h5 class="welcome-title">{{ __('Welcome to Chat') }}</h5>
                                <p class="welcome-text">{{ __('Select a student from the list to start a conversation') }}</p>
                            </div>
                        </div>

                        <!-- Professional Message Input -->
                        <div class="message-input-area">
                            <div class="input-container">
                                <button class="attachment-btn" type="button" id="attachBtn" disabled title="{{ __('Attach File') }}">
                                    <i class="fas fa-paperclip"></i>
                                </button>
                                <input type="text" class="message-input" placeholder="{{ __('Type your message...') }}" id="messageInput" disabled>
                                <button class="emoji-btn" type="button" id="emojiBtn" disabled title="{{ __('Add Emoji') }}">
                                    <i class="fas fa-smile"></i>
                                </button>
                                <button class="send-btn" type="button" id="sendBtn" disabled title="{{ __('Send Message') }}">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .modern-chat-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .chat-header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 24px 32px;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .page-subtitle {
            color: #6b7280;
            margin: 4px 0 0 0;
            font-size: 14px;
        }

        .header-actions .btn {
            background: #3b82f6;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .header-actions .btn:hover {
            background: #2563eb;
            transform: translateY(-1px);
        }

        .chat-interface {
            background: #f8f9fa;
        }

        .students-list {
            background: white;
            height: 100%;
            border-right: 1px solid #e2e8f0;
        }

        .students-header {
            padding: 20px;
            border-bottom: 1px solid #e2e8f0;
            background: white;
        }

        .section-title {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 16px;
        }

        .search-container {
            margin-bottom: 0;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding: 10px 40px 10px 16px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            background: #f9fafb;
            transition: all 0.2s ease;
        }

        .search-box input:focus {
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .search-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        .students-scroll {
            height: calc(100% - 140px);
            overflow-y: auto;
        }

        .student-item {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            border-bottom: 1px solid #e9ecef;
        }

        .student-item:hover {
            background: white;
        }

        .student-item.active {
            background: white;
            border-left: 4px solid #3b82f6;
        }

        .student-avatar {
            position: relative;
            margin-right: 12px;
        }

        .student-avatar img,
        .student-avatar .avatar-placeholder {
            width: 45px;
            height: 45px;
            border-radius: 50%;
        }

        .student-avatar .avatar-placeholder {
            background: #3b82f6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 16px;
        }

        .online-status {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 12px;
            height: 12px;
            background: #28a745;
            border: 2px solid white;
            border-radius: 50%;
        }

        .student-info {
            flex: 1;
            min-width: 0;
        }

        .student-name {
            font-weight: 600;
            margin-bottom: 2px;
            font-size: 14px;
        }

        .last-message {
            color: #6c757d;
            font-size: 13px;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .message-time {
            color: #adb5bd;
            font-size: 11px;
        }

        .unread-count {
            margin-left: 10px;
        }

        .unread-count .badge {
            font-size: 10px;
            padding: 4px 6px;
        }

        .chat-area {
            height: 100%;
            display: flex;
            flex-direction: column;
            background: white;
        }

        .chat-area-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
        }

        .chat-user-info {
            display: flex;
            align-items: center;
            flex: 1;
        }

        .chat-avatar {
            margin-right: 12px;
        }

        .chat-avatar .avatar-placeholder {
            width: 40px;
            height: 40px;
            background: #3b82f6;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .chat-user-name {
            font-weight: 600;
            color: #1f2937;
            margin: 0;
            font-size: 16px;
        }

        .chat-user-status {
            color: #6b7280;
            font-size: 13px;
        }

        .chat-actions {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border: 1px solid #e2e8f0;
            background: white;
            border-radius: 6px;
            color: #374151;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .action-btn:hover:not(:disabled) {
            background: #f9fafb;
            border-color: #3b82f6;
            color: #3b82f6;
        }

        .action-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .video-btn:hover:not(:disabled) {
            background: #dbeafe;
            border-color: #3b82f6;
            color: #1d4ed8;
        }

        .schedule-btn:hover:not(:disabled) {
            background: #ecfdf5;
            border-color: #10b981;
            color: #047857;
        }

        .more-btn {
            padding: 8px 12px;
        }

        .btn-text {
            font-size: 13px;
        }

        .messages-area {
            flex: 1;
            padding: 24px;
            overflow-y: auto;
            background: #f8f9fa;
        }

        .welcome-message {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .welcome-icon {
            width: 80px;
            height: 80px;
            background: #f3f4f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
        }

        .welcome-icon i {
            font-size: 32px;
            color: #9ca3af;
        }

        .welcome-title {
            font-size: 20px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .welcome-text {
            color: #6b7280;
            font-size: 14px;
            max-width: 300px;
            line-height: 1.5;
        }

        .message-input-area {
            padding: 20px 24px;
            border-top: 1px solid #e2e8f0;
            background: white;
        }

        .input-container {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f9fafb;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 8px;
            transition: all 0.2s ease;
        }

        .input-container:focus-within {
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .attachment-btn,
        .emoji-btn {
            background: none;
            border: none;
            color: #6b7280;
            padding: 8px;
            border-radius: 4px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .attachment-btn:hover:not(:disabled),
        .emoji-btn:hover:not(:disabled) {
            background: #e5e7eb;
            color: #374151;
        }

        .attachment-btn:disabled,
        .emoji-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .message-input {
            flex: 1;
            border: none;
            background: none;
            padding: 8px 12px;
            font-size: 14px;
            outline: none;
        }

        .message-input::placeholder {
            color: #9ca3af;
        }

        .send-btn {
            background: #3b82f6;
            border: none;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .send-btn:hover:not(:disabled) {
            background: #2563eb;
        }

        .send-btn:disabled {
            background: #d1d5db;
            cursor: not-allowed;
        }

        .message-input-area .btn {
            border: none;
            padding: 12px 20px;
        }

        .message-bubble {
            max-width: 70%;
            margin-bottom: 15px;
            padding: 12px 16px;
            border-radius: 18px;
            position: relative;
        }

        .message-bubble.sent {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            margin-left: auto;
            border-bottom-right-radius: 4px;
        }

        .message-bubble.received {
            background: white;
            color: #333;
            border-bottom-left-radius: 4px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .message-time-stamp {
            font-size: 11px;
            opacity: 0.7;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .chat-interface .row {
                height: auto !important;
            }
            
            .students-list {
                height: 300px;
            }
            
            .chat-area {
                height: 400px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const studentItems = document.querySelectorAll('.student-item');
            const messagesArea = document.getElementById('messagesArea');
            const chatUserName = document.getElementById('chatUserName');
            const chatUserStatus = document.getElementById('chatUserStatus');
            const messageInput = document.getElementById('messageInput');
            const sendBtn = document.getElementById('sendBtn');
            const attachBtn = document.getElementById('attachBtn');
            const videoCallBtn = document.getElementById('videoCallBtn');
            const scheduleBtn = document.getElementById('scheduleBtn');
            const studentSearch = document.getElementById('studentSearch');

            let currentStudentId = null;
            let currentStudentName = null;

            // Sample messages for demo
            const sampleMessages = {
                1: [
                    { type: 'received', text: 'Hello! I have a question about the assignment.', time: '10:30 AM' },
                    { type: 'sent', text: 'Hi! I\'d be happy to help. What\'s your question?', time: '10:32 AM' },
                    { type: 'received', text: 'I\'m having trouble understanding the concept in chapter 3.', time: '10:35 AM' }
                ]
            };

            // Student selection
            studentItems.forEach(item => {
                item.addEventListener('click', function() {
                    // Remove active class from all items
                    studentItems.forEach(i => i.classList.remove('active'));
                    
                    // Add active class to clicked item
                    this.classList.add('active');
                    
                    // Get student info
                    currentStudentId = this.dataset.studentId;
                    currentStudentName = this.dataset.studentName;
                    
                    // Update chat header
                    chatUserName.textContent = currentStudentName;
                    chatUserStatus.textContent = 'Online';
                    
                    // Enable controls
                    messageInput.disabled = false;
                    sendBtn.disabled = false;
                    attachBtn.disabled = false;
                    videoCallBtn.disabled = false;
                    scheduleBtn.disabled = false;
                    
                    // Load messages
                    loadMessages(currentStudentId);
                    
                    // Focus on input
                    messageInput.focus();
                });
            });

            // Load messages function
            function loadMessages(studentId) {
                const messages = sampleMessages[studentId] || [];
                
                if (messages.length === 0) {
                    messagesArea.innerHTML = `
                        <div class="text-center text-muted">
                            <i class="fas fa-comment-dots fa-2x mb-3"></i>
                            <p>Start a conversation with ${currentStudentName}</p>
                        </div>
                    `;
                } else {
                    messagesArea.innerHTML = messages.map(msg => `
                        <div class="message-bubble ${msg.type}">
                            <div class="message-text">${msg.text}</div>
                            <div class="message-time-stamp">${msg.time}</div>
                        </div>
                    `).join('');
                }
                
                // Scroll to bottom
                messagesArea.scrollTop = messagesArea.scrollHeight;
            }

            // Send message
            function sendMessage() {
                const text = messageInput.value.trim();
                if (!text || !currentStudentId) return;
                
                // Add message to UI
                const messageHtml = `
                    <div class="message-bubble sent">
                        <div class="message-text">${text}</div>
                        <div class="message-time-stamp">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</div>
                    </div>
                `;
                
                if (messagesArea.innerHTML.includes('Start a conversation')) {
                    messagesArea.innerHTML = messageHtml;
                } else {
                    messagesArea.insertAdjacentHTML('beforeend', messageHtml);
                }
                
                // Clear input
                messageInput.value = '';
                
                // Scroll to bottom
                messagesArea.scrollTop = messagesArea.scrollHeight;
                
                // Simulate response after 2 seconds
                setTimeout(() => {
                    const responseHtml = `
                        <div class="message-bubble received">
                            <div class="message-text">Thank you for your message! I'll get back to you soon.</div>
                            <div class="message-time-stamp">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</div>
                        </div>
                    `;
                    messagesArea.insertAdjacentHTML('beforeend', responseHtml);
                    messagesArea.scrollTop = messagesArea.scrollHeight;
                }, 2000);
            }

            // Send button click
            sendBtn.addEventListener('click', sendMessage);

            // Enter key to send
            messageInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });

            // Search functionality
            studentSearch.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                studentItems.forEach(item => {
                    const studentName = item.dataset.studentName.toLowerCase();
                    if (studentName.includes(searchTerm)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });

            // Video call button
            videoCallBtn.addEventListener('click', function() {
                if (currentStudentName) {
                    alert(`Starting video call with ${currentStudentName}...`);
                }
            });

            // Schedule button
            scheduleBtn.addEventListener('click', function() {
                if (currentStudentName) {
                    window.location.href = '{{ route("instructor.meetings") }}';
                }
            });
        });
    </script>
@endsection