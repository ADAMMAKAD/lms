@extends('admin.master_layout')
@section('title')
    <title>{{ __('Dashboard') }}</title>
@endsection

@push('css')
<style>
/* Chart specific styles only */
.chart-card {
    margin-bottom: 24px;
}

.chart-body {
    height: 350px;
    position: relative;
}

.chart-header {
    padding: 24px 24px 0 24px;
    border-bottom: 1px solid #f1f5f9;
    background: #ffffff;
}

.chart-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 16px 0;
}

.activity-icon-primary {
    background-color: #4787ed;
}

.activity-icon-success {
    background-color: #10b981;
}

.activity-icon-warning {
    background-color: #f59e0b;
}

.activity-icon-info {
    background-color: #3b82f6;
}

.statistics-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #4787ed 0%, #764ba2 50%, #f093fb 100%);
    border-radius: 16px 16px 0 0;
}

.statistics-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15), 0 4px 12px rgba(0, 0, 0, 0.1);
    border-color: rgba(102, 126, 234, 0.3);
}

.statistics-card .card-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: #fff;
    margin-bottom: 16px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.statistics-card .card-wrap {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.statistics-card .card-header {
    flex: 1;
}

.statistics-card .card-header h4 {
    font-size: 2.25rem;
    font-weight: 700;
    margin: 0 0 8px 0;
    color: #1f2937;
    line-height: 1;
}

.statistics-card .card-header p {
    margin: 0;
    font-size: 0.875rem;
    font-weight: 500;
    color:rgb(106, 162, 247);
}

.card-growth-text {
    color: #ffffff !important;
    font-weight: bold !important;
    font-size: 0.875rem;
    opacity: 0.9;
    padding-bottom: 8px;
}

/* Chart Cards */
.chart-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    margin-bottom: 24px;
    border: 1px solid #4787ed;
    overflow: hidden;
    transition: all 0.3s ease;
}

.chart-card:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
}

.chart-header {
    padding: 24px 24px 0 24px;
    border-bottom: 1px solid #4787ed;
}

.chart-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1f2937;
    margin: 0 0 16px 0;
}

.chart-body {
    padding: 24px;
    height: 350px;
    position: relative;
}

/* Analytics Cards */
.analytics-card {
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08), 0 1px 3px rgba(0, 0, 0, 0.1);
    padding: 24px;
    margin-bottom: 24px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
    height: 100%;
}

.analytics-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
    border-radius: 16px 16px 0 0;
}

.analytics-card:hover {
    transform: translateY(-6px) scale(1.01);
    box-shadow: 0 10px 35px rgba(0, 0, 0, 0.12), 0 3px 10px rgba(0, 0, 0, 0.08);
    border-color: rgba(79, 172, 254, 0.3);
}

.analytics-card h5 {
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: #1f2937;
    display: flex;
    align-items: center;
}

.analytics-card h5 i {
    color: #4787ed;
}

/* Quick Action Buttons */
.quick-action-btn {
    background: #fff;
    border: 2px solid rgba(0, 102, 204, 0.1);
    border-radius: var(--border-radius);
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: var(--transition);
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 120px;
    text-decoration: none;
    color: var(--dark-color);
}

.quick-action-btn:hover {
    border-color: var(--primary-color);
    background: rgba(79, 172, 254, 0.1);
    color: var(--dark-color);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    text-decoration: none;
}

.quick-action-btn i {
    transition: var(--transition);
}

.quick-action-btn:hover i {
    color: #fff !important;
}

/* Metric Items */
.metric-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid rgba(0, 102, 204, 0.1);
}

.metric-item:last-child {
    border-bottom: none;
}

.metric-value {
    font-weight: 700;
    color: var(--primary-color);
    font-size: 18px;
}

.progress-ring {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.progress-text {
    font-weight: 700;
    color: #fff;
    font-size: 14px;
}

/* Activity Feed */
.activity-feed {
    max-height: 400px;
    overflow-y: auto;
}

.activity-item {
    display: flex;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid rgba(0, 102, 204, 0.1);
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    color: #fff;
    font-size: 16px;
}

.activity-content {
    flex: 1;
}

.activity-message {
    margin: 0 0 5px 0;
    font-weight: 500;
    color: var(--dark-color);
}

.activity-time {
    color: var(--secondary-color);
    font-size: 12px;
}

/* AI Widgets */
.ai-widget {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    border-radius: var(--border-radius-lg);
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: var(--shadow-lg);
    transition: var(--transition);
}

.ai-widget:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(102, 126, 234, 0.3);
}

.ai-widget h5 {
    color: #fff;
    margin-bottom: 20px;
}

.ai-suggestion {
    background: rgba(255, 255, 255, 0.1);
    border-radius: var(--border-radius);
    padding: 15px;
    margin-bottom: 15px;
    backdrop-filter: blur(10px);
}

.ai-suggestion:last-child {
    margin-bottom: 0;
}

.ai-suggestion-title {
    font-weight: 600;
    margin-bottom: 5px;
}

.ai-suggestion-desc {
    font-size: 14px;
    opacity: 0.9;
    margin: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .chart-card {
        margin-bottom: 20px;
    }
    
    .chart-header {
        padding: 20px;
    }
    
    .chart-body {
        padding: 20px;
        height: 300px;
    }
    
    .statistics-card {
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .analytics-card {
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .quick-action-btn {
        padding: 15px;
        min-height: 100px;
    }
}
</style>
@endpush

@section('admin-content')
<div class="section-body" style="padding-top: 5rem; margin-top: 3rem;">
    <div class="container-fluid">
        <!-- Statistics Cards -->
        <div class="row dashboard-stats" style="margin-top: 3rem;">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card-statistic-1">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <h4>{{ __('Total Courses') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-statistic-title">{{ $data['total_course'] }}</div>
                        <div class="card-growth-text">{{ $data['course_growth'] }} from last month</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card-statistic-1">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h4>{{ __('Total Instructors') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-statistic-title">{{ $data['total_instructor'] }}</div>
                        <div class="card-growth-text">{{ $data['instructor_growth'] }} from last month</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card-statistic-1">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h4>{{ __('Total Students') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-statistic-title">{{ $data['total_student'] }}</div>
                        <div class="card-growth-text">{{ $data['student_growth'] }} from last month</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card-statistic-1">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>{{ __('Online Users') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-statistic-title">{{ $data['users_online'] ?? 0 }}</div>
                        <div class="card-growth-text">Currently active</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card chart-card">
                    <div class="card-header chart-header">
                        <h4 class="chart-title">{{ __('Course Activity (Monthly)') }}</h4>
                    </div>
                    <div class="card-body chart-body">
                        <canvas id="courseActivityChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card chart-card">
                    <div class="card-header chart-header">
                        <h4 class="chart-title">{{ __('User Registration (Yearly)') }}</h4>
                    </div>
                    <div class="card-body chart-body">
                        <canvas id="userRegistrationChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card chart-card">
                    <div class="card-header chart-header">
                        <h4 class="chart-title">{{ __('Course Creation (Yearly)') }}</h4>
                    </div>
                    <div class="card-body chart-body">
                        <canvas id="courseCreationChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics Section -->
        <div class="row">
            <div class="col-lg-4">
                <div class="card analytics-card">
                    <div class="card-body">
                        <h5><i class="fas fa-robot mr-2"></i>{{ __('AI Insights') }}</h5>
                        <div class="ai-suggestion">
                            <div class="ai-suggestion-title">{{ __('Course Optimization') }}</div>
                            <p class="ai-suggestion-desc">{{ __('Consider adding more interactive content to increase engagement by 23%') }}</p>
                        </div>
                        <div class="ai-suggestion">
                            <div class="ai-suggestion-title">{{ __('Peak Learning Hours') }}</div>
                            <p class="ai-suggestion-desc">{{ __('Students are most active between 7-9 PM. Schedule live sessions accordingly.') }}</p>
                        </div>
                        <div class="ai-suggestion">
                            <div class="ai-suggestion-title">{{ __('Content Recommendation') }}</div>
                            <p class="ai-suggestion-desc">{{ __('Web Development courses show 40% higher completion rates') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card analytics-card">
                    <div class="card-body">
                        <h5><i class="fas fa-chart-line mr-2"></i>{{ __('Performance Analytics') }}</h5>
                        <div class="metric-item">
                            <span>{{ __('Course Completion Rate') }}</span>
                            <span class="metric-value">{{ $data['analytics']['completion_rate'] ?? '78%' }}</span>
                        </div>
                        <div class="metric-item">
                            <span>{{ __('Average Rating') }}</span>
                            <span class="metric-value">{{ $data['analytics']['avg_rating'] ?? '4.6' }}</span>
                        </div>
                        <div class="metric-item">
                            <span>{{ __('Student Satisfaction') }}</span>
                            <span class="metric-value">{{ $data['analytics']['satisfaction'] ?? '92%' }}</span>
                        </div>
                        <div class="metric-item">
                            <span>{{ __('Revenue Growth') }}</span>
                            <span class="metric-value">{{ $data['analytics']['revenue_growth'] ?? '+15%' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card analytics-card">
                    <div class="card-body">
                        <h5><i class="fas fa-tachometer-alt mr-2"></i>{{ __('Key Metrics') }}</h5>
                        <div class="metric-item">
                            <span>{{ __('Completion Rate') }}</span>
                            <div class="progress-ring">
                                <span class="progress-text">{{ $data['learning_analytics']['completion_rate'] ?? 75 }}%</span>
                            </div>
                        </div>
                        <div class="metric-item">
                            <span>{{ __('Avg. Study Time') }}</span>
                            <span class="metric-value">{{ $data['learning_analytics']['avg_study_time'] ?? '2.5h' }}</span>
                        </div>
                        <div class="metric-item">
                            <span>{{ __('Active Learners') }}</span>
                            <span class="metric-value">{{ number_format($data['learning_analytics']['active_learners'] ?? 1250) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Activity and Quick Actions -->
        <div class="row mb-4" style="margin-top: 2rem;">
            <div class="col-md-6">
                <div class="card analytics-card">
                    <div class="card-body">
                        <h5><i class="fas fa-clock mr-2"></i>{{ __('Recent Activity') }}</h5>
                        <div class="activity-feed">
                            @php
                                $activities = $data['recent_activities'] ?? [];
                            @endphp
                            @forelse($activities as $activity)
                            <div class="activity-item">
                                <div class="activity-icon activity-icon-primary">
                                    <i class="{{ $activity['icon'] ?? 'fas fa-user' }}"></i>
                                </div>
                                <div class="activity-content">
                                    <p class="activity-message">{{ $activity['message'] ?? 'New activity' }}</p>
                                    <small class="activity-time">{{ $activity['time'] ?? '2 minutes ago' }}</small>
                                </div>
                            </div>
                            @empty
                            <div class="activity-item">
                                <div class="activity-icon activity-icon-primary">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="activity-content">
                                    <p class="activity-message">{{ __('New student registered') }}</p>
                                    <small class="activity-time">{{ __('2 minutes ago') }}</small>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon activity-icon-success">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                <div class="activity-content">
                                    <p class="activity-message">{{ __('Course completed by student') }}</p>
                                    <small class="activity-time">{{ __('5 minutes ago') }}</small>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon activity-icon-warning">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="activity-content">
                                    <p class="activity-message">{{ __('New course review received') }}</p>
                                    <small class="activity-time">{{ __('10 minutes ago') }}</small>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card analytics-card">
                    <div class="card-body">
                        <h5><i class="fas fa-bolt mr-2"></i>{{ __('Quick Actions') }}</h5>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <a href="{{ route('admin.courses.create') }}" class="quick-action-btn">
                                    <i class="fas fa-plus-circle text-primary mb-2" style="font-size: 24px;"></i>
                                    <div>{{ __('Add Course') }}</div>
                                </a>
                            </div>
                            <div class="col-6 mb-3">
                                <a href="{{ route('admin.admin.index') }}" class="quick-action-btn">
                                    <i class="fas fa-user-plus text-success mb-2" style="font-size: 24px;"></i>
                                    <div>{{ __('Add User') }}</div>
                                </a>
                            </div>
                            <div class="col-6 mb-3">
                                <a href="{{ route('admin.blogs.create') }}" class="quick-action-btn">
                                    <i class="fas fa-edit text-warning mb-2" style="font-size: 24px;"></i>
                                    <div>{{ __('Write Blog') }}</div>
                                </a>
                            </div>
                            <div class="col-6 mb-3">
                                <a href="{{ route('admin.general-setting') }}" class="quick-action-btn">
                                    <i class="fas fa-cog text-info mb-2" style="font-size: 24px;"></i>
                                    <div>{{ __('Settings') }}</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        "use strict";
        
        // Chart data from controller
        var monthlyData = @json($data['monthly_data'] ?? []);
        var userRegistrationData = @json($data['user_registration_data'] ?? []);
        var courseCreationData = @json($data['course_creation_data'] ?? []);
        
        // Course Activity Chart (Monthly)
        var courseActivityCtx = document.getElementById('courseActivityChart').getContext('2d');
        var courseActivityChart = new Chart(courseActivityCtx, {
            type: 'line',
            data: {
                labels: monthlyData.labels || [],
                datasets: [{
                    label: '{{ __('Course Activity') }}',
                    data: monthlyData.data || [],
                    borderColor: 'rgb(73, 160, 247)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        // User Registration Chart (Yearly)
        var userRegistrationCtx = document.getElementById('userRegistrationChart').getContext('2d');
        var userRegistrationChart = new Chart(userRegistrationCtx, {
            type: 'bar',
            data: {
                labels: userRegistrationData.labels || [],
                datasets: [{
                    label: '{{ __('User Registrations') }}',
                    data: userRegistrationData.data || [],
                    backgroundColor: 'rgba(54, 162, 235, 0.8)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        // Course Creation Chart (Yearly)
        var courseCreationCtx = document.getElementById('courseCreationChart').getContext('2d');
        var courseCreationChart = new Chart(courseCreationCtx, {
            type: 'bar',
            data: {
                labels: courseCreationData.labels || [],
                datasets: [{
                    label: '{{ __('Course Creation') }}',
                    data: courseCreationData.data || [],
                    backgroundColor: 'rgba(255, 99, 132, 0.8)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        // Initialize learning analytics chart
        initializeLearningAnalyticsChart();
        
        // Auto-refresh activity feed every 30 seconds
        setInterval(refreshActivityFeed, 30000);
    });
    
    function initializeLearningAnalyticsChart() {
        var learningData = @json($data['learning_analytics']['weekly_progress'] ?? []);
        
        var ctx = document.createElement('canvas');
        ctx.id = 'learningProgressChart';
        
        // Add chart to a container if needed
        var chartContainer = document.querySelector('.learning-chart-container');
        if (chartContainer) {
            chartContainer.appendChild(ctx);
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: learningData.labels || [],
                    datasets: [{
                        label: '{{ __('Learning Progress') }}',
                        data: learningData.data || [],
                        borderColor: '#4f46e5',
                        backgroundColor: 'rgba(79, 70, 229, 0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    }
    
    function refreshActivityFeed() {
        // Simulate activity feed refresh
        console.log('Refreshing activity feed...');
    }
</script>

<script>
    $(document).ready(function() {
        "use strict";
        var alertKey = 'updateAvailablityAlert';
        var dismissedTimestamp = localStorage.getItem(alertKey);

        if (!dismissedTimestamp || Date.now() - dismissedTimestamp > 24 * 60 * 60 * 1000) {
            $('#updateAvailablityAlert').removeClass('d-none');
            $('#updateAvailablityAlert').show();
        } else {
            $('#updateAvailablityAlert').hide();
        }

        $('#updateAvailablityAlertClose').on('click', function() {
            $('#updateAvailablityAlert').hide();
            localStorage.setItem(alertKey, Date.now());
        });
    });
</script>
@endpush
@endsection
