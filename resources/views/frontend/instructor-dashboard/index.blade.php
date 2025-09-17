@extends('frontend.instructor-dashboard.layouts.master')

@section('dashboard-content')
    <div class="modern-dashboard-container">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <div class="welcome-content">
                <div class="welcome-text">
                    <h1 class="welcome-title">{{ __('Welcome back, :name!', ['name' => auth()->user()->name]) }}</h1>
                    <p class="welcome-subtitle">{{ __('Here\'s what\'s happening with your courses today.') }}</p>
                </div>
                <div class="welcome-date">
                    <div class="date-card">
                        <i class="fas fa-calendar-alt"></i>
                        <span>{{ now()->format('l, F j, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stats-section">
            <div class="stats-grid">
                <div class="stat-card courses">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="stat-trend">
                            <i class="fas fa-arrow-up"></i>
                            <span>+3</span>
                        </div>
                    </div>
                    <div class="stat-body">
                        <h3 class="stat-value">{{ $totalCourses }}</h3>
                        <p class="stat-label">{{ __('Total Courses') }}</p>
                        <div class="stat-progress">
                            <div class="progress-bar" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="stat-card students">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-trend">
                            <i class="fas fa-arrow-up"></i>
                            <span>+12</span>
                        </div>
                    </div>
                    <div class="stat-body">
                        <h3 class="stat-value">{{ $totalStudents }}</h3>
                        <p class="stat-label">{{ __('Total Students') }}</p>
                        <div class="stat-progress">
                            <div class="progress-bar" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="stat-card rating">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="stat-trend">
                            <i class="fas fa-arrow-up"></i>
                            <span>+0.2</span>
                        </div>
                    </div>
                    <div class="stat-body">
                        <h3 class="stat-value">{{ number_format($averageRating, 1) }}</h3>
                        <p class="stat-label">{{ __('Average Rating') }}</p>
                        <div class="stat-progress">
                            <div class="progress-bar" style="width: 90%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="stat-card reviews">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="stat-trend">
                            <i class="fas fa-arrow-up"></i>
                            <span>+8</span>
                        </div>
                    </div>
                    <div class="stat-body">
                        <h3 class="stat-value">{{ $totalReviews }}</h3>
                        <p class="stat-label">{{ __('Total Reviews') }}</p>
                        <div class="stat-progress">
                            <div class="progress-bar" style="width: 65%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="actions-section">
            <div class="section-header">
                <h2 class="section-title">{{ __('Quick Actions') }}</h2>
                <p class="section-subtitle">{{ __('Manage your teaching activities efficiently') }}</p>
            </div>
            <div class="actions-grid">
                <a href="{{ route('instructor.chat') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="action-content">
                        <h3 class="action-title">{{ __('Chat with Students') }}</h3>
                        <p class="action-description">{{ __('Communicate directly with your students') }}</p>
                        <div class="action-meta">
                            <span class="action-badge">{{ __('3 new messages') }}</span>
                        </div>
                    </div>
                    <div class="action-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </a>
                
                <a href="{{ route('instructor.meetings') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <div class="action-content">
                        <h3 class="action-title">{{ __('Schedule Meeting') }}</h3>
                        <p class="action-description">{{ __('Book appointments with students') }}</p>
                        <div class="action-meta">
                            <span class="action-badge">{{ __('2 upcoming') }}</span>
                        </div>
                    </div>
                    <div class="action-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </a>
                
                <a href="{{ route('instructor.analytics') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="action-content">
                        <h3 class="action-title">{{ __('View Analytics') }}</h3>
                        <p class="action-description">{{ __('Track your teaching performance') }}</p>
                        <div class="action-meta">
                            <span class="action-badge">{{ __('Updated today') }}</span>
                        </div>
                    </div>
                    <div class="action-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </a>
                
                <a href="{{ route('instructor.ai-summary') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <div class="action-content">
                        <h3 class="action-title">{{ __('AI Insights') }}</h3>
                        <p class="action-description">{{ __('Get smart analytics and recommendations') }}</p>
                        <div class="action-meta">
                            <span class="action-badge">{{ __('5 new insights') }}</span>
                        </div>
                    </div>
                    <div class="action-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </a>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="content-section">
            <!-- Recent Student Activity -->
            <div class="activity-panel">
                <div class="panel-header">
                    <div class="header-content">
                        <h2 class="panel-title">{{ __('Recent Student Activity') }}</h2>
                        <p class="panel-subtitle">{{ __('Latest interactions with your courses') }}</p>
                    </div>
                    <button class="btn-outline" onclick="window.location.href='{{ route('instructor.analytics') }}';">
                         {{ __('View All') }}
                     </button>
                </div>
                
                <div class="panel-content">
                    @if($recentActivity->count() > 0)
                        <div class="activity-list">
                            @foreach($recentActivity as $activity)
                                <div class="activity-item">
                                    <div class="activity-avatar">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                    <div class="activity-info">
                                        <h4 class="activity-student">{{ $activity['student_name'] }}</h4>
                                        <p class="activity-action">{{ $activity['action'] }} in <strong>{{ $activity['course_title'] }}</strong></p>
                                        <span class="activity-time">{{ $activity['time'] }}</span>
                                    </div>
                                    <div class="activity-status">
                                        <span class="status-indicator active"></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h3 class="empty-title">{{ __('No recent activity') }}</h3>
                            <p class="empty-description">{{ __('Student activity will appear here once they start engaging with your courses.') }}</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- AI Insights -->
            <div class="insights-panel">
                <div class="panel-header">
                    <div class="header-content">
                        <h2 class="panel-title">
                            <i class="fas fa-brain"></i>
                            {{ __('AI Insights') }}
                        </h2>
                        <p class="panel-subtitle">{{ __('Personalized recommendations') }}</p>
                    </div>
                </div>
                
                <div class="panel-content">
                    <div class="insights-list">
                        @foreach($aiInsights as $insight)
                            <div class="insight-card">
                                <div class="insight-header">
                                    <h4 class="insight-title">{{ $insight['title'] }}</h4>
                                    <div class="confidence-badge">
                                        <span class="confidence-value">{{ $insight['confidence'] }}%</span>
                                        <span class="confidence-label">{{ __('Confidence') }}</span>
                                    </div>
                                </div>
                                <p class="insight-description">{{ $insight['description'] }}</p>
                                <div class="insight-action">
                                    <i class="fas fa-lightbulb"></i>
                                    <span>{{ $insight['action'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="panel-footer">
                         <button class="btn-primary" onclick="window.location.href='{{ route('instructor.ai-summary') }}';">
                             {{ __('View Full AI Report') }}
                         </button>
                     </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Modern Dashboard Styling */
        .modern-dashboard-container {
            padding: 0;
            background: #f8fafc;
            min-height: 100vh;
        }

        /* Welcome Section */
        .welcome-section {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .welcome-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
        }

        .welcome-title {
            font-size: 2.25rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 0.5rem 0;
        }

        .welcome-subtitle {
            color: #64748b;
            margin: 0;
            font-size: 1.125rem;
        }

        .date-card {
            background: #f1f5f9;
            padding: 0.75rem 1.25rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #475569;
            font-weight: 500;
        }

        .date-card i {
            color: #3b82f6;
        }

        /* Stats Section */
        .stats-section {
            padding: 0 2rem;
            margin-bottom: 2rem;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #3b82f6;
        }

        .stat-card.courses::before { background: #3b82f6; }
        .stat-card.students::before { background: #10b981; }
        .stat-card.rating::before { background: #f59e0b; }
        .stat-card.reviews::before { background: #ef4444; }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: white;
        }

        .stat-card.courses .stat-icon { background: #3b82f6; }
        .stat-card.students .stat-icon { background: #10b981; }
        .stat-card.rating .stat-icon { background: #f59e0b; }
        .stat-card.reviews .stat-icon { background: #ef4444; }

        .stat-trend {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: #10b981;
        }

        .stat-value {
            font-size: 2.25rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 0.25rem 0;
        }

        .stat-label {
            color: #64748b;
            font-size: 0.875rem;
            margin: 0 0 1rem 0;
        }

        .stat-progress {
            height: 4px;
            background: #f1f5f9;
            border-radius: 2px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: #3b82f6;
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .stat-card.students .progress-bar { background: #10b981; }
        .stat-card.rating .progress-bar { background: #f59e0b; }
        .stat-card.reviews .progress-bar { background: #ef4444; }

        /* Actions Section */
        .actions-section {
            padding: 0 2rem;
            margin-bottom: 2rem;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 0.5rem 0;
        }

        .section-subtitle {
            color: #64748b;
            font-size: 1rem;
            margin: 0;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .action-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.5rem;
            text-decoration: none;
            color: inherit;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
        }

        .action-card:hover {
            border-color: #3b82f6;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.15);
            color: inherit;
            text-decoration: none;
        }

        .action-icon {
            width: 56px;
            height: 56px;
            background: #3b82f6;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .action-content {
            flex: 1;
        }

        .action-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 0.25rem 0;
        }

        .action-description {
            color: #64748b;
            font-size: 0.875rem;
            margin: 0 0 0.5rem 0;
        }

        .action-badge {
            background: #f1f5f9;
            color: #3b82f6;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .action-arrow {
            color: #94a3b8;
            font-size: 1.25rem;
            transition: all 0.2s ease;
        }

        .action-card:hover .action-arrow {
            color: #3b82f6;
            transform: translateX(4px);
        }

        /* Content Section */
        .content-section {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 2rem;
            padding: 0 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .activity-panel,
        .insights-panel {
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .panel-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .panel-subtitle {
            color: #64748b;
            font-size: 0.875rem;
            margin: 0.25rem 0 0 0;
        }

        .btn-outline {
            background: transparent;
            color: #3b82f6;
            border: 1px solid #3b82f6;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 500;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-outline:hover {
            background: #3b82f6;
            color: white;
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
            width: 100%;
        }

        .btn-primary:hover {
            background: #2563eb;
            transform: translateY(-1px);
        }

        .panel-content {
            padding: 1.5rem;
        }

        /* Activity List */
        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .activity-item:hover {
            background: #f1f5f9;
        }

        .activity-avatar {
            width: 48px;
            height: 48px;
            background: #3b82f6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .activity-info {
            flex: 1;
        }

        .activity-student {
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 0.25rem 0;
        }

        .activity-action {
            color: #64748b;
            font-size: 0.875rem;
            margin: 0 0 0.25rem 0;
        }

        .activity-time {
            color: #94a3b8;
            font-size: 0.75rem;
        }

        .status-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #10b981;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            background: #f1f5f9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: #94a3b8;
            font-size: 2rem;
        }

        .empty-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #64748b;
            margin: 0 0 0.5rem 0;
        }

        .empty-description {
            color: #94a3b8;
            font-size: 0.875rem;
            margin: 0;
        }

        /* Insights */
        .insights-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .insight-card {
            padding: 1rem;
            background: #f8fafc;
            border-radius: 8px;
            border-left: 4px solid #3b82f6;
        }

        .insight-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.5rem;
        }

        .insight-title {
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }

        .confidence-badge {
            text-align: center;
        }

        .confidence-value {
            display: block;
            font-size: 0.875rem;
            font-weight: 700;
            color: #3b82f6;
        }

        .confidence-label {
            font-size: 0.625rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .insight-description {
            color: #64748b;
            font-size: 0.875rem;
            margin: 0 0 0.75rem 0;
            line-height: 1.5;
        }

        .insight-action {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #3b82f6;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .panel-footer {
            padding: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .content-section {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .welcome-content {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .stats-section,
            .actions-section,
            .content-section {
                padding: 0 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .actions-grid {
                grid-template-columns: 1fr;
            }

            .action-card {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .action-arrow {
                display: none;
            }

            .welcome-title {
                font-size: 1.75rem;
            }

            .section-title {
                font-size: 1.5rem;
            }
        }
    </style>
@endsection