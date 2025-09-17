@extends('frontend.instructor-dashboard.layouts.master')

@section('dashboard-content')
    <div class="modern-ai-summary-container">
        <!-- Header Section -->
        <div class="ai-header-section">
            <div class="header-content">
                <div class="header-text">
                    <h1 class="header-title">
                        <i class="fas fa-brain"></i>
                        {{ __('AI Summary & Insights') }}
                    </h1>
                    <p class="header-subtitle">{{ __('Get intelligent insights about your teaching performance and student engagement') }}</p>
                </div>
                <div class="header-actions">
                    <button class="btn-primary" onclick="generateNewSummary()">
                        <i class="fas fa-sync-alt"></i>
                        {{ __('Generate New Summary') }}
                    </button>
                </div>
            </div>
        </div>

        <!-- AI Assistant Card -->
        <div class="ai-assistant-card">
            <div class="assistant-avatar">
                <i class="fas fa-robot"></i>
            </div>
            <div class="assistant-content">
                <h3 class="assistant-title">{{ __('AI Teaching Assistant') }}</h3>
                <p class="assistant-greeting">{{ __('Hello! I\'ve analyzed your teaching data and have some insights to share with you.') }}</p>
                <div class="assistant-status">
                    <div class="status-indicator"></div>
                    <span>{{ __('Last updated') }}: {{ now()->format('M d, Y \a\t H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Key Insights Grid -->
        <div class="insights-grid">
            <div class="insight-card performance">
                <div class="insight-header">
                    <div class="insight-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="insight-badge positive">{{ __('Improving') }}</div>
                </div>
                <div class="insight-body">
                    <h3 class="insight-title">{{ __('Performance Trend') }}</h3>
                    <p class="insight-description">{{ __('Your student engagement has increased by 15% this month') }}</p>
                    <div class="insight-metric">
                        <span class="metric-value">+15%</span>
                        <span class="metric-label">{{ __('This Month') }}</span>
                    </div>
                </div>
            </div>

            <div class="insight-card engagement">
                <div class="insight-header">
                    <div class="insight-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="insight-badge high">{{ __('High') }}</div>
                </div>
                <div class="insight-body">
                    <h3 class="insight-title">{{ __('Student Engagement') }}</h3>
                    <p class="insight-description">{{ __('Students are actively participating in your courses') }}</p>
                    <div class="insight-metric">
                        <span class="metric-value">92%</span>
                        <span class="metric-label">{{ __('Engagement Rate') }}</span>
                    </div>
                </div>
            </div>

            <div class="insight-card recommendation">
                <div class="insight-header">
                    <div class="insight-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <div class="insight-badge suggestion">{{ __('Suggestion') }}</div>
                </div>
                <div class="insight-body">
                    <h3 class="insight-title">{{ __('AI Recommendation') }}</h3>
                    <p class="insight-description">{{ __('Consider adding more interactive Q&A sessions') }}</p>
                    <div class="insight-metric">
                        <span class="metric-value">3</span>
                        <span class="metric-label">{{ __('New Ideas') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="content-grid">
            <!-- Course Analysis Panel -->
            <div class="analysis-panel">
                <div class="panel-header">
                    <h2 class="panel-title">
                        <i class="fas fa-microscope"></i>
                        {{ __('Detailed Course Analysis') }}
                    </h2>
                </div>
                <div class="panel-content">
                    @foreach($aiSummary['course_analysis'] as $analysis)
                        <div class="course-analysis-item">
                            <div class="course-header">
                                <h4 class="course-title">{{ $analysis['course_title'] }}</h4>
                                <div class="course-score score-{{ $analysis['score_class'] }}">
                                    <span class="score-value">{{ $analysis['score'] }}</span>
                                    <span class="score-max">/100</span>
                                </div>
                            </div>
                            
                            <div class="course-metrics">
                                <div class="metric-item">
                                    <div class="metric-header">
                                        <span class="metric-label">{{ __('Completion Rate') }}</span>
                                        <span class="metric-value">{{ $analysis['completion_rate'] }}%</span>
                                    </div>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: {{ $analysis['completion_rate'] }}%"></div>
                                    </div>
                                </div>
                                
                                <div class="metric-item">
                                    <div class="metric-header">
                                        <span class="metric-label">{{ __('Student Satisfaction') }}</span>
                                        <span class="metric-value">{{ $analysis['satisfaction'] }}%</span>
                                    </div>
                                    <div class="metric-bar">
                                        <div class="metric-fill" style="width: {{ $analysis['satisfaction'] }}%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="course-insights">
                                <div class="insights-section">
                                    <h5 class="section-title">{{ __('AI Insights') }}</h5>
                                    <ul class="insights-list">
                                        @foreach($analysis['insights'] as $insight)
                                            <li>{{ $insight }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                
                                <div class="recommendations-section">
                                    <h5 class="section-title">{{ __('Recommendations') }}</h5>
                                    <ul class="recommendations-list">
                                        @foreach($analysis['recommendations'] as $recommendation)
                                            <li>{{ $recommendation }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Sidebar -->
            <div class="sidebar-content">
                <!-- Smart Recommendations -->
                <div class="recommendations-panel">
                    <div class="panel-header">
                        <h2 class="panel-title">
                            <i class="fas fa-magic"></i>
                            {{ __('Smart Recommendations') }}
                        </h2>
                    </div>
                    <div class="panel-content">
                        @foreach($aiSummary['recommendations'] as $recommendation)
                            <div class="recommendation-card">
                                <div class="recommendation-header">
                                    <div class="priority-badge priority-{{ $recommendation['priority'] }}">
                                        {{ ucfirst($recommendation['priority']) }}
                                    </div>
                                </div>
                                <h4 class="recommendation-title">{{ $recommendation['title'] }}</h4>
                                <p class="recommendation-description">{{ $recommendation['description'] }}</p>
                                <div class="recommendation-actions">
                                    <button class="btn-primary btn-sm" onclick="implementRecommendation({{ $recommendation['id'] }})">
                                        {{ __('Implement') }}
                                    </button>
                                    <button class="btn-outline btn-sm" onclick="dismissRecommendation({{ $recommendation['id'] }})">
                                        {{ __('Dismiss') }}
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Student Sentiment -->
                <div class="sentiment-panel">
                    <div class="panel-header">
                        <h2 class="panel-title">
                            <i class="fas fa-heart"></i>
                            {{ __('Student Sentiment') }}
                        </h2>
                    </div>
                    <div class="panel-content">
                        <div class="sentiment-overview">
                            <div class="sentiment-score-circle">
                                <div class="score-display">
                                    <span class="score-number">{{ $aiSummary['sentiment_score'] }}</span>
                                    <span class="score-label">{{ __('Overall') }}</span>
                                </div>
                            </div>
                            
                            <div class="sentiment-breakdown">
                                <div class="sentiment-item positive">
                                    <div class="sentiment-icon">😊</div>
                                    <div class="sentiment-info">
                                        <span class="sentiment-label">{{ __('Positive') }}</span>
                                        <span class="sentiment-percentage">{{ $aiSummary['sentiment_breakdown']['positive'] }}%</span>
                                    </div>
                                </div>
                                
                                <div class="sentiment-item neutral">
                                    <div class="sentiment-icon">😐</div>
                                    <div class="sentiment-info">
                                        <span class="sentiment-label">{{ __('Neutral') }}</span>
                                        <span class="sentiment-percentage">{{ $aiSummary['sentiment_breakdown']['neutral'] }}%</span>
                                    </div>
                                </div>
                                
                                <div class="sentiment-item negative">
                                    <div class="sentiment-icon">😞</div>
                                    <div class="sentiment-info">
                                        <span class="sentiment-label">{{ __('Negative') }}</span>
                                        <span class="sentiment-percentage">{{ $aiSummary['sentiment_breakdown']['negative'] }}%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="recent-feedback">
                            <h4 class="feedback-title">{{ __('Recent Feedback Highlights') }}</h4>
                            <div class="feedback-list">
                                @foreach($aiSummary['recent_feedback'] as $feedback)
                                    <div class="feedback-item">
                                        <div class="feedback-sentiment sentiment-{{ $feedback['sentiment'] }}">
                                            @if($feedback['sentiment'] == 'positive')
                                                <i class="fas fa-smile"></i>
                                            @elseif($feedback['sentiment'] == 'negative')
                                                <i class="fas fa-frown"></i>
                                            @else
                                                <i class="fas fa-meh"></i>
                                            @endif
                                        </div>
                                        <div class="feedback-content">
                                            <p class="feedback-comment">"{{ $feedback['comment'] }}"</p>
                                            <span class="feedback-course">{{ $feedback['course'] }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- AI Chat Assistant -->
        <div class="ai-chat-panel">
            <div class="panel-header">
                <h2 class="panel-title">
                    <i class="fas fa-comments"></i>
                    {{ __('Ask AI Assistant') }}
                </h2>
            </div>
            <div class="panel-content">
                <div class="chat-messages" id="chatMessages">
                    <div class="ai-message">
                        <div class="message-avatar">
                            <i class="fas fa-robot"></i>
                        </div>
                        <div class="message-content">
                            <p>{{ __('Hello! I\'m your AI teaching assistant. You can ask me questions about your teaching performance, student engagement, or get recommendations for improving your courses.') }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="chat-input-section">
                    <div class="chat-input-group">
                        <input type="text" class="chat-input" id="chatInput" placeholder="{{ __('Ask me anything about your teaching...') }}">
                        <button class="btn-primary chat-send" onclick="sendMessage()">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                    
                    <div class="quick-questions">
                        <span class="quick-label">{{ __('Quick questions:') }}</span>
                        <div class="quick-buttons">
                            <button class="btn-outline btn-sm" onclick="askQuickQuestion('performance')">
                                {{ __('How is my performance?') }}
                            </button>
                            <button class="btn-outline btn-sm" onclick="askQuickQuestion('engagement')">
                                {{ __('How to improve engagement?') }}
                            </button>
                            <button class="btn-outline btn-sm" onclick="askQuickQuestion('trends')">
                                {{ __('What are the trends?') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Modern AI Summary Styling */
        .modern-ai-summary-container {
            padding: 0;
            background: #f8fafc;
            min-height: 100vh;
        }

        /* Header Section */
        .ai-header-section {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
        }

        .header-title {
            font-size: 2.25rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 0.5rem 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .header-title i {
            color: #3b82f6;
        }

        .header-subtitle {
            color: #64748b;
            margin: 0;
            font-size: 1.125rem;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            background: #2563eb;
            transform: translateY(-1px);
        }

        .btn-primary.btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
        }

        .btn-outline {
            background: transparent;
            color: #3b82f6;
            border: 1px solid #3b82f6;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-outline:hover {
            background: #3b82f6;
            color: white;
        }

        .btn-outline.btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
        }

        /* AI Assistant Card */
        .ai-assistant-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin: 0 2rem 2rem 2rem;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .assistant-avatar {
            width: 80px;
            height: 80px;
            background: #3b82f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            flex-shrink: 0;
        }

        .assistant-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 0.5rem 0;
        }

        .assistant-greeting {
            color: #64748b;
            margin: 0 0 1rem 0;
            line-height: 1.6;
        }

        .assistant-status {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #64748b;
            font-size: 0.875rem;
        }

        .status-indicator {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
        }

        /* Insights Grid */
        .insights-grid {
             display: grid;
             grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
             gap: 1.5rem;
             padding: 0 2rem;
             margin-bottom: 2rem;
             max-width: 1400px;
             margin-left: auto;
             margin-right: auto;
         }

        .insight-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }

        .insight-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .insight-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .insight-icon {
            width: 48px;
            height: 48px;
            background: #3b82f6;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        .insight-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .insight-badge.positive {
            background: #dcfce7;
            color: #166534;
        }

        .insight-badge.high {
            background: #dbeafe;
            color: #1e40af;
        }

        .insight-badge.suggestion {
            background: #fef3c7;
            color: #92400e;
        }

        .insight-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 0.5rem 0;
        }

        .insight-description {
            color: #64748b;
            margin: 0 0 1rem 0;
            line-height: 1.5;
        }

        .insight-metric {
            display: flex;
            align-items: baseline;
            gap: 0.5rem;
        }

        .metric-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #3b82f6;
        }

        .metric-label {
            color: #64748b;
            font-size: 0.875rem;
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 2rem;
            padding: 0 2rem;
            margin-bottom: 2rem;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }

        .analysis-panel,
        .recommendations-panel,
        .sentiment-panel,
        .ai-chat-panel {
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .panel-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .panel-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .panel-title i {
            color: #3b82f6;
        }

        .panel-content {
            padding: 1.5rem;
        }

        /* Course Analysis */
        .course-analysis-item {
            padding: 1.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .course-analysis-item:last-child {
            margin-bottom: 0;
        }

        .course-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .course-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }

        .course-score {
            display: flex;
            align-items: baseline;
            gap: 0.25rem;
        }

        .score-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #3b82f6;
        }

        .score-max {
            color: #64748b;
            font-size: 1rem;
        }

        .course-metrics {
            margin-bottom: 1.5rem;
        }

        .metric-item {
            margin-bottom: 1rem;
        }

        .metric-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .metric-label {
            color: #64748b;
            font-size: 0.875rem;
        }

        .metric-value {
            font-weight: 600;
            color: #1e293b;
        }

        .metric-bar {
            height: 6px;
            background: #f1f5f9;
            border-radius: 3px;
            overflow: hidden;
        }

        .metric-fill {
            height: 100%;
            background: #3b82f6;
            border-radius: 3px;
            transition: width 0.3s ease;
        }

        .course-insights {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .section-title {
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 0.75rem 0;
        }

        .insights-list,
        .recommendations-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .insights-list li,
        .recommendations-list li {
            padding: 0.5rem 0;
            color: #64748b;
            font-size: 0.875rem;
            line-height: 1.5;
            position: relative;
            padding-left: 1rem;
        }

        .insights-list li::before,
        .recommendations-list li::before {
            content: '•';
            color: #3b82f6;
            position: absolute;
            left: 0;
        }

        /* Sidebar Content */
        .sidebar-content {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Recommendations */
        .recommendation-card {
            padding: 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .recommendation-card:last-child {
            margin-bottom: 0;
        }

        .recommendation-header {
            margin-bottom: 0.75rem;
        }

        .priority-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .priority-badge.priority-high {
            background: #fee2e2;
            color: #dc2626;
        }

        .priority-badge.priority-medium {
            background: #fef3c7;
            color: #d97706;
        }

        .priority-badge.priority-low {
            background: #dcfce7;
            color: #16a34a;
        }

        .recommendation-title {
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 0.5rem 0;
        }

        .recommendation-description {
            color: #64748b;
            font-size: 0.875rem;
            margin: 0 0 1rem 0;
            line-height: 1.5;
        }

        .recommendation-actions {
            display: flex;
            gap: 0.5rem;
        }

        /* Sentiment Analysis */
        .sentiment-overview {
            margin-bottom: 1.5rem;
        }

        .sentiment-score-circle {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .score-display {
            width: 120px;
            height: 120px;
            border: 4px solid #3b82f6;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .score-number {
            font-size: 2rem;
            font-weight: 700;
            color: #3b82f6;
        }

        .score-label {
            font-size: 0.875rem;
            color: #64748b;
        }

        .sentiment-breakdown {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .sentiment-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            background: #f8fafc;
            border-radius: 8px;
        }

        .sentiment-icon {
            font-size: 1.5rem;
        }

        .sentiment-info {
            flex: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sentiment-label {
            font-weight: 500;
            color: #1e293b;
        }

        .sentiment-percentage {
            font-weight: 600;
            color: #3b82f6;
        }

        /* Recent Feedback */
        .feedback-title {
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 1rem 0;
        }

        .feedback-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .feedback-item {
            display: flex;
            gap: 0.75rem;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 8px;
        }

        .feedback-sentiment {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .feedback-sentiment.sentiment-positive {
            background: #dcfce7;
            color: #16a34a;
        }

        .feedback-sentiment.sentiment-negative {
            background: #fee2e2;
            color: #dc2626;
        }

        .feedback-sentiment.sentiment-neutral {
            background: #f1f5f9;
            color: #64748b;
        }

        .feedback-comment {
            font-size: 0.875rem;
            color: #1e293b;
            margin: 0 0 0.25rem 0;
            line-height: 1.5;
        }

        .feedback-course {
            font-size: 0.75rem;
            color: #64748b;
        }

        /* AI Chat */
        .ai-chat-panel {
            margin: 0 2rem;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }

        .chat-messages {
            max-height: 300px;
            overflow-y: auto;
            margin-bottom: 1.5rem;
        }

        .ai-message {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .message-avatar {
            width: 40px;
            height: 40px;
            background: #3b82f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
        }

        .message-content {
            flex: 1;
            background: #f8fafc;
            padding: 1rem;
            border-radius: 8px;
        }

        .message-content p {
            margin: 0;
            color: #1e293b;
            line-height: 1.5;
        }

        .chat-input-section {
            border-top: 1px solid #e2e8f0;
            padding-top: 1.5rem;
        }

        .chat-input-group {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .chat-input {
            flex: 1;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.875rem;
            outline: none;
            transition: border-color 0.2s ease;
        }

        .chat-input:focus {
            border-color: #3b82f6;
        }

        .chat-send {
            padding: 0.75rem;
            width: auto;
        }

        .quick-questions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.75rem;
        }

        .quick-label {
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .quick-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
            
            .sidebar-content {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .ai-assistant-card {
                flex-direction: column;
                text-align: center;
                margin: 0 1rem 2rem 1rem;
            }

            .insights-grid,
            .content-grid {
                padding: 0 1rem;
                grid-template-columns: 1fr;
            }

            .sidebar-content {
                grid-template-columns: 1fr;
            }

            .course-insights {
                grid-template-columns: 1fr;
            }

            .ai-chat-panel {
                margin: 0 1rem;
            }

            .quick-questions {
                flex-direction: column;
                align-items: stretch;
            }

            .quick-buttons {
                justify-content: center;
            }

            .header-title {
                font-size: 1.75rem;
            }
        }
    </style>

    <script>
        function generateNewSummary() {
            // Add loading state
            const button = event.target;
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generating...';
            button.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                button.innerHTML = originalText;
                button.disabled = false;
                // You can add actual API call here
                alert('New AI summary generated!');
            }, 2000);
        }

        function implementRecommendation(id) {
            alert('Implementing recommendation ' + id);
        }

        function dismissRecommendation(id) {
            alert('Dismissing recommendation ' + id);
        }

        function sendMessage() {
            const input = document.getElementById('chatInput');
            const message = input.value.trim();
            if (message) {
                // Add user message to chat
                addMessageToChat(message, 'user');
                input.value = '';
                
                // Simulate AI response
                setTimeout(() => {
                    addMessageToChat('Thank you for your question! I\'m analyzing your data to provide the best response.', 'ai');
                }, 1000);
            }
        }

        function askQuickQuestion(type) {
            const questions = {
                'performance': 'How is my performance?',
                'engagement': 'How to improve engagement?',
                'trends': 'What are the trends?'
            };
            
            const question = questions[type];
            if (question) {
                document.getElementById('chatInput').value = question;
                sendMessage();
            }
        }

        function addMessageToChat(message, sender) {
            const chatMessages = document.getElementById('chatMessages');
            const messageDiv = document.createElement('div');
            messageDiv.className = sender === 'ai' ? 'ai-message' : 'user-message';
            
            if (sender === 'ai') {
                messageDiv.innerHTML = `
                    <div class="message-avatar">
                        <i class="fas fa-robot"></i>
                    </div>
                    <div class="message-content">
                        <p>${message}</p>
                    </div>
                `;
            } else {
                messageDiv.innerHTML = `
                    <div class="message-content user">
                        <p>${message}</p>
                    </div>
                `;
                messageDiv.style.flexDirection = 'row-reverse';
            }
            
            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Allow Enter key to send message
        document.addEventListener('DOMContentLoaded', function() {
            const chatInput = document.getElementById('chatInput');
            if (chatInput) {
                chatInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        sendMessage();
                    }
                });
            }
        });
    </script>
@endsection