@extends('frontend.instructor-dashboard.layouts.master')

@section('dashboard-content')
    <div class="modern-analytics-container">
        <!-- Header Section -->
        <div class="analytics-header">
            <div class="header-content">
                <div class="header-text">
                    <h2 class="page-title">{{ __('Analytics Dashboard') }}</h2>
                    <p class="page-subtitle">{{ __('Track your teaching performance and student engagement') }}</p>
                </div>
                <div class="header-actions">
                    <select class="modern-select" id="dateFilter">
                        <option value="7">{{ __('Last 7 days') }}</option>
                        <option value="30" selected>{{ __('Last 30 days') }}</option>
                        <option value="90">{{ __('Last 3 months') }}</option>
                        <option value="365">{{ __('Last year') }}</option>
                    </select>
                    <button class="btn-primary">
                        <i class="fas fa-download"></i>
                        {{ __('Export Report') }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Key Metrics Grid -->
        <div class="metrics-grid">
            <div class="metric-card">
                <div class="metric-header">
                    <div class="metric-icon students">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="metric-trend positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>+12%</span>
                    </div>
                </div>
                <div class="metric-body">
                    <h3 class="metric-value">{{ $analytics['total_students'] }}</h3>
                    <p class="metric-label">{{ __('Total Students') }}</p>
                </div>
            </div>

            <div class="metric-card">
                <div class="metric-header">
                    <div class="metric-icon courses">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="metric-trend positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>+5%</span>
                    </div>
                </div>
                <div class="metric-body">
                    <h3 class="metric-value">{{ $analytics['total_courses'] }}</h3>
                    <p class="metric-label">{{ __('Active Courses') }}</p>
                </div>
            </div>

            <div class="metric-card">
                <div class="metric-header">
                    <div class="metric-icon engagement">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="metric-trend positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>+8%</span>
                    </div>
                </div>
                <div class="metric-body">
                    <h3 class="metric-value">{{ $analytics['avg_engagement'] }}%</h3>
                    <p class="metric-label">{{ __('Avg Engagement') }}</p>
                </div>
            </div>

            <div class="metric-card">
                <div class="metric-header">
                    <div class="metric-icon rating">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="metric-trend positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>+0.2</span>
                    </div>
                </div>
                <div class="metric-body">
                    <h3 class="metric-value">{{ $analytics['avg_rating'] }}</h3>
                    <p class="metric-label">{{ __('Average Rating') }}</p>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="charts-section">
            <div class="chart-container main-chart">
                <div class="chart-header">
                    <h3 class="chart-title">{{ __('Student Enrollment Trends') }}</h3>
                    <div class="chart-controls">
                        <button class="btn-secondary active" data-chart="enrollment">{{ __('Enrollment') }}</button>
                        <button class="btn-secondary" data-chart="completion">{{ __('Completion') }}</button>
                    </div>
                </div>
                <div class="chart-body">
                    <canvas id="enrollmentChart" width="400" height="200"></canvas>
                </div>
            </div>

            <div class="chart-container side-chart">
                <div class="chart-header">
                    <h3 class="chart-title">{{ __('Course Performance') }}</h3>
                </div>
                <div class="chart-body">
                    <canvas id="performanceChart" width="200" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Data Tables Section -->
        <div class="data-section">
            <div class="data-card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Top Performing Courses') }}</h3>
                    <button class="btn-outline">{{ __('View All') }}</button>
                </div>
                <div class="card-content">
                    @foreach($analytics['top_courses'] as $course)
                        <div class="course-row">
                            <div class="course-info">
                                <h4 class="course-title">{{ $course['title'] }}</h4>
                                <p class="course-meta">{{ $course['students'] }} {{ __('students enrolled') }}</p>
                            </div>
                            <div class="course-stats">
                                <div class="stat-item">
                                    <span class="stat-value">{{ $course['completion_rate'] }}%</span>
                                    <span class="stat-label">{{ __('Completion') }}</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-value">{{ $course['rating'] }}</span>
                                    <span class="stat-label">{{ __('Rating') }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="data-card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Recent Student Activity') }}</h3>
                    <button class="btn-outline">{{ __('View All') }}</button>
                </div>
                <div class="card-content">
                    @foreach($analytics['recent_activity'] as $activity)
                        <div class="activity-row">
                            <div class="activity-avatar">
                                <img src="{{ $activity['avatar'] ?? '/assets/img/default-avatar.png' }}" alt="{{ $activity['student_name'] }}">
                            </div>
                            <div class="activity-info">
                                <h4 class="activity-student">{{ $activity['student_name'] }}</h4>
                                <p class="activity-action">{{ $activity['action'] }}</p>
                                <span class="activity-time">{{ $activity['time'] }}</span>
                            </div>
                            <div class="activity-status">
                                @if($activity['type'] == 'completion')
                                    <span class="status-badge completed">{{ __('Completed') }}</span>
                                @elseif($activity['type'] == 'enrollment')
                                    <span class="status-badge enrolled">{{ __('Enrolled') }}</span>
                                @else
                                    <span class="status-badge active">{{ __('Active') }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Engagement Heatmap -->
        <div class="heatmap-section">
            <div class="heatmap-card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Student Engagement Heatmap') }}</h3>
                    <p class="card-subtitle">{{ __('Track when your students are most active') }}</p>
                </div>
                <div class="card-content">
                    <div class="heatmap-container">
                        <div class="heatmap-grid" id="engagementHeatmap">
                            <div class="time-labels">
                                @for($hour = 0; $hour < 24; $hour++)
                                    <div class="time-label">{{ sprintf('%02d:00', $hour) }}</div>
                                @endfor
                            </div>
                            <div class="day-grid">
                                @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                                    <div class="day-row">
                                        <div class="day-label">{{ __($day) }}</div>
                                        <div class="hour-cells">
                                            @for($hour = 0; $hour < 24; $hour++)
                                                <div class="hour-cell" data-intensity="{{ rand(0, 100) }}"></div>
                                            @endfor
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="heatmap-legend">
                            <span class="legend-label">{{ __('Less') }}</span>
                            <div class="legend-scale">
                                <div class="legend-cell level-0"></div>
                                <div class="legend-cell level-1"></div>
                                <div class="legend-cell level-2"></div>
                                <div class="legend-cell level-3"></div>
                                <div class="legend-cell level-4"></div>
                            </div>
                            <span class="legend-label">{{ __('More') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Modern Analytics Styling */
        .modern-analytics-container {
            padding: 0;
            background: #f8fafc;
            min-height: 100vh;
        }

        /* Header Section */
        .analytics-header {
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

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 0.5rem 0;
        }

        .page-subtitle {
            color: #64748b;
            margin: 0;
            font-size: 1rem;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        /* Modern Form Elements */
        .modern-select {
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            color: #374151;
            min-width: 160px;
            transition: all 0.2s ease;
        }

        .modern-select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Button Styles */
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

        .btn-secondary {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 500;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        .btn-secondary.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
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

        /* Metrics Grid */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
            padding: 0 2rem;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }

        .metric-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }

        .metric-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .metric-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .metric-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: white;
        }

        .metric-icon.students { background: #3b82f6; }
        .metric-icon.courses { background: #10b981; }
        .metric-icon.engagement { background: #f59e0b; }
        .metric-icon.rating { background: #ef4444; }

        .metric-trend {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .metric-trend.positive {
            color: #10b981;
        }

        .metric-value {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 0.25rem 0;
        }

        .metric-label {
            color: #64748b;
            font-size: 0.875rem;
            margin: 0;
        }

        /* Charts Section */
        .charts-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
            padding: 0 2rem;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }

        .chart-container {
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .chart-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chart-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }

        .chart-controls {
            display: flex;
            gap: 0.5rem;
        }

        .chart-body {
            padding: 1.5rem;
        }

        /* Data Section */
        .data-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
            padding: 0 2rem;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }

        .data-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }

        .card-subtitle {
            color: #64748b;
            font-size: 0.875rem;
            margin: 0.25rem 0 0 0;
        }

        .card-content {
            padding: 1.5rem;
        }

        /* Course Rows */
        .course-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .course-row:last-child {
            border-bottom: none;
        }

        .course-title {
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 0.25rem 0;
        }

        .course-meta {
            color: #64748b;
            font-size: 0.875rem;
            margin: 0;
        }

        .course-stats {
            display: flex;
            gap: 1.5rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            display: block;
            font-size: 1.125rem;
            font-weight: 700;
            color: #3b82f6;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Activity Rows */
        .activity-row {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .activity-row:last-child {
            border-bottom: none;
        }

        .activity-avatar {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            overflow: hidden;
            margin-right: 1rem;
        }

        .activity-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .status-badge.completed {
            background: #dcfce7;
            color: #166534;
        }

        .status-badge.enrolled {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-badge.active {
            background: #fef3c7;
            color: #92400e;
        }

        /* Heatmap Section */
        .heatmap-section {
            padding: 0 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .heatmap-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .heatmap-container {
            padding: 1rem;
        }

        .heatmap-grid {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .time-labels {
            display: grid;
            grid-template-columns: 60px repeat(24, 1fr);
            gap: 2px;
            margin-bottom: 0.5rem;
        }

        .time-label {
            font-size: 0.75rem;
            color: #64748b;
            text-align: center;
            padding: 0.25rem;
        }

        .time-label:first-child {
            grid-column: 1;
        }

        .day-grid {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .day-row {
            display: grid;
            grid-template-columns: 60px repeat(24, 1fr);
            gap: 2px;
            align-items: center;
        }

        .day-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            text-align: center;
        }

        .hour-cells {
            display: contents;
        }

        .hour-cell {
            width: 100%;
            height: 20px;
            border-radius: 3px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .hour-cell[data-intensity]:hover {
            transform: scale(1.1);
        }

        /* Default background for all hour cells */
        .hour-cell {
            background: #f1f5f9;
        }
        
        /* Intensity levels will be applied via JavaScript */
        .hour-cell.intensity-1 { background: #e2e8f0; }
        .hour-cell.intensity-2 { background: #c7d2fe; }
        .hour-cell.intensity-3 { background: #a5b4fc; }
        .hour-cell.intensity-4 { background: #818cf8; }
        .hour-cell.intensity-5 { background: #6366f1; }

        .heatmap-legend {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .legend-label {
            font-size: 0.75rem;
            color: #64748b;
        }

        .legend-scale {
            display: flex;
            gap: 2px;
        }

        .legend-cell {
            width: 12px;
            height: 12px;
            border-radius: 2px;
        }

        .legend-cell.level-0 { background: #f1f5f9; }
        .legend-cell.level-1 { background: #c7d2fe; }
        .legend-cell.level-2 { background: #a5b4fc; }
        .legend-cell.level-3 { background: #6366f1; }
        .legend-cell.level-4 { background: #4f46e5; }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .charts-section {
                grid-template-columns: 1fr;
            }
            
            .data-section {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .header-actions {
                justify-content: space-between;
            }

            .metrics-grid {
                grid-template-columns: 1fr;
                padding: 0 1rem;
            }

            .charts-section,
            .data-section,
            .heatmap-section {
                padding: 0 1rem;
            }

            .course-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .course-stats {
                align-self: stretch;
                justify-content: space-around;
            }

            .time-labels,
            .day-row {
                grid-template-columns: 40px repeat(24, 1fr);
            }

            .time-label,
            .day-label {
                font-size: 0.625rem;
            }

            .hour-cell {
                height: 15px;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeCharts();
            generateHeatmap();
            
            // Date filter change
            document.getElementById('dateFilter').addEventListener('change', function() {
                updateAnalytics(this.value);
            });
            
            // Chart controls
            document.querySelectorAll('[data-chart]').forEach(button => {
                button.addEventListener('click', function() {
                    document.querySelectorAll('[data-chart]').forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    updateChart(this.dataset.chart);
                });
            });
        });

        function initializeCharts() {
            // Enrollment Chart
            const enrollmentCtx = document.getElementById('enrollmentChart').getContext('2d');
            new Chart(enrollmentCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'New Enrollments',
                        data: [12, 19, 15, 25, 22, 30],
                        borderColor: '#6777ef',
                        backgroundColor: 'rgba(103, 119, 239, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f8f9fa'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Performance Chart (Doughnut)
            const performanceCtx = document.getElementById('performanceChart').getContext('2d');
            new Chart(performanceCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Completed', 'In Progress', 'Not Started'],
                    datasets: [{
                        data: [65, 25, 10],
                        backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        function generateHeatmap() {
            // Apply dynamic intensity values to existing hour cells
            const hourCells = document.querySelectorAll('.hour-cell');
            
            hourCells.forEach((cell, index) => {
                // Generate random engagement data for demo
                const intensity = Math.floor(Math.random() * 101); // 0-100
                
                // Remove any existing intensity classes
                cell.className = cell.className.replace(/intensity-\d+/g, '').trim();
                
                // Add appropriate intensity class
                let intensityClass = '';
                if (intensity === 0) {
                    intensityClass = ''; // Use default background
                } else if (intensity <= 20) {
                    intensityClass = 'intensity-1';
                } else if (intensity <= 40) {
                    intensityClass = 'intensity-2';
                } else if (intensity <= 60) {
                    intensityClass = 'intensity-3';
                } else if (intensity <= 80) {
                    intensityClass = 'intensity-4';
                } else {
                    intensityClass = 'intensity-5';
                }
                
                if (intensityClass) {
                    cell.classList.add(intensityClass);
                }
                
                // Add data attribute for reference and tooltip
                cell.setAttribute('data-intensity', intensity);
                
                // Add tooltip
                const day = Math.floor(index / 24);
                const hour = index % 24;
                const dayNames = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                cell.title = `${dayNames[day]}, ${hour.toString().padStart(2, '0')}:00 - ${intensity}% engagement`;
            });
        }

        function updateAnalytics(period) {
            console.log('Updating analytics for period:', period);
            // Here you would fetch new data based on the selected period
        }

        function updateChart(chartType) {
            console.log('Updating chart:', chartType);
            // Here you would update the chart data based on the selected type
        }
    </script>
@endsection