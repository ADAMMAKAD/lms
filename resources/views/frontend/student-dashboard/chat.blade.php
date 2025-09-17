@extends('frontend.student-dashboard.layouts.master')

@section('title', 'Chat with Instructors')

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
                                    <div class="avatar-placeholder">I</div>
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
                                <button class="action-btn schedule-btn" id="scheduleBtn" disabled title="{{ __('Request Meeting') }}">
                                    <i class="fas fa-calendar"></i>
                                    <span class="btn-text">{{ __('Meeting') }}</span>
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

        .search-box .form-control {
            padding: 10px 40px 10px 16px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .search-box .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .search-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 14px;
        }

        .students-scroll {
            height: calc(100% - 120px);
            overflow-y: auto;
            padding: 0;
        }

        .student-item {
            display: flex;
            align-items: center;
            padding: 16px 20px;
            border-bottom: 1px solid #f3f4f6;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }

        .student-item:hover {
            background: #f8fafc;
        }

        .student-item.active {
            background: #eff6ff;
            border-right: 3px solid #3b82f6;
        }

        .student-avatar {
            position: relative;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .student-avatar img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
        }

        .avatar-placeholder {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 18px;
        }

        .online-status {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 12px;
            height: 12px;
            background: #10b981;
            border: 2px solid white;
            border-radius: 50%;
        }

        .student-info {
            flex: 1;
            min-width: 0;
        }

        .student-name {
            font-weight: 600;
            color: #1f2937;
            margin: 0 0 4px 0;
            font-size: 14px;
        }

        .last-message {
            color: #6b7280;
            margin: 0 0 2px 0;
            font-size: 13px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .message-time {
            color: #9ca3af;
            font-size: 12px;
        }

        .unread-count {
            margin-left: 8px;
        }

        .unread-count .badge {
            font-size: 11px;
            padding: 4px 6px;
            border-radius: 10px;
        }

        .chat-area {
            height: 100%;
            display: flex;
            flex-direction: column;
            background: white;
        }

        .chat-area-header {
            padding: 16px 24px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
        }

        .chat-user-info {
            display: flex;
            align-items: center;
        }

        .chat-avatar {
            margin-right: 12px;
        }

        .chat-avatar .avatar-placeholder {
            width: 40px;
            height: 40px;
            font-size: 16px;
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
            background: none;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 8px 12px;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
        }

        .action-btn:not(:disabled):hover {
            background: #f3f4f6;
            border-color: #9ca3af;
            color: #374151;
        }

        .action-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-text {
            display: none;
        }

        @media (min-width: 1200px) {
            .btn-text {
                display: inline;
            }
        }

        .messages-area {
            flex: 1;
            padding: 24px;
            overflow-y: auto;
            background: #f8fafc;
        }

        .welcome-message {
            text-align: center;
            padding: 60px 20px;
        }

        .welcome-icon {
            font-size: 48px;
            color: #d1d5db;
            margin-bottom: 16px;
        }

        .welcome-title {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .welcome-text {
            color: #6b7280;
            margin: 0;
        }

        .message-input-area {
            padding: 16px 24px;
            border-top: 1px solid #e2e8f0;
            background: white;
        }

        .input-container {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            padding: 8px 16px;
            transition: all 0.2s ease;
        }

        .input-container:focus-within {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .attachment-btn, .emoji-btn, .send-btn {
            background: none;
            border: none;
            color: #6b7280;
            padding: 8px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
        }

        .attachment-btn:not(:disabled):hover, 
        .emoji-btn:not(:disabled):hover {
            background: #e5e7eb;
            color: #374151;
        }

        .send-btn:not(:disabled):hover {
            background: #3b82f6;
            color: white;
        }

        .attachment-btn:disabled, 
        .emoji-btn:disabled, 
        .send-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .message-input {
            flex: 1;
            border: none;
            background: none;
            outline: none;
            padding: 8px 12px;
            font-size: 14px;
            color: #1f2937;
        }

        .message-input::placeholder {
            color: #9ca3af;
        }

        .message-input:disabled {
            color: #9ca3af;
        }

        /* Responsive Design */
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
            
            .students-scroll {
                height: 200px;
            }
        }

        .message {
            margin-bottom: 16px;
            display: flex;
        }

        .message.sent {
            justify-content: flex-end;
        }

        .message.received {
            justify-content: flex-start;
        }

        .message-content {
            max-width: 70%;
            padding: 12px 16px;
            border-radius: 18px;
            position: relative;
        }

        .message.sent .message-content {
            background: #3b82f6;
            color: white;
            border-bottom-right-radius: 4px;
        }

        .message.received .message-content {
            background: white;
            color: #1f2937;
            border: 1px solid #e2e8f0;
            border-bottom-left-radius: 4px;
        }

        .message-content p {
            margin: 0 0 4px 0;
            font-size: 14px;
            line-height: 1.4;
        }

        .message-time {
            font-size: 11px;
            opacity: 0.7;
        }

        .chat-started {
            padding: 20px 0;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Student selection functionality
            const studentItems = document.querySelectorAll('.student-item');
            const chatUserName = document.getElementById('chatUserName');
            const chatUserStatus = document.getElementById('chatUserStatus');
            const messagesArea = document.getElementById('messagesArea');
            const messageInput = document.getElementById('messageInput');
            const sendBtn = document.getElementById('sendBtn');
            const videoCallBtn = document.getElementById('videoCallBtn');
            const scheduleBtn = document.getElementById('scheduleBtn');
            const moreBtn = document.getElementById('moreBtn');
            const attachBtn = document.getElementById('attachBtn');
            const emojiBtn = document.getElementById('emojiBtn');

            studentItems.forEach(item => {
                item.addEventListener('click', function() {
                    // Remove active class from all items
                    studentItems.forEach(i => i.classList.remove('active'));
                    
                    // Add active class to clicked item
                    this.classList.add('active');
                    
                    // Update chat header
                    const studentName = this.dataset.studentName;
                    chatUserName.textContent = studentName;
                    chatUserStatus.textContent = 'Online';
                    
                    // Enable chat controls
                    messageInput.disabled = false;
                    sendBtn.disabled = false;
                    videoCallBtn.disabled = false;
                    scheduleBtn.disabled = false;
                    moreBtn.disabled = false;
                    attachBtn.disabled = false;
                    emojiBtn.disabled = false;
                    
                    // Update chat area
                    messagesArea.innerHTML = `
                        <div class="chat-started">
                            <div class="text-center mb-3">
                                <small class="text-muted">Chat started with ${studentName}</small>
                            </div>
                            <div class="message received">
                                <div class="message-content">
                                    <p>Hello! How can I help you today?</p>
                                    <small class="message-time">Just now</small>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    // Focus on message input
                    messageInput.focus();
                });
            });

            // Search functionality
            const studentSearch = document.getElementById('studentSearch');
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

            // Send message functionality
            function sendMessage() {
                const message = messageInput.value.trim();
                if (message && !messageInput.disabled) {
                    // Add message to chat
                    const messageHtml = `
                        <div class="message sent">
                            <div class="message-content">
                                <p>${message}</p>
                                <small class="message-time">Just now</small>
                            </div>
                        </div>
                    `;
                    messagesArea.insertAdjacentHTML('beforeend', messageHtml);
                    
                    // Clear input
                    messageInput.value = '';
                    
                    // Scroll to bottom
                    messagesArea.scrollTop = messagesArea.scrollHeight;
                    
                    // Simulate instructor response
                    setTimeout(() => {
                        const responseHtml = `
                            <div class="message received">
                                <div class="message-content">
                                    <p>Thank you for your message. I'll get back to you shortly.</p>
                                    <small class="message-time">Just now</small>
                                </div>
                            </div>
                        `;
                        messagesArea.insertAdjacentHTML('beforeend', responseHtml);
                        messagesArea.scrollTop = messagesArea.scrollHeight;
                    }, 1000);
                }
            }

            // Send button click
            sendBtn.addEventListener('click', sendMessage);

            // Enter key to send
            messageInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });

            // Video call button
            videoCallBtn.addEventListener('click', function() {
                if (!this.disabled) {
                    alert('Video call feature will be available soon!');
                }
            });

            // Schedule button
            scheduleBtn.addEventListener('click', function() {
                if (!this.disabled) {
                    window.location.href = '{{ route("student.meetings") }}';
                }
            });
        });
    </script>
@endsection