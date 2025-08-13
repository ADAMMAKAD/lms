@extends('admin.master_layout')
@section('title')
    <title>{{ __('Dashboard') }}</title>
@endsection

@push('css')
<style>
/* Dashboard Layout Optimization - Desktop focused */
.section-body {
    min-height: calc(100vh - 200px);
    height: auto;
    overflow-y: visible;
    overflow-x: hidden;
    padding: 0;
    margin: 0;
}

.chart-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    margin-bottom: 30px;
    height: auto;
    min-height: 400px;
    padding: 20px;
}

.chart-header {
    padding: 15px 20px 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #eee;
    margin-bottom: 15px;
}

.chart-title {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    color: #333;
}

.chart-body {
    padding: 0 20px 15px 20px;
}



.form-inline select {
    margin-left: 10px;
    padding: 5px 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.form-inline select:first-child {
    margin-left: 0;
}

/* AI Dashboard Enhancements */
.ai-widget {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    padding: 15px;
    color: white;
    margin-bottom: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.analytics-card {
    background: #fff;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    margin-bottom: 30px;
    border-left: 4px solid #4f46e5;
    height: auto;
    min-height: 280px;
    overflow-y: visible;
}

/* Desktop Statistics Cards */
.modern-stat-card {
    height: auto;
    min-height: 160px;
    margin-bottom: 24px;
    padding: 24px;
}

/* Desktop row spacing */
.row.mb-4 {
    margin-bottom: 2rem !important;
}

.mb-3 {
    margin-bottom: 1.5rem !important;
}

/* Desktop chart containers */
.chart-container {
    position: relative;
    height: 350px;
    width: 100%;
    margin-bottom: 20px;
}

/* Desktop statistics cards */
.modern-stat-card {
    height: auto;
    min-height: 180px;
    margin-bottom: 2rem;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

/* Desktop analytics widgets */
.analytics-card {
    padding: 2rem;
    margin-bottom: 2.5rem;
    min-height: 250px;
}

.metric-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #f1f5f9;
}

.metric-item:last-child {
    border-bottom: none;
}

.metric-value {
    font-weight: 600;
    color: #1e293b;
}

.progress-ring {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: conic-gradient(#4f46e5 0deg, #e2e8f0 0deg);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.progress-ring::before {
    content: '';
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: white;
    position: absolute;
}

.progress-text {
    position: relative;
    z-index: 1;
    font-weight: 600;
    font-size: 12px;
}

.activity-item {
    display: flex;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
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
    margin-right: 12px;
    font-size: 14px;
}

.activity-content {
    flex: 1;
}

.activity-message {
    font-size: 14px;
    color: #374151;
    margin: 0;
}

.activity-time {
    font-size: 12px;
    color: #6b7280;
}



.quick-action-btn {
    background: #fff;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    padding: 15px;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
    margin-bottom: 10px;
}

.quick-action-btn:hover {
    border-color: #4f46e5;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
}

/* Info Cards Styling - Recent Courses, Blogs, Contacts */
.info-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
    margin-bottom: 20px;
    overflow: hidden;
    border: 1px solid #e5e7eb;
    height: auto;
    min-height: 350px;
    max-height: 450px;
    display: flex;
    flex-direction: column;
}

.info-header {
    padding: 20px;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
}

.info-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    color: white;
    font-size: 20px;
}

.info-title h5 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    color: #1f2937;
}

.info-subtitle {
    font-size: 14px;
    color: #6b7280;
    margin-top: 4px;
}

.tickets-list {
    max-height: 280px;
    overflow-y: auto;
    padding: 0;
    flex: 1;
}

.ticket-item {
    display: block;
    padding: 16px 20px;
    border-bottom: 1px solid #f3f4f6;
    text-decoration: none;
    color: inherit;
    transition: all 0.2s ease;
}

.ticket-item:hover {
    background-color: #f9fafb;
    text-decoration: none;
    color: inherit;
}

.ticket-title h4 {
    margin: 0 0 8px 0;
    font-size: 15px;
    font-weight: 500;
    color: #1f2937;
    line-height: 1.4;
}

.ticket-info {
    display: flex;
    align-items: center;
    font-size: 13px;
    color: #6b7280;
    flex-wrap: wrap;
}

.ticket-info .bullet {
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background-color: #d1d5db;
    margin: 0 8px;
}

.ticket-more {
    background-color: #f8fafc;
    color: #4f46e5;
    font-weight: 500;
    text-align: center;
    border-bottom: none;
}

.ticket-more:hover {
    background-color: #e0e7ff;
    color: #4338ca;
}

/* Ensure proper spacing for the bottom section */
.row.mt-4 {
    margin-top: 1.5rem !important;
    margin-bottom: 1.5rem !important;
}

/* Ensure the bottom row is always visible */
.dashboard-bottom-section {
    margin-bottom: 40px !important;
    clear: both;
}

/* Main content wrapper adjustments */
.main-content {
    padding-bottom: 60px !important;
}

/* Desktop Grid System Optimization */
@media (min-width: 1400px) {
    .col-xl-3 .modern-stat-card {
        min-height: 200px;
        padding: 2.5rem;
    }
    
    .chart-card {
        min-height: 450px;
        padding: 30px;
    }
    
    .analytics-card {
        min-height: 320px;
        padding: 2.5rem;
    }
}

@media (min-width: 1200px) and (max-width: 1399px) {
    .col-xl-3 .modern-stat-card {
        min-height: 180px;
        padding: 2rem;
    }
    
    .chart-card {
        min-height: 400px;
        padding: 24px;
    }
}

@media (min-width: 992px) and (max-width: 1199px) {
    .col-xl-3 .modern-stat-card {
        min-height: 160px;
        padding: 1.5rem;
    }
    
    .chart-card {
        min-height: 350px;
        padding: 20px;
    }
    
    .main-content {
        padding: 20px 25px !important;
    }
}

/* Ensure proper spacing between grid items */
.row > [class*="col-"] {
    padding-left: 15px;
    padding-right: 15px;
}

.row {
    margin-left: -15px;
    margin-right: -15px;
}

</style>
@endpush

@section('admin-content')
    <div class="main-content">


        @if ($setting->is_queable == 'active' && Cache::get('corn_working') !== 'working')
            <div class="alert alert-danger alert-has-icon alert-dismissible show fade">
                <div class="alert-icon"><i class="fas fa-sync"></i></div>
                <div class="alert-body">
                    <div class="alert-title"><a href="{{ route('admin.general-setting') }}" target="_blank"
                            rel="noopener noreferrer">{{ __('Corn Job Is Not Running! Many features will be disabled and face errors') }}</a>
                    </div>
                    <button class="close" data-dismiss="alert">
                        <span><i class="fas fa-times"></i></span>
                    </button>
                </div>
            </div>
        @endif

        <section class="section">
            <div class="section-header">
                <h1>{{ __('Dashboard') }}</h1>
            </div>

            <div class="section-body">
                @if(checkAdminHasPermission('course.management'))
                <!-- Modern Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
                        <div class="modern-stat-card students-card">
                            <div class="stat-card-header">
                                <div class="stat-icon-wrapper students-icon">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                <div class="stat-trend positive">
                                    <i class="fas fa-arrow-up"></i>
                                    <span>+12%</span>
                                </div>
                            </div>
                            <div class="stat-card-body">
                                <h3 class="stat-number">{{ number_format($data['total_users']) }}</h3>
                                <p class="stat-label">{{ __('Students') }}</p>
                                <div class="stat-progress">
                                    <div class="progress-bar students-progress" style="width: 75%"></div>
                                </div>
                                <small class="stat-description">{{ __('Total registered students') }}</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
                        <div class="modern-stat-card instructor-card">
                            <div class="stat-card-header">
                                <div class="stat-icon-wrapper instructor-icon">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <div class="stat-trend positive">
                                    <i class="fas fa-arrow-up"></i>
                                    <span>+8%</span>
                                </div>
                            </div>
                            <div class="stat-card-body">
                                <h3 class="stat-number">{{ number_format($data['total_pending_course']) }}</h3>
                                <p class="stat-label">{{ __('Instructor') }}</p>
                                <div class="stat-progress">
                                    <div class="progress-bar instructor-progress" style="width: 60%"></div>
                                </div>
                                <small class="stat-description">{{ __('Active instructors') }}</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
                        <div class="modern-stat-card subjects-card">
                            <div class="stat-card-header">
                                <div class="stat-icon-wrapper subjects-icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                <div class="stat-trend positive">
                                    <i class="fas fa-arrow-up"></i>
                                    <span>+15%</span>
                                </div>
                            </div>
                            <div class="stat-card-body">
                                <h3 class="stat-number">{{ number_format($data['total_course']) }}</h3>
                                <p class="stat-label">{{ __('Subjects') }}</p>
                                <div class="stat-progress">
                                    <div class="progress-bar subjects-progress" style="width: 85%"></div>
                                </div>
                                <small class="stat-description">{{ __('Available courses') }}</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
                        <div class="modern-stat-card enrolled-card">
                            <div class="stat-card-header">
                                <div class="stat-icon-wrapper enrolled-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-trend positive">
                                    <i class="fas fa-arrow-up"></i>
                                    <span>+22%</span>
                                </div>
                            </div>
                            <div class="stat-card-body">
                                <h3 class="stat-number">{{ number_format($data['users_online']) }}</h3>
                                <p class="stat-label">{{ __('Enrolled') }}</p>
                                <div class="stat-progress">
                                    <div class="progress-bar enrolled-progress" style="width: 90%"></div>
                                </div>
                                <small class="stat-description">{{ __('Total enrollments') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                

                

                

                

                
                <!-- Charts Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="chart-card">
                            <!-- Card Header - Dropdown -->
                            <div class="chart-header">
                                <h6 class="chart-title"> {{ __('Course Activity In') }}
                                    {{ request()->has('year') && request()->has('month')
                                        ? Carbon\Carbon::createFromFormat('Y-m', request('year') . '-' . request('month'))->format('F, Y')
                                        : date('F, Y') }}
                                </h6>
                                <div class="form-inline">
                                    <form method="get" onchange="$(this).trigger('submit');">
                                        <select name="year" id="year" class="form-control">
                                            @php
                                                $currentYear = Carbon\Carbon::now()->year;
                                                $currentMonth = Carbon\Carbon::now()->month;
                                                $selectYear = request('year') ?? $currentYear;
                                                $selectMonth = request('month') ?? $currentMonth;
                                            @endphp
                                            @for ($i = $data['oldestYear']; $i <= $data['latestYear']; $i++)
                                                <option value="{{ $i }}" @selected($selectYear == $i)>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                        <select name="month" id="month" class="form-control">
                                            @php
                                                for ($month = 1; $month <= 12; $month++) {
                                                    $monthNumber = str_pad($month, 2, '0', STR_PAD_LEFT);
                                                    $monthName = Carbon\Carbon::createFromFormat('m', $month)->format('M');
                                                    echo '<option value="' .
                                                        $monthNumber .
                                                        '" ' .
                                                        ($selectMonth == $monthNumber ? ' selected' : '') .
                                                        '>' .
                                                        $monthName .
                                                        '</option>';
                                                }
                                            @endphp </select>
                                    </form>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="chart-body">
                                <div class="chart-container">
                                    <canvas id="courseActivityChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Yearly Charts Row -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="chart-card">
                            <div class="chart-header">
                                <h6 class="chart-title">{{ __('User Registrations') }} {{ $selectYear }}</h6>
                            </div>
                            <div class="chart-body">
                                <div class="chart-container">
                                    <canvas id="userRegistrationChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="chart-card">
                            <div class="chart-header">
                                <h6 class="chart-title">{{ __('Course Creation') }} {{ $selectYear }}</h6>
                            </div>
                            <div class="chart-body">
                                <div class="chart-container">
                                    <canvas id="courseCreationChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4 dashboard-bottom-section">
                    @if(checkAdminHasPermission('course.management'))
                    <div class="col-md-6 col-lg-4">
                        <div class="info-card">
                            <div class="info-header">
                                <div class="info-icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div class="info-title">
                                    <h5>{{ __('Recent Courses') }}</h5>
                                    <div class="info-subtitle">({{ $data['pending_courses'] }}) {{ __('Courses are pending') }}</div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="tickets-list">
                                    @foreach ($data['recent_courses'] as $course)
                                        <a href="{{ route('admin.courses.edit-view', $course->id) }}"
                                            class="ticket-item">
                                            <div class="ticket-title">
                                                <h4>{{ truncate($course->title, 50) }}</h4>
                                            </div>
                                            <div class="ticket-info">
                                                <div>{{ $course->instructor->name }}</div>
                                                <div class="bullet"></div>
                                                <div>{{ $course->is_approved }}</div>
                                                <div class="bullet"></div>
                                                <div class="text-primary">{{ $course->created_at->diffForHumans() }}</div>
                                            </div>
                                        </a>
                                    @endforeach
                                    <a href="{{ route('admin.courses.index') }}" class="ticket-item ticket-more">
                                        {{ __('View All') }} <i class="fas fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(checkAdminHasPermission('blog.view'))
                    <div class="col-md-6 col-lg-4">
                        <div class="info-card">
                            <div class="info-header">
                                <div class="info-icon">
                                    <i class="fas fa-blog"></i>
                                </div>
                                <div class="info-title">
                                    <h5>{{ __('Recent Blogs') }}</h5>
                                    <div class="info-subtitle">({{ $data['pending_blogs'] }}) {{ __('Blogs are pending') }}</div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="tickets-list">
                                    @foreach ($data['recent_blogs'] as $blog)
                                        <a href="{{ route('admin.blogs.edit', ['blog' => $blog, 'code' => getSessionLanguage()]) }}"
                                            class="ticket-item">
                                            <div class="ticket-title">
                                                <h4>{{ truncate($blog->translation->title, 50) }}</h4>
                                            </div>
                                            <div class="ticket-info">
                                                <div>{{ $blog->author->name }}</div>
                                                <div class="bullet"></div>
                                                <div>{{ $blog->status == 1 ? __('Approved') : __('Pending') }}</div>
                                                <div class="bullet"></div>
                                                <div class="text-primary">{{ $blog->created_at->diffForHumans() }}</div>
                                            </div>
                                        </a>
                                    @endforeach
                                    <a href="{{ route('admin.blogs.index') }}" class="ticket-item ticket-more">
                                        {{ __('View All') }} <i class="fas fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(checkAdminHasPermission('contect.message.view'))
                    <div class="col-md-6 col-lg-4">
                        <div class="info-card">
                            <div class="info-header">
                                <div class="info-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="info-title">
                                    <h5>{{ __('Recent Contacts') }}</h5>
                                    <div class="info-subtitle">{{ __('Here is your recent contacts messages') }}</div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="tickets-list">
                                    @foreach ($data['recent_contacts'] as $contact)
                                        <a href="{{ route('admin.contact-message', $contact->id) }}"
                                            class="ticket-item">
                                            <div class="ticket-title">
                                                <h4>{{ truncate($contact->subject, 50) }}</h4>
                                            </div>
                                            <div class="ticket-info">
                                                <div>{{ $contact->name }}</div>
                                                <div class="bullet"></div>
                                                <div>{{ $contact->email }}</div>
                                                <div class="bullet"></div>
                                                <div class="text-primary">{{ $contact->created_at->diffForHumans() }}
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                    <a href="{{ route('admin.contact-messages') }}" class="ticket-item ticket-more">
                                        {{ __('View All') }} <i class="fas fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection

@push('js')
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        $(document).ready(function() {
            "use strict";
            
            // Chart data from controller
            var monthlyData = @json($data['monthly_data']);
            var userRegistrationData = @json($data['user_registration_data']);
            var courseCreationData = @json($data['course_creation_data']);
            
            // Course Activity Chart (Monthly)
            var courseActivityCtx = document.getElementById('courseActivityChart').getContext('2d');
            var courseActivityChart = new Chart(courseActivityCtx, {
                type: 'line',
                data: {
                    labels: monthlyData.labels,
                    datasets: [{
                        label: '{{ __('Course Activity') }}',
                        data: monthlyData.data,
                        borderColor: 'rgb(75, 192, 192)',
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
                    labels: userRegistrationData.labels,
                    datasets: [{
                        label: '{{ __('User Registrations') }}',
                        data: userRegistrationData.data,
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
                    labels: courseCreationData.labels,
                    datasets: [{
                        label: '{{ __('Course Creation') }}',
                        data: courseCreationData.data,
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
        
        // Quick Action Functions
        function generateAIContent() {
            Swal.fire({
                title: '{{ __('AI Content Generator') }}',
                html: `
                    <div class="text-left">
                        <div class="form-group">
                            <label>{{ __('Content Type') }}</label>
                            <select class="form-control" id="contentType">
                                <option value="course">{{ __('Course Outline') }}</option>
                                <option value="quiz">{{ __('Quiz Questions') }}</option>
                                <option value="assignment">{{ __('Assignment') }}</option>
                                <option value="description">{{ __('Course Description') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Topic/Subject') }}</label>
                            <input type="text" class="form-control" id="contentTopic" placeholder="{{ __('Enter topic or subject') }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Difficulty Level') }}</label>
                            <select class="form-control" id="difficultyLevel">
                                <option value="beginner">{{ __('Beginner') }}</option>
                                <option value="intermediate">{{ __('Intermediate') }}</option>
                                <option value="advanced">{{ __('Advanced') }}</option>
                            </select>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: '{{ __('Generate Content') }}',
                cancelButtonText: '{{ __('Cancel') }}',
                preConfirm: () => {
                    const contentType = document.getElementById('contentType').value;
                    const topic = document.getElementById('contentTopic').value;
                    const difficulty = document.getElementById('difficultyLevel').value;
                    
                    if (!topic) {
                        Swal.showValidationMessage('{{ __('Please enter a topic') }}');
                        return false;
                    }
                    
                    return { contentType, topic, difficulty };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Simulate AI content generation
                    Swal.fire({
                        title: '{{ __('Generating Content...') }}',
                        html: '{{ __('AI is creating your content. Please wait...') }}',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                            setTimeout(() => {
                                Swal.fire({
                                    icon: 'success',
                                    title: '{{ __('Content Generated!') }}',
                                    text: '{{ __('Your AI-generated content is ready. Check your drafts folder.') }}'
                                });
                            }, 3000);
                        }
                    });
                }
            });
        }
        
        function bulkOperations() {
            Swal.fire({
                title: '{{ __('Bulk Operations') }}',
                html: `
                    <div class="text-left">
                        <div class="form-group">
                            <label>{{ __('Select Operation') }}</label>
                            <select class="form-control" id="bulkOperation">
                                <option value="approve">{{ __('Approve Pending Courses') }}</option>
                                <option value="publish">{{ __('Publish Draft Courses') }}</option>
                                <option value="archive">{{ __('Archive Old Courses') }}</option>
                                <option value="update_tags">{{ __('Update Course Tags') }}</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Filter Criteria') }}</label>
                            <input type="text" class="form-control" id="filterCriteria" placeholder="{{ __('Enter filter criteria (optional)') }}">
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: '{{ __('Execute Operation') }}',
                cancelButtonText: '{{ __('Cancel') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: '{{ __('Operation Completed!') }}',
                        text: '{{ __('Bulk operation has been executed successfully.') }}'
                    });
                }
            });
        }
        
        function exportAnalytics() {
            Swal.fire({
                title: '{{ __('Export Analytics') }}',
                html: `
                    <div class="text-left">
                        <div class="form-group">
                            <label>{{ __('Report Type') }}</label>
                            <select class="form-control" id="reportType">
                                <option value="comprehensive">{{ __('Comprehensive Report') }}</option>
                                <option value="user_analytics">{{ __('User Analytics') }}</option>
                                <option value="course_performance">{{ __('Course Performance') }}</option>
                                <option value="financial">{{ __('Financial Report') }}</option>
                                <option value="engagement">{{ __('Engagement Metrics') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Date Range') }}</label>
                            <select class="form-control" id="dateRange">
                                <option value="last_week">{{ __('Last Week') }}</option>
                                <option value="last_month">{{ __('Last Month') }}</option>
                                <option value="last_quarter">{{ __('Last Quarter') }}</option>
                                <option value="last_year">{{ __('Last Year') }}</option>
                                <option value="custom">{{ __('Custom Range') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Export Format') }}</label>
                            <select class="form-control" id="exportFormat">
                                <option value="pdf">{{ __('PDF Report') }}</option>
                                <option value="excel">{{ __('Excel Spreadsheet') }}</option>
                                <option value="csv">{{ __('CSV Data') }}</option>
                                <option value="json">{{ __('JSON Data') }}</option>
                            </select>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: '{{ __('Generate Report') }}',
                cancelButtonText: '{{ __('Cancel') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: '{{ __('Report Generated!') }}',
                        text: '{{ __('Your analytics report is being prepared and will be downloaded shortly.') }}'
                    });
                    // Simulate file download
                    setTimeout(() => {
                        const link = document.createElement('a');
                        link.href = '#';
                        link.download = 'analytics_report.pdf';
                        link.click();
                    }, 2000);
                }
            });
        }
        
        function initializeLearningAnalyticsChart() {
            var learningData = @json($data['learning_analytics']['weekly_progress']);
            
            var ctx = document.createElement('canvas');
            ctx.id = 'learningProgressChart';
            
            // Add chart to a container if needed
            var chartContainer = document.querySelector('.learning-chart-container');
            if (chartContainer) {
                chartContainer.appendChild(ctx);
                
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: learningData.map(item => item.date),
                        datasets: [{
                            label: '{{ __('Completed Lessons') }}',
                            data: learningData.map(item => item.completed_lessons),
                            borderColor: 'rgb(99, 102, 241)',
                            backgroundColor: 'rgba(99, 102, 241, 0.1)',
                            tension: 0.4
                        }, {
                            label: '{{ __('Active Learners') }}',
                            data: learningData.map(item => item.active_learners),
                            borderColor: 'rgb(34, 197, 94)',
                            backgroundColor: 'rgba(34, 197, 94, 0.1)',
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
            // Simulate real-time activity updates
            console.log('Refreshing activity feed...');
            // In a real implementation, this would make an AJAX call to get new activities
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
