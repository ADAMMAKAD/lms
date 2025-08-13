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
        /* Modern Course Details Page Styling */
        .courses__details-area {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 80vh;
        }
        
        .courses__details-thumb {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        
        .courses__details-thumb img {
            border-radius: 16px;
            transition: transform 0.3s ease;
        }
        
        .courses__details-thumb:hover img {
            transform: scale(1.02);
        }
        
        .popup-video {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
            transition: all 0.3s ease;
        }
        
        .popup-video:hover {
            transform: translate(-50%, -50%) scale(1.1);
            box-shadow: 0 12px 35px rgba(59, 130, 246, 0.6);
        }
        
        .courses__details-content {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }
        
        .courses__item-meta {
            margin-bottom: 1.5rem;
        }
        
        .courses__item-tag a {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            padding: 8px 16px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }
        
        .courses__item-tag a:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }
        
        .avg-rating {
            background: #fef3c7;
            color: #d97706;
            padding: 8px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.875rem;
        }
        
        .courses__wishlist .wsus-wishlist-btn {
            width: 45px;
            height: 45px;
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b7280;
            transition: all 0.3s ease;
        }
        
        .courses__wishlist .wsus-wishlist-btn:hover {
            border-color: #ef4444;
            color: #ef4444;
            transform: scale(1.1);
        }
        
        .courses__details-content .title {
            font-size: 2.25rem;
            font-weight: 700;
            color: #1f2937;
            margin: 1.5rem 0;
            line-height: 1.2;
        }
        
        .courses__details-meta .author-two {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #f8fafc;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 1rem;
        }
        
        .instructor-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #3b82f6;
        }
        
        .courses__details-meta .author-two a {
            color: #3b82f6;
            font-weight: 600;
            text-decoration: none;
        }
        
        .courses__details-meta .author-two a:hover {
            color: #2563eb;
        }
        
        .nav-tabs {
            border: none;
            background: #f8fafc;
            border-radius: 12px;
            padding: 8px;
            margin: 2rem 0;
        }
        
        .nav-tabs .nav-link {
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-weight: 600;
            color: #6b7280;
            transition: all 0.3s ease;
            margin: 0 4px;
        }
        
        .nav-tabs .nav-link.active {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .nav-tabs .nav-link:hover:not(.active) {
            background: #e5e7eb;
            color: #374151;
        }
        
        .tab-content {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        
        .courses__overview-wrap .title,
         .courses__curriculum-wrap .title,
         .courses__rating-wrap .title {
             font-size: 1.5rem;
             font-weight: 700;
             color: #1f2937;
             margin-bottom: 1.5rem;
             padding-bottom: 0.75rem;
             border-bottom: 3px solid #3b82f6;
             display: inline-block;
         }
        
        .accordion-item {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            margin-bottom: 1rem;
            overflow: hidden;
        }
        
        .accordion-button {
            background: #f8fafc;
            border: none;
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            color: #374151;
        }
        
        .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            box-shadow: none;
        }
        
        .accordion-body {
            padding: 1.5rem;
            background: white;
        }
        
        .course-item {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 8px;
            background: #f8fafc;
            transition: all 0.3s ease;
        }
        
        .course-item:hover {
            background: #e5e7eb;
            transform: translateX(8px);
        }
        
        .course-item-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-decoration: none;
            color: #374151;
        }
        
        .item-name {
            font-weight: 600;
        }
        
        .course-item-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.875rem;
            color: #6b7280;
        }
        
        /* Sidebar Styling */
        .courses__details-sidebar {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 2rem;
        }
        
        .courses__information-wrap {
            margin-bottom: 2rem;
        }
        
        .courses__information-wrap .title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #e5e7eb;
        }
        
        .courses__information-wrap ul li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
            font-weight: 500;
        }
        
        .courses__information-wrap ul li:last-child {
            border-bottom: none;
        }
        
        .courses__information-wrap ul li img {
            width: 20px;
            height: 20px;
            margin-right: 8px;
        }
        
        .courses__information-wrap ul li span {
            color: #3b82f6;
            font-weight: 600;
        }
        
        .level-wrapper .course-level-list,
        .level-wrapper .course-language-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        
        .level-wrapper .level,
        .level-wrapper span {
            background: #dbeafe;
            color: #1e40af;
            padding: 4px 12px;
            border-radius: 16px;
            font-size: 0.875rem;
            font-weight: 600;
        }
        
        .courses__details-social {
            margin: 2rem 0;
            padding: 1.5rem;
            background: #f8fafc;
            border-radius: 12px;
        }
        
        .courses__details-social .title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 1rem;
        }
        
        .shareon {
            display: flex;
            gap: 12px;
        }
        
        .shareon a {
            width: 20px;
            height: 25px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            color: white;
            text-decoration: none;
            font-size: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }
        
        .shareon .facebook {
            background-color: #1877f2;
        }
        
        .shareon .linkedin {
            background-color: #0077b5;
        }
        
        .shareon .telegram {
            background-color: #0088cc;
        }
        .shareon a:hover {
            transform: translateY(-2px) scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
            border-color: rgba(255, 255, 255, 0.4);
        }
        
        /* Enhanced Enrollment Button */
        .courses__details-enroll {
            margin-top: 2rem;
        }
        
        .btn-two {
            background: linear-gradient(135deg, #3b82f6, #2563eb) !important;
            border: none !important;
            color: white !important;
            padding: 16px 32px !important;
            border-radius: 12px !important;
            font-weight: 700 !important;
            font-size: 1.125rem !important;
            text-decoration: none !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 12px !important;
            width: 100% !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3) !important;
        }
        
        .btn-two:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 12px 35px rgba(59, 130, 246, 0.4) !important;
            background: linear-gradient(135deg, #2563eb, #1d4ed8) !important;
        }
        
        .already-enrolled-btn {
            background: linear-gradient(135deg, #6b7280, #4b5563) !important;
            box-shadow: 0 8px 25px rgba(107, 114, 128, 0.3) !important;
        }
        
        .already-enrolled-btn:hover {
            background: linear-gradient(135deg, #4b5563, #374151) !important;
            box-shadow: 0 12px 35px rgba(107, 114, 128, 0.4) !important;
        }
        
        .btn-four {
            background: linear-gradient(135deg, #f59e0b, #d97706) !important;
            border: none !important;
            color: white !important;
            padding: 12px 24px !important;
            border-radius: 10px !important;
            font-weight: 600 !important;
            text-decoration: none !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.3) !important;
        }
        
        .btn-four:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4) !important;
            background: linear-gradient(135deg, #d97706, #b45309) !important;
        }
        
        /* Reviews Section */
        .course-rate-summary {
            text-align: center;
            padding: 2rem;
            background: #f8fafc;
            border-radius: 12px;
            margin-bottom: 2rem;
        }
        
        .course-rate-summary-value {
            font-size: 3rem;
            font-weight: 700;
            color: #3b82f6;
            margin-bottom: 0.5rem;
        }
        
        .course-rate-summary-stars {
            color: #fbbf24;
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }
        
        .course-rate-details-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }
        
        .course-rate-details-row-star {
            display: flex;
            align-items: center;
            gap: 4px;
            min-width: 60px;
            font-weight: 600;
        }
        
        .course-rate-details-row-value {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .rating-gray {
            flex: 1;
            height: 8px;
            background: #e5e7eb;
            border-radius: 4px;
            position: relative;
        }
        
        .rating {
            height: 100%;
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            border-radius: 4px;
            position: absolute;
            top: 0;
            left: 0;
        }
        
        .rating-count {
            min-width: 30px;
            text-align: right;
            font-weight: 600;
            color: #6b7280;
        }
        
        .course-review-head {
            display: flex;
            gap: 16px;
            padding: 1.5rem;
            background: #f8fafc;
            border-radius: 12px;
            margin-bottom: 1rem;
        }
        
        .review-author-thumb img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .review-author-content {
            flex: 1;
        }
        
        .author-name .name {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }
        
        .author-name span {
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 400;
        }
        
        .author-rating {
            color: #fbbf24;
            margin-bottom: 0.75rem;
        }
        
        .review-author-content p {
            color: #4b5563;
            line-height: 1.6;
            margin: 0;
        }
        
        /* Instructor Section */
        .courses__instructors-wrap {
            display: flex;
            gap: 20px;
            padding: 2rem;
            background: #f8fafc;
            border-radius: 12px;
            margin-bottom: 1rem;
        }
        
        .courses__instructors-thumb img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #3b82f6;
        }
        
        .courses__instructors-content .title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }
        
        .courses__instructors-content .designation {
            color: #3b82f6;
            font-weight: 600;
            margin-bottom: 1rem;
            display: block;
        }
        
        .instructor__social ul {
            display: flex;
            gap: 12px;
            margin-top: 1rem;
        }
        
        .instructor__social a {
            width: 36px;
            height: 36px;
            background: #3b82f6;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .instructor__social a:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        /* Modal Styling */
        .modal-content {
            border-radius: 16px;
            border: none;
            overflow: hidden;
        }
        
        .modal-header {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border: none;
            padding: 1rem 1.5rem;
        }
        
        .btn-close {
            background: white;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 1;
        }
        
        .modal-body {
            padding: 0;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .courses__details-content .title {
                font-size: 1.75rem;
            }
            
            .courses__details-content,
            .courses__details-sidebar {
                padding: 1.5rem;
            }
            
            .nav-tabs .nav-link {
                padding: 10px 16px;
                font-size: 0.875rem;
            }
            
            .courses__instructors-wrap {
                flex-direction: column;
                text-align: center;
            }
            
            .course-rate-summary-value {
                font-size: 2.5rem;
            }
        }
    </style>
@endpush
@section('contents')
    <!-- breadcrumb-area -->
    <x-frontend.breadcrumb :title="__('Course Details')" :links="[
        ['url' => route('home'), 'text' => __('Home')],
        ['url' => route('become-instructor'), 'text' => __('Course Details')],
    ]" />
    <!-- breadcrumb-area-end -->

    <!-- courses-details-area -->
    <section class="courses__details-area section-py-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <div class="courses__details-thumb">
                        <img class="w-100" src="{{ asset($course->thumbnail) }}" alt="img">
                        @if ($course->demo_video_source)
                            <a href="{{ $course->demo_video_source }}" class="popup-video"
                                aria-label="{{ $course?->title }}"><i class="fas fa-play"></i></a>
                        @endif
                    </div>
                    <div class="courses__details-content">
                        <ul class="courses__item-meta list-wrap">
                            <li class="courses__item-tag">
                                <a
                                    href="{{ route('courses', ['category' => $course->category->id]) }}">{{ $course->category->translation->name }}</a>
                            </li>
                            <li class="avg-rating"><i class="fas fa-star"></i>
                                {{ number_format($course->reviews()->avg('rating'), 1) ?? 0 }} {{ __('Reviews') }}</li>
                            <li class="courses__wishlist">
                                <a href="javascript:;" class="wsus-wishlist-btn" aria-label="WishList"
                                    data-slug="{{ $course?->slug }}">
                                    <i class="{{ $course?->favorite_by_client ? 'fas' : 'far' }} fa-heart"></i>
                                </a>
                            </li>
                        </ul>
                        <h2 class="title">{{ $course?->title }}</h2>
                        <div class="courses__details-meta">
                            <ul class="list-wrap">
                                @if($course->instructor && $course->instructor->id && $course->instructor->name)
                                <li class="author-two">
                                    <img src="{{ asset($course->instructor->image) }}" alt="img"
                                        class="instructor-avatar">
                                    {{ __('By') }}
                                    <a
                                        href="{{ route('instructor-details', ['id' => $course->instructor->id, 'slug' => \Illuminate\Support\Str::slug($course->instructor->name)]) }}">{{ $course->instructor->name }}</a>
                                </li>
                                @endif
                                <li class="date"><i
                                        class="flaticon-calendar"></i>{{ formatDate($course->created_at, 'd/M/Y') }}</li>
                                <li><i class="flaticon-mortarboard"></i>{{ __('Free Course') }}</li>
                            </ul>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="overview-tab" data-bs-toggle="tab"
                                    data-bs-target="#overview-tab-pane" type="button" role="tab"
                                    aria-controls="overview-tab-pane" aria-selected="true">{{ __('Overview') }}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="curriculum-tab" data-bs-toggle="tab"
                                    data-bs-target="#curriculum-tab-pane" type="button" role="tab"
                                    aria-controls="curriculum-tab-pane"
                                    aria-selected="false">{{ __('Curriculum') }}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="instructors-tab" data-bs-toggle="tab"
                                    data-bs-target="#instructors-tab-pane" type="button" role="tab"
                                    aria-controls="instructors-tab-pane"
                                    aria-selected="false">{{ __('Instructors') }}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                    data-bs-target="#reviews-tab-pane" type="button" role="tab"
                                    aria-controls="reviews-tab-pane" aria-selected="false">{{ __('reviews') }}</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="overview-tab-pane" role="tabpanel"
                                aria-labelledby="overview-tab" tabindex="0">
                                <div class="courses__overview-wrap">
                                    <h3 class="title">{{ __('Course Description') }}</h3>
                                    {!! clean($course->description) !!}

                                </div>
                            </div>
                            <div class="tab-pane fade" id="curriculum-tab-pane" role="tabpanel"
                                aria-labelledby="curriculum-tab" tabindex="0">
                                <div class="courses__curriculum-wrap">
                                    <h3 class="title">{{ __('Course Curriculum') }}</h3>
                                    <p></p>
                                    <div class="accordion" id="accordionExample">
                                        @foreach ($course->chapters as $chapter)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading{{ $chapter->id }}">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse{{ $chapter->id }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapse{{ $chapter->id }}">
                                                        {{ $loop->iteration }}. {{ $chapter?->title }}
                                                    </button>
                                                </h2>
                                                <div id="collapse{{ $chapter->id }}" class="accordion-collapse collapse"
                                                    aria-labelledby="heading{{ $chapter->id }}"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <ul class="list-wrap">
                                                            @foreach ($chapter->chapterItems as $chapterItem)
                                                                @if ($chapterItem?->type == 'lesson')
                                                                    @if ($chapterItem?->lesson?->is_free == 1)
                                                                        @if ($chapterItem?->lesson?->file_type == 'video')
                                                                            @if ($chapterItem?->lesson->storage == 'google_drive')
                                                                                <li class="course-item open-item">
                                                                                    <a href="javascript:;"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#videoModal"
                                                                                        data-bs-video="https://drive.google.com/file/d/{{ extractGoogleDriveVideoId($chapterItem?->lesson->file_path) }}/preview"
                                                                                        class="course-item-link">
                                                                                        <span
                                                                                            class="item-name">{{ $chapterItem?->lesson?->title }}</span>
                                                                                        <div class="course-item-meta">
                                                                                            <span
                                                                                                class="item-meta duration">{{ minutesToHours($chapterItem?->lesson?->duration) }}</span>
                                                                                        </div>
                                                                                    </a>
                                                                                </li>
                                                                            @else
                                                                                <li class="course-item open-item">
                                                                                    <a href="@if(!in_array($chapterItem?->lesson->storage, ['wasabi', 'aws'])){{ $chapterItem?->lesson->file_path }}@else{{ Storage::disk($chapterItem?->lesson->storage)->temporaryUrl($chapterItem?->lesson->file_path, now()->addHours(1)) }}@endif"
                                                                                        class="course-item-link popup-video">
                                                                                        <span
                                                                                            class="item-name">{{ $chapterItem?->lesson?->title }}</span>
                                                                                        <div class="course-item-meta">
                                                                                            <span
                                                                                                class="item-meta duration">{{ minutesToHours($chapterItem?->lesson?->duration) }}</span>
                                                                                        </div>
                                                                                    </a>
                                                                                </li>
                                                                            @endif
                                                                        @else
                                                                            <li class="course-item">
                                                                                <a href="javascript:;"
                                                                                    class="course-item-link">
                                                                                    <span
                                                                                        class="item-name">{{ $chapterItem?->lesson?->title }}</span>
                                                                                    <div class="course-item-meta">
                                                                                        <span class="item-meta duration">
                                                                                            --.-- </span>
                                                                                        <span
                                                                                            class="item-meta course-item-status">
                                                                                            <img src="{{ asset('frontend/img/icons/lock.svg') }}"
                                                                                                alt="icon">
                                                                                        </span>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                        @endif
                                                                    @else
                                                                        <li class="course-item">
                                                                            <a href="javascript:;"
                                                                                class="course-item-link">
                                                                                <span
                                                                                    class="item-name">{{ $chapterItem?->lesson?->title }}</span>
                                                                                <div class="course-item-meta">
                                                                                    <span
                                                                                        class="item-meta duration">{{ minutesToHours($chapterItem?->lesson?->duration) }}</span>
                                                                                    <span
                                                                                        class="item-meta course-item-status">
                                                                                        <img src="{{ asset('frontend/img/icons/lock.svg') }}"
                                                                                            alt="icon">
                                                                                    </span>
                                                                                </div>
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                @elseif($chapterItem?->type == 'live')
                                                                    <li class="course-item">
                                                                        <a href="javascript:;" class="course-item-link">
                                                                            <span
                                                                                class="item-name">{{ $chapterItem?->lesson?->title }}</span>
                                                                            <div class="course-item-meta">
                                                                                <span
                                                                                    class="item-meta duration">{{ minutesToHours($chapterItem?->lesson?->duration) }}</span>
                                                                                <span class="item-meta course-item-status">
                                                                                    <img src="{{ asset('frontend/img/icons/lock.svg') }}"
                                                                                        alt="icon">
                                                                                </span>
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                @elseif($chapterItem?->type == 'document')
                                                                    <li class="course-item">
                                                                        <a href="javascript:;" class="course-item-link">
                                                                            <span
                                                                                class="item-name">{{ $chapterItem?->lesson?->title }}</span>
                                                                            <div class="course-item-meta">
                                                                                <span
                                                                                    class="item-meta duration">{{ minutesToHours($chapterItem?->lesson?->duration) }}</span>
                                                                                <span class="item-meta course-item-status">
                                                                                    <img src="{{ asset('frontend/img/icons/lock.svg') }}"
                                                                                        alt="icon">
                                                                                </span>
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                @elseif ($chapterItem->type == 'quiz')
                                                                    <li class="course-item">
                                                                        <a href="javascript:;" class="course-item-link">
                                                                            <span
                                                                                class="item-name">{{ $chapterItem?->quiz?->title }}</span>
                                                                            <div class="course-item-meta">
                                                                                <span
                                                                                    class="item-meta duration">{{ minutesToHours($chapterItem?->lesson?->duration) }}</span>
                                                                                <span class="item-meta course-item-status">
                                                                                    <img src="{{ asset('frontend/img/icons/lock.svg') }}"
                                                                                        alt="icon">
                                                                                </span>
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="instructors-tab-pane" role="tabpanel"
                                aria-labelledby="instructors-tab" tabindex="0">

                                <div class="courses__instructors-wrap">
                                    <div class="courses__instructors-thumb">
                                        <img src="{{ asset($course->instructor->image) }}" alt="img"
                                            class="instructor-thumb">
                                    </div>
                                    <div class="courses__instructors-content">
                                        <h2 class="title">{{ $course->instructor->name }}</h2>
                                        <span class="designation">{{ $course->instructor->job_title }}</span>
                                        <p>{{ $course->instructor->short_bio }}</p>
                                        <div class="instructor__social">
                                            <ul class="list-wrap justify-content-start">
                                                @if ($course->instructor->facebook)
                                                    <li><a href="{{ $course->instructor->facebook }}"
                                                            aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                                                    </li>
                                                @endif
                                                @if ($course->instructor->twitter)
                                                    <li><a href="{{ $course->instructor->twitter }}"
                                                            aria-label="Twitter"><i class="fab fa-twitter"></i></a></li>
                                                @endif
                                                @if ($course->instructor->linkedin)
                                                    <li><a href="{{ $course->instructor->linkedin }}"
                                                            aria-label="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                                @endif
                                                @if ($course->instructor->github)
                                                    <li><a href="{{ $course->instructor->github }}"
                                                            aria-label="Github"><i class="fab fa-github"></i></a></li>
                                                @endif

                                                @if ($course->instructor->facebook)
                                                    <li><a href="{{ $course->instructor->facebook }}"
                                                            aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                                                    </li>
                                                @endif
                                                @if ($course->instructor->twitter)
                                                    <li><a href="{{ $course->instructor->twitter }}"
                                                            aria-label="Twitter"><i class="fab fa-twitter"></i></a></li>
                                                @endif
                                                @if ($course->instructor->website)
                                                    <li><a href="{{ $course->instructor->website }}"
                                                            aria-label="Website"><i class="fas fa-link"></i></a></li>
                                                @endif
                                                @if ($course->instructor->github)
                                                    <li><a href="{{ $course->instructor->github }}"
                                                            aria-label="Github"><i class="fab fa-github"></i></a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @if ($course->partnerInstructors->count() > 0)
                                    <h3 class="title mt-3">{{ __('Partner Instructors') }}</h3>
                                    @foreach ($course->partnerInstructors as $instructor)
                                        <div class="courses__instructors-wrap">
                                            <div class="courses__instructors-thumb">
                                                <img src="{{ asset($instructor->instructor->image) }}" alt="img">
                                            </div>
                                            <div class="courses__instructors-content">
                                                <h2 class="title">{{ $instructor->instructor->name }}</h2>
                                                <span class="designation">{{ $instructor->instructor->job_title }}</span>
                                                <p>{{ $instructor->instructor->short_bio }}</p>
                                                <div class="instructor__social">
                                                    <ul class="list-wrap justify-content-start">
                                                        @if ($instructor->instructor->facebook)
                                                            <li><a href="{{ $instructor->instructor->facebook }}"
                                                                    aria-label="Facebook"><i
                                                                        class="fab fa-facebook-f"></i></a></li>
                                                        @endif
                                                        @if ($instructor->instructor->twitter)
                                                            <li><a href="{{ $instructor->instructor->twitter }}"
                                                                    aria-label="Twitter"><i
                                                                        class="fab fa-twitter"></i></a></li>
                                                        @endif
                                                        @if ($instructor->instructor->website)
                                                            <li><a href="{{ $instructor->instructor->website }}"
                                                                    aria-label="Website"><i class="fas fa-link"></i></a>
                                                            </li>
                                                        @endif
                                                        @if ($instructor->instructor->github)
                                                            <li><a href="{{ $instructor->instructor->github }}"
                                                                    aria-label="Github"><i class="fab fa-github"></i></a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel"
                                aria-labelledby="reviews-tab" tabindex="0">
                                <div class="courses__rating-wrap">
                                    <h2 class="title">{{ __('Reviews') }}</h2>
                                    <div class="course-rate">
                                        <div class="course-rate-summary">
                                            <div class="course-rate-summary-value">
                                                {{ number_format($course->reviews()->whereHas('course')->whereHas('user')->avg('rating'), 1) ?? 0 }}
                                            </div>
                                            <div class="course-rate-summary-stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="course-rate-summary-text">
                                                {{ $course->reviews()->whereHas('course')->whereHas('user')->where('status', 1)->count() }}
                                                {{ __('Ratings') }}
                                            </div>
                                        </div>
                                        @php
                                            $totalRating = $course->reviews_count;
                                            $fiveStar = $course
                                                ->reviews()
                                                ->where('rating', 5)
                                                ->where('status', 1)
                                                ->whereHas('course')
                                                ->whereHas('user')
                                                ->count();
                                            $fourStar = $course
                                                ->reviews()
                                                ->where('rating', 4)
                                                ->where('status', 1)
                                                ->whereHas('course')
                                                ->whereHas('user')
                                                ->count();
                                            $threeStar = $course
                                                ->reviews()
                                                ->where('rating', 3)
                                                ->where('status', 1)
                                                ->whereHas('course')
                                                ->whereHas('user')
                                                ->count();
                                            $twoStar = $course
                                                ->reviews()
                                                ->where('rating', 2)
                                                ->where('status', 1)
                                                ->whereHas('course')
                                                ->whereHas('user')
                                                ->count();
                                            $oneStar = $course
                                                ->reviews()
                                                ->where('rating', 1)
                                                ->where('status', 1)
                                                ->whereHas('course')
                                                ->whereHas('user')
                                                ->count();
                                            $totalPercentage = $totalRating > 0 ? ($fiveStar / $totalRating) * 100 : 0;
                                            $fourPercentage = $totalRating > 0 ? ($fourStar / $totalRating) * 100 : 0;
                                            $threePercentage = $totalRating > 0 ? ($threeStar / $totalRating) * 100 : 0;
                                            $twoPercentage = $totalRating > 0 ? ($twoStar / $totalRating) * 100 : 0;
                                            $onePercentage = $totalRating > 0 ? ($oneStar / $totalRating) * 100 : 0;
                                        @endphp
                                        <div class="course-rate-details">
                                            <div class="course-rate-details-row">
                                                <div class="course-rate-details-row-star">
                                                    5
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <div class="course-rate-details-row-value">
                                                    <div class="rating-gray">
                                                        <div class="rating" style="width: {{ $totalPercentage ?? 0 }}%" title="{{ $totalPercentage ?? 0 }}%"></div>
                                                    </div>
                                                    <span class="rating-count">{{ $fiveStar }}</span>
                                                </div>
                                            </div>
                                            <div class="course-rate-details-row">
                                                <div class="course-rate-details-row-star">
                                                    4
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <div class="course-rate-details-row-value">
                                                    <div class="rating-gray">
                                                        <div class="rating" style="width: {{ $fourPercentage ?? 0 }}%" title="{{ $fourPercentage ?? 0 }}%"></div>
                                                    </div>
                                                    <span class="rating-count">{{ $fourStar }}</span>
                                                </div>
                                            </div>
                                            <div class="course-rate-details-row">
                                                <div class="course-rate-details-row-star">
                                                    3
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <div class="course-rate-details-row-value">
                                                    <div class="rating-gray">
                                                        <div class="rating" style="width: {{ $threePercentage ?? 0 }}%" title="{{ $threePercentage ?? 0 }}%"></div>
                                                    </div>
                                                    <span class="rating-count">{{ $threeStar }}</span>
                                                </div>
                                            </div>
                                            <div class="course-rate-details-row">
                                                <div class="course-rate-details-row-star">
                                                    2
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <div class="course-rate-details-row-value">
                                                    <div class="rating-gray">
                                                        <div class="rating" style="width: {{ $twoPercentage ?? 0 }}%" title="{{ $twoPercentage ?? 0 }}%"></div>
                                                    </div>
                                                    <span class="rating-count">{{ $twoStar }}</span>
                                                </div>
                                            </div>
                                            <div class="course-rate-details-row">
                                                <div class="course-rate-details-row-star">
                                                    1
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <div class="course-rate-details-row-value">
                                                    <div class="rating-gray">
                                                        <div class="rating" style="width: {{ $onePercentage ?? 0 }}%" title="{{ $onePercentage ?? 0 }}%"></div>
                                                    </div>
                                                    <span class="rating-count">{{ $oneStar }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($reviews as $review)
                                        <div class="course-review-head">
                                            <div class="review-author-thumb">
                                                <img src="{{ asset($review?->user?->image) }}" alt="img">
                                            </div>
                                            <div class="review-author-content">
                                                <div class="author-name">
                                                    <h5 class="name">{{ $review?->user?->name }}
                                                        <span>{{ formatDate($review->created_at) }}</span>
                                                    </h5>
                                                    <div class="author-rating">
                                                        @for ($i = 1; $i <= $review->rating; $i++)
                                                            <i class="fas fa-star"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <p>{{ $review->review }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="courses__details-sidebar">
                        {{-- Course pricing removed for free learning system --}}
                        <div class="courses__information-wrap">
                            <h5 class="title">{{ __('Course includes') }}:</h5>
                            <ul class="list-wrap">
                                <li class="level-wrapper">
                                    <b>
                                        <img src="{{ asset('frontend/img/icons/course_icon01.svg') }}" alt="img"
                                            class="injectable">
                                        {{ __('Level') }}
                                    </b>
                                    <ul class="course-level-list">
                                        @foreach ($course->levels as $level)
                                            <span class="level">{{ @$level->level->translation->name }}</span>
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/img/icons/course_icon02.svg') }}" alt="img"
                                        class="injectable">
                                    {{ __('Duration') }}
                                    <span>{{ minutesToHours($course->duration) }}</span>
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/img/icons/course_icon03.svg') }}" alt="img"
                                        class="injectable">
                                    {{ __('Lessons') }}
                                    <span>{{ $courseLessonCount }}</span>
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/img/icons/course_icon04.svg') }}" alt="img"
                                        class="injectable">
                                    {{ __('Quizzes') }}
                                    <span>{{ $courseQuizCount }}</span>
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/img/icons/course_icon05.svg') }}" alt="img"
                                        class="injectable">
                                    {{ __('Certifications') }}
                                    @if ($course->certificate)
                                        <span>{{ __('Yes') }}</span>
                                    @else
                                        <span>{{ __('No') }}</span>
                                    @endif
                                </li>
                                <li class="level-wrapper">
                                    <b>
                                        <img src="{{ asset('frontend/img/icons/course_icon06.svg') }}" alt="img"
                                            class="injectable">
                                        {{ __('Language') }}
                                    </b>

                                    <ul class="course-language-list">
                                        @foreach ($course->languages as $language)
                                            <span>{{ $language->language->name }}</span>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="courses__details-social">
                            <h5 class="title">{{ __('Share this course') }}:</h5>
                            <div class="shareon">
                                <a class="facebook"></a>
                                <a class="linkedin"></a>
                                <a class="pinterest"></a>
                                <a class="telegram"></a>
                                <a class="twitter"></a>
                            </div>
                        </div>
                        <div class="courses__details-enroll">
                            <div class="tg-button-wrap">
                                @if (in_array($course->id, session('enrollments') ?? []))
                                    <a href="{{ route('student.enrolled-courses') }}"
                                        class="btn btn-two arrow-btn already-enrolled-btn" data-id="">
                                        <span class="text">{{ __('Enrolled') }}</span>
                                        <i class="flaticon-arrow-right"></i>
                                    </a>
                                @else
                                    <a href="javascript:;" class="btn btn-two arrow-btn start-learning-btn"
                                        data-id="{{ $course->id }}">
                                        <span class="text">{{ __('Start Learning') }}</span>
                                        <i class="flaticon-arrow-right"></i>
                                    </a>
                                @endif
                            </div>
                            @if (Module::has('GiftCourse') && Module::isEnabled('GiftCourse'))
                                <div class="d-block text-center mt-3">
                                    <a href="{{ route('gift-course', $course->slug) }}" class="btn btn-four arrow-btn">
                                        <i class="fas fa-gift"></i> {{ __('Gift This Course') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Google Drive player modal Structure -->
    <div class="google_drive_modal">
        <div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="ratio ratio-16x9">
                            <iframe class="iframe-video" src="" width="640" height="680" allow="autoplay"
                                frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- courses-details-area-end -->
@endsection

@push('scripts')
    <script src="{{ asset('frontend/js/default/course-details.js') }}"></script>
    <script src="{{ asset('frontend/js/shareon.iife.js') }}"></script>
    <script>
        Shareon.init();
    </script>

    @if ($setting->google_tagmanager_status == 'active' && $marketing_setting?->course_details)
        <script>
            $(document).ready(function() {
                dataLayer.push({
                    'event': 'courseDetails',
                    'courses': {
                        'name': '{{ $course?->title }}',
                        'price': '{{ currency($course->price) }}',
                        'instructor': '{{ $course->instructor->name }}',
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
