@extends('frontend.layouts.master')
@section('meta_title', $course?->title . ' || ' . $setting->app_name)
@push('custom_meta')
    <meta property="description" content="{{ $course->seo_description }}" />
    <meta property="og:title" content="{{ $course?->title }}" />
    <meta property="og:description" content="{{ $course->seo_description }}" />
    <meta property="og:image" content="{{ asset($course->thumbnail) }}" />
    <meta property="og:URL" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
@endpush
@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/shareon.min.css') }}">
    <style>
        /* Coursera-Style Course Details Page */
        .coursera-hero {
            background: linear-gradient(135deg, #0056d3 0%, #004ba0 100%);
            color: white;
            padding: 60px 0 80px;
            position: relative;
            overflow: hidden;
        }
        
        .coursera-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero-breadcrumb {
            margin-bottom: 20px;
        }
        
        .hero-breadcrumb a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-size: 14px;
        }
        
        .hero-breadcrumb a:hover {
            color: white;
        }
        
        .hero-breadcrumb span {
            color: rgba(255,255,255,0.6);
            margin: 0 8px;
        }
        
        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
            color: rgba(255,255,255,0.9);
            margin-bottom: 30px;
            max-width: 600px;
        }
        
        .hero-meta {
            display: flex;
            align-items: center;
            gap: 30px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        
        .hero-meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(255,255,255,0.9);
            font-weight: 500;
        }
        
        .hero-meta-item i {
            color: #ffd700;
        }
        
        .hero-rating {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .hero-rating .stars {
            color: #ffd700;
        }
        
        .hero-cta {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-top: 30px;
        }
        
        .hero-enroll-btn {
            background: linear-gradient(135deg, #0056d3, #004ba0);
            color: white;
            padding: 16px 32px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            border: 2px solid white;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .hero-enroll-btn:hover {
            background: white;
            color: #0056d3;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }
        
        .hero-wishlist-btn {
            background: transparent;
            color: white;
            padding: 16px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .hero-wishlist-btn:hover {
            background: rgba(255,255,255,0.1);
            border-color: white;
            color: white;
        }
        
        /* Course Content Area */
        .course-content-area {
            background: #f8fafc;
            padding: 60px 0;
        }
        
        .course-main-content {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        
        .course-video-preview {
            position: relative;
            background: #000;
            aspect-ratio: 16/9;
        }
        
        .course-video-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .video-play-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80px;
            height: 80px;
            background: rgba(0,86,211,0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .video-play-btn:hover {
            background: #0056d3;
            transform: translate(-50%, -50%) scale(1.1);
            color: white;
        }
        
        /* Course Tabs */
        .course-tabs {
            border-bottom: 1px solid #e5e7eb;
        }
        
        .course-nav-tabs {
            display: flex;
            border: none;
            background: none;
            margin: 0;
            padding: 0 30px;
        }
        
        .course-nav-link {
            padding: 20px 30px;
            border: none;
            background: none;
            color: #6b7280;
            font-weight: 600;
            font-size: 16px;
            text-decoration: none;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }
        
        .course-nav-link:hover {
            color: #0056d3;
        }
        
        .course-nav-link.active {
            color: #0056d3;
            border-bottom-color: #0056d3;
        }
        
        .course-tab-content {
            padding: 40px 30px;
        }
        
        .course-tab-pane {
            display: none;
        }
        
        .course-tab-pane.active {
            display: block;
        }
        
        /* Overview Tab */
        .course-overview h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 20px;
        }
        
        .course-overview p {
            color: #4b5563;
            line-height: 1.7;
            margin-bottom: 20px;
        }
        
        /* Curriculum Tab */
        .curriculum-section {
            margin-bottom: 30px;
        }
        
        .curriculum-chapter {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            margin-bottom: 16px;
            overflow: hidden;
        }
        
        .chapter-header {
            background: #f9fafb;
            padding: 20px;
            border-bottom: 1px solid #e5e7eb;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }
        
        .chapter-header:hover {
            background: #f3f4f6;
        }
        
        .chapter-title {
            font-weight: 600;
            color: #1f2937;
            margin: 0;
        }
        
        .chapter-meta {
            color: #6b7280;
            font-size: 14px;
        }
        
        .chapter-content {
            display: none;
            padding: 0;
        }
        
        .chapter-content.show {
            display: block;
        }
        
        .lesson-item {
            padding: 16px 20px;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }
        
        .lesson-item:hover {
            background: #f9fafb;
        }
        
        .lesson-item:last-child {
            border-bottom: none;
        }
        
        .lesson-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .lesson-icon {
            width: 20px;
            height: 20px;
            color: #0056d3;
        }
        
        .lesson-title {
            font-weight: 500;
            color: #1f2937;
            text-decoration: none;
        }
        
        .lesson-title:hover {
            color: #0056d3;
        }
        
        .lesson-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            color: #6b7280;
            font-size: 14px;
        }
        
        /* Sidebar */
        .course-sidebar {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 30px;
            position: sticky;
            top: 30px;
        }
        
        .sidebar-section {
            margin-bottom: 30px;
        }
        
        .sidebar-section:last-child {
            margin-bottom: 0;
        }
        
        .sidebar-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 20px;
        }
        
        .course-info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .course-info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .course-info-item:last-child {
            border-bottom: none;
        }
        
        .info-label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #4b5563;
            font-weight: 500;
        }
        
        .info-label img {
            width: 20px;
            height: 20px;
        }
        
        .info-value {
            color: #0056d3;
            font-weight: 600;
        }
        
        .course-levels,
        .course-languages {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        
        .level-tag,
        .language-tag {
            background: #dbeafe;
            color: #1e40af;
            padding: 4px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .access-status {
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .access-granted {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }
        
        .access-restricted {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }
        
        .access-status-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .access-status-icon {
            font-size: 24px;
        }
        
        .access-status-text h6 {
            margin: 0 0 4px 0;
            font-weight: 700;
        }
        
        .access-status-text p {
            margin: 0;
            font-size: 14px;
            opacity: 0.9;
        }
        
        .enroll-btn {
            width: 100%;
            background: linear-gradient(135deg, #0056d3, #004ba0);
            color: white;
            padding: 16px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        
        .enroll-btn:hover {
            background: linear-gradient(135deg, #004ba0, #003d82);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,86,211,0.3);
            color: white;
        }
        
        .enroll-btn.enrolled {
            background: linear-gradient(135deg, #10b981, #059669);
        }
        
        .enroll-btn.restricted {
            background: linear-gradient(135deg, #6b7280, #4b5563);
            opacity: 0.8;
            cursor: not-allowed;
        }
        
        .enroll-btn.restricted:hover {
            transform: none;
            box-shadow: none;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .hero-meta {
                gap: 15px;
            }
            
            .hero-cta {
                flex-direction: column;
                align-items: stretch;
            }
            
            .course-nav-tabs {
                flex-direction: column;
                padding: 0;
            }
            
            .course-nav-link {
                padding: 15px 20px;
                border-bottom: 1px solid #e5e7eb;
                border-right: none;
            }
            
            .course-nav-link.active {
                border-bottom-color: #e5e7eb;
                background: #f9fafb;
            }
            
            .course-tab-content {
                padding: 20px;
            }
            
            .course-sidebar {
                margin-top: 30px;
            }
        }
    </style>
@endpush

@section('contents')
    <!-- Hero Section -->
    <section class="coursera-hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-breadcrumb">
                    <a href="{{ route('home') }}">{{ __('Home') }}</a>
                    <span>/</span>
                    <a href="{{ route('courses') }}">{{ __('Courses') }}</a>
                    <span>/</span>
                    <span>{{ $course->category->translation->name }}</span>
                </div>
                
                <h1 class="hero-title">{{ $course->title }}</h1>
                
                <div class="hero-subtitle">
                    {{ Str::limit(strip_tags($course->description), 150) }}
                </div>
                
                <div class="hero-meta">
                    <div class="hero-meta-item">
                        <i class="fas fa-star"></i>
                        <div class="hero-rating">
                            <span class="stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= floor($course->reviews()->avg('rating')))
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </span>
                            <span>{{ number_format($course->reviews()->avg('rating'), 1) ?? 0 }} ({{ $course->reviews()->count() }} {{ __('reviews') }})</span>
                        </div>
                    </div>
                    
                    <div class="hero-meta-item">
                        <i class="fas fa-users"></i>
                        <span>{{ $course->assignments()->count() }} {{ __('students') }}</span>
                    </div>
                    
                    <div class="hero-meta-item">
                        <i class="fas fa-clock"></i>
                        <span>{{ minutesToHours($course->duration) }}</span>
                    </div>
                    
                    <div class="hero-meta-item">
                        <i class="fas fa-play-circle"></i>
                        <span>{{ $courseLessonCount }} {{ __('lessons') }}</span>
                    </div>
                    
                    <div class="hero-meta-item">
                        <i class="fas fa-calendar"></i>
                        <span>{{ formatDate($course->created_at, 'M Y') }}</span>
                    </div>
                </div>
                
                <div class="hero-cta">
                    @if (isset($userHasAccess) && $userHasAccess)
                        @if (in_array($course->id, session('enrollments') ?? []))
                            <a href="{{ route('student.enrolled-courses') }}" class="hero-enroll-btn enrolled">
                                <i class="fas fa-play"></i>
                                {{ __('Continue Learning') }}
                            </a>
                        @else
                            <a href="javascript:;" class="hero-enroll-btn start-learning-btn" data-id="{{ $course->id }}">
                                <i class="fas fa-play"></i>
                                {{ __('Start Learning') }}
                            </a>
                        @endif
                    @else
                        <a href="javascript:;" class="hero-enroll-btn restricted" onclick="alert('You do not have access to this course. Please contact your administrator.')">
                            <i class="fas fa-lock"></i>
                            {{ __('Access Restricted') }}
                        </a>
                    @endif
                    
                    <a href="javascript:;" class="hero-wishlist-btn wsus-wishlist-btn" data-slug="{{ $course->slug }}">
                        <i class="{{ $course->favorite_by_client ? 'fas' : 'far' }} fa-heart"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Content -->
    <section class="course-content-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="course-main-content">
                        <!-- Video Preview -->
                        <div class="course-video-preview">
                            <img src="{{ asset($course->thumbnail) }}" alt="{{ $course->title }}">
                            @if ($course->demo_video_source)
                                <a href="{{ $course->demo_video_source }}" class="video-play-btn popup-video">
                                    <i class="fas fa-play"></i>
                                </a>
                            @endif
                        </div>
                        
                        <!-- Course Tabs -->
                        <div class="course-tabs">
                            <div class="course-nav-tabs">
                                <a href="#overview" class="course-nav-link active" data-tab="overview">{{ __('Overview') }}</a>
                                <a href="#curriculum" class="course-nav-link" data-tab="curriculum">{{ __('Curriculum') }}</a>
                                <a href="#instructors" class="course-nav-link" data-tab="instructors">{{ __('Instructors') }}</a>
                                <a href="#reviews" class="course-nav-link" data-tab="reviews">{{ __('Reviews') }}</a>
                            </div>
                        </div>
                        
                        <div class="course-tab-content">
                            <!-- Overview Tab -->
                            <div class="course-tab-pane active" id="overview">
                                <div class="course-overview">
                                    <h3>{{ __('About this course') }}</h3>
                                    {!! clean($course->description) !!}
                                </div>
                            </div>
                            
                            <!-- Curriculum Tab -->
                            <div class="course-tab-pane" id="curriculum">
                                <div class="curriculum-section">
                                    <h3>{{ __('Course Curriculum') }}</h3>
                                    <p class="text-muted mb-4">{{ $course->chapters->count() }} {{ __('chapters') }} • {{ $courseLessonCount }} {{ __('lessons') }} • {{ minutesToHours($course->duration) }} {{ __('total length') }}</p>
                                    
                                    @foreach ($course->chapters as $chapter)
                                        <div class="curriculum-chapter">
                                            <div class="chapter-header" data-chapter="{{ $chapter->id }}">
                                                <div>
                                                    <h5 class="chapter-title">{{ $loop->iteration }}. {{ $chapter->title ?? 'Untitled Chapter' }}</h5>
                                                    <div class="chapter-meta">
                                                        {{ $chapter->chapterItems->count() }} {{ __('items') }} • 
                                                        {{ minutesToHours($chapter->chapterItems->sum(function($item) {
                                                            return $item->lesson ? $item->lesson->duration : 0;
                                                        })) }}
                                                    </div>
                                                </div>
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                            <div class="chapter-content" id="chapter-{{ $chapter->id }}">
                                                @foreach ($chapter->chapterItems as $chapterItem)
                                                    <div class="lesson-item">
                                                        <div class="lesson-info">
                                                            @if ($chapterItem->type == 'lesson' && $chapterItem->lesson)
                                                                @if ($chapterItem->lesson->file_type == 'video')
                                                                    <i class="fas fa-play-circle lesson-icon"></i>
                                                                @elseif ($chapterItem->lesson->file_type == 'document')
                                                                    <i class="fas fa-file-alt lesson-icon"></i>
                                                                @else
                                                                    <i class="fas fa-book lesson-icon"></i>
                                                                @endif
                                                                
                                                                @if ($chapterItem->lesson->is_free == 1)
                                                                    @if ($chapterItem->lesson->file_type == 'video' && $chapterItem->lesson->storage == 'google_drive')
                                                                        <a href="javascript:;" 
                                                                           data-bs-toggle="modal"
                                                                           data-bs-target="#videoModal"
                                                                           data-bs-video="https://drive.google.com/file/d/{{ extractGoogleDriveVideoId($chapterItem->lesson->file_path) }}/preview"
                                                                           class="lesson-title">
                                                                            {{ $chapterItem->lesson->title ?? 'Untitled Lesson' }}
                                                                        </a>
                                                                    @else
                                                                        <span class="lesson-title">{{ $chapterItem->lesson->title ?? 'Untitled Lesson' }}</span>
                                                                    @endif
                                                                @else
                                                                    <span class="lesson-title">{{ $chapterItem->lesson->title ?? 'Untitled Lesson' }}</span>
                                                                @endif
                                                            @elseif ($chapterItem->type == 'quiz' && $chapterItem->quiz)
                                                                <i class="fas fa-question-circle lesson-icon"></i>
                                                                <span class="lesson-title">{{ $chapterItem->quiz->title ?? 'Untitled Quiz' }}</span>
                                                            @else
                                                                <i class="fas fa-exclamation-triangle lesson-icon"></i>
                                                                <span class="lesson-title">Content not available</span>
                                                            @endif
                                                        </div>
                                                        
                                                        <div class="lesson-meta">
                                                            @if ($chapterItem->type == 'lesson')
                                                                <span>{{ minutesToHours($chapterItem->lesson->duration) }}</span>
                                                                @if ($chapterItem->lesson->is_free == 1)
                                                                    <span class="badge bg-success">{{ __('Free') }}</span>
                                                                @endif
                                                            @else
                                                                <span>{{ __('Quiz') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Instructors Tab -->
                            <div class="course-tab-pane" id="instructors">
                                <div class="instructors-section">
                                    <h3>{{ __('Meet your instructors') }}</h3>
                                    
                                    {{-- Main Instructor --}}
                                    @if($course->instructor)
                                        <div class="instructor-card mb-4">
                                            <div class="d-flex align-items-start gap-3">
                                                <img src="{{ asset($course->instructor->image) }}" alt="{{ $course->instructor->name }}" 
                                                     class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                                                <div>
                                                    <h5 class="mb-1">{{ $course->instructor->name }}</h5>
                                                    <p class="text-muted mb-2">{{ $course->instructor->designation }}</p>
                                                    <p class="mb-0">{{ Str::limit($course->instructor->bio, 200) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    {{-- Partner Instructors --}}
                                    @foreach ($course->partnerInstructors as $partnerInstructor)
                                        @if($partnerInstructor->instructor)
                                            <div class="instructor-card mb-4">
                                                <div class="d-flex align-items-start gap-3">
                                                    <img src="{{ asset($partnerInstructor->instructor->image) }}" alt="{{ $partnerInstructor->instructor->name }}" 
                                                         class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                                                    <div>
                                                        <h5 class="mb-1">{{ $partnerInstructor->instructor->name }}</h5>
                                                        <p class="text-muted mb-2">{{ $partnerInstructor->instructor->designation }}</p>
                                                        <p class="mb-0">{{ Str::limit($partnerInstructor->instructor->bio, 200) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Reviews Tab -->
                            <div class="course-tab-pane" id="reviews">
                                <div class="reviews-section">
                                    <h3>{{ __('Student reviews') }}</h3>
                                    
                                    @if ($course->reviews()->count() > 0)
                                        <div class="reviews-summary mb-4">
                                            <div class="row align-items-center">
                                                <div class="col-md-4 text-center">
                                                    <div class="rating-summary">
                                                        <h2 class="display-4 fw-bold text-primary">{{ number_format($course->reviews()->avg('rating'), 1) }}</h2>
                                                        <div class="stars text-warning mb-2">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= floor($course->reviews()->avg('rating')))
                                                                    <i class="fas fa-star"></i>
                                                                @else
                                                                    <i class="far fa-star"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <p class="text-muted">{{ $course->reviews()->count() }} {{ __('reviews') }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <!-- Rating breakdown would go here -->
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="reviews-list">
                                            @foreach ($reviews as $review)
                                                <div class="review-item mb-4 pb-4 border-bottom">
                                                    <div class="d-flex align-items-start gap-3">
                                                        <img src="{{ asset($review->user->image) }}" alt="{{ $review->user->name }}" 
                                                             class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                                <div>
                                                                    <h6 class="mb-1">{{ $review->user->name }}</h6>
                                                                    <div class="stars text-warning">
                                                                        @for ($i = 1; $i <= $review->rating; $i++)
                                                                            <i class="fas fa-star"></i>
                                                                        @endfor
                                                                    </div>
                                                                </div>
                                                                <small class="text-muted">{{ formatDate($review->created_at) }}</small>
                                                            </div>
                                                            <p class="mb-0">{{ $review->review }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-5">
                                            <i class="fas fa-star-half-alt text-muted" style="font-size: 3rem;"></i>
                                            <h5 class="mt-3 text-muted">{{ __('No reviews yet') }}</h5>
                                            <p class="text-muted">{{ __('Be the first to review this course') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="course-sidebar">
                        <!-- Access Status -->
                        <div class="sidebar-section">
                            @if (isset($userHasAccess) && !$userHasAccess)
                                <div class="access-status access-restricted">
                                    <div class="access-status-content">
                                        <i class="fas fa-lock access-status-icon"></i>
                                        <div class="access-status-text">
                                            <h6>{{ __('Access Restricted') }}</h6>
                                            <p>{{ __('Contact your administrator for enrollment') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="access-status access-granted">
                                    <div class="access-status-content">
                                        <i class="fas fa-unlock access-status-icon"></i>
                                        <div class="access-status-text">
                                            <h6>{{ __('Course Available') }}</h6>
                                            <p>{{ __('You can enroll in this course') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            @if (isset($userHasAccess) && $userHasAccess)
                                @if (in_array($course->id, session('enrollments') ?? []))
                                    <a href="{{ route('student.enrolled-courses') }}" class="enroll-btn enrolled">
                                        <i class="fas fa-play"></i>
                                        {{ __('Continue Learning') }}
                                    </a>
                                @else
                                    <a href="javascript:;" class="enroll-btn start-learning-btn" data-id="{{ $course->id }}">
                                        <i class="fas fa-play"></i>
                                        {{ __('Start Learning') }}
                                    </a>
                                @endif
                            @else
                                <a href="javascript:;" class="enroll-btn restricted" onclick="alert('You do not have access to this course. Please contact your administrator.')">
                                    <i class="fas fa-lock"></i>
                                    {{ __('Access Restricted') }}
                                </a>
                            @endif
                        </div>
                        
                        <!-- Course Information -->
                        <div class="sidebar-section">
                            <h5 class="sidebar-title">{{ __('Course includes') }}</h5>
                            <ul class="course-info-list">
                                <li class="course-info-item">
                                    <div class="info-label">
                                        <img src="{{ asset('frontend/img/icons/course_icon01.svg') }}" alt="Level">
                                        {{ __('Level') }}
                                    </div>
                                    <div class="info-value">
                                        <div class="course-levels">
                                            @foreach ($course->levels as $level)
                                                <span class="level-tag">{{ $level->level->translation->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                                
                                <li class="course-info-item">
                                    <div class="info-label">
                                        <img src="{{ asset('frontend/img/icons/course_icon02.svg') }}" alt="Duration">
                                        {{ __('Duration') }}
                                    </div>
                                    <div class="info-value">{{ minutesToHours($course->duration) }}</div>
                                </li>
                                
                                <li class="course-info-item">
                                    <div class="info-label">
                                        <img src="{{ asset('frontend/img/icons/course_icon03.svg') }}" alt="Lessons">
                                        {{ __('Lessons') }}
                                    </div>
                                    <div class="info-value">{{ $courseLessonCount }}</div>
                                </li>
                                
                                <li class="course-info-item">
                                    <div class="info-label">
                                        <img src="{{ asset('frontend/img/icons/course_icon04.svg') }}" alt="Quizzes">
                                        {{ __('Quizzes') }}
                                    </div>
                                    <div class="info-value">{{ $courseQuizCount }}</div>
                                </li>
                                
                                <li class="course-info-item">
                                    <div class="info-label">
                                        <img src="{{ asset('frontend/img/icons/course_icon05.svg') }}" alt="Certificate">
                                        {{ __('Certificate') }}
                                    </div>
                                    <div class="info-value">
                                        @if ($course->certificate)
                                            {{ __('Yes') }}
                                        @else
                                            {{ __('No') }}
                                        @endif
                                    </div>
                                </li>
                                
                                <li class="course-info-item">
                                    <div class="info-label">
                                        <img src="{{ asset('frontend/img/icons/course_icon06.svg') }}" alt="Language">
                                        {{ __('Language') }}
                                    </div>
                                    <div class="info-value">
                                        <div class="course-languages">
                                            @foreach ($course->languages as $language)
                                                <span class="language-tag">{{ $language->language->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="ratio ratio-16x9">
                        <iframe class="iframe-video" src="" width="640" height="680" allow="autoplay" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('frontend/js/default/course-details.js') }}"></script>
    <script src="{{ asset('frontend/js/shareon.iife.js') }}"></script>
    <script>
        // Tab functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabLinks = document.querySelectorAll('.course-nav-link');
            const tabPanes = document.querySelectorAll('.course-tab-pane');
            
            tabLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all tabs and panes
                    tabLinks.forEach(l => l.classList.remove('active'));
                    tabPanes.forEach(p => p.classList.remove('active'));
                    
                    // Add active class to clicked tab
                    this.classList.add('active');
                    
                    // Show corresponding pane
                    const targetTab = this.getAttribute('data-tab');
                    document.getElementById(targetTab).classList.add('active');
                });
            });
            
            // Chapter accordion functionality
            const chapterHeaders = document.querySelectorAll('.chapter-header');
            chapterHeaders.forEach(header => {
                header.addEventListener('click', function() {
                    const chapterId = this.getAttribute('data-chapter');
                    const content = document.getElementById('chapter-' + chapterId);
                    const icon = this.querySelector('i');
                    
                    if (content.classList.contains('show')) {
                        content.classList.remove('show');
                        icon.style.transform = 'rotate(0deg)';
                    } else {
                        // Close all other chapters
                        document.querySelectorAll('.chapter-content').forEach(c => c.classList.remove('show'));
                        document.querySelectorAll('.chapter-header i').forEach(i => i.style.transform = 'rotate(0deg)');
                        
                        // Open clicked chapter
                        content.classList.add('show');
                        icon.style.transform = 'rotate(180deg)';
                    }
                });
            });
        });
        
        Shareon.init();
    </script>

    @if ($setting->google_tagmanager_status == 'active' && $marketing_setting?->course_details)
        <script>
            $(document).ready(function() {
                dataLayer.push({
                    'event': 'courseDetails',
                    'courses': {
                        'name': '{{ $course->title }}',
                        'price': '{{ currency($course->price) }}',
                        'category': '{{ $course->category->translation->name }}',
                        'lessons': '{{ $courseLessonCount }}',
                        'duration': '{{ minutesToHours($course->duration) }}',
                        'url': "{{ route('course.show', $course->slug) }}",
                    }
                });
            });
        </script>
    @endif
@endpush
