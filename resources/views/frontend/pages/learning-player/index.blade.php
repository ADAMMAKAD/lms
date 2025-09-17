@extends('frontend.pages.learning-player.master')

@section('meta_title')
    {{ $course->title }}
@endsection

@section('meta_description')
    {{ $course->short_description }}
@endsection

@section('contents')
    <div class="learning-container">
        <!-- Top Navigation Bar -->
        <div class="learning-header">
            <div class="learning-header-left">
                <a href="{{ route('course.show', $course->slug) }}" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div class="course-info">
                    <h1 class="course-title">{{ $course->title }}</h1>
                    <div class="lesson-title">{{ $currentProgress?->lesson->title ?? 'Course Overview' }}</div>
                </div>
            </div>
            <div class="learning-header-right">
                <div class="progress-indicator">
                    <span class="progress-text">{{ number_format($courseCompletedPercent) }}% {{ __('Complete') }}</span>
                    <div class="progress-bar-container">
                        <div class="progress-bar-fill" style="width: {{ $courseCompletedPercent }}%"></div>
                    </div>
                </div>
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-list"></i>
                    <span>{{ __('Course Content') }}</span>
                </button>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="learning-content">
            <!-- Video Player Section -->
            <div class="video-section">
                <div class="video-player-container">
                    <div class="video-player video-payer" id="videoPlayer">
                        <!-- Video player will be loaded here -->
                        <div class="video-placeholder">
                            <div class="preloader-two player">
                                <div class="loader-icon-two player"><img src="{{ asset(Cache::get('setting')->preloader) }}"
                                        alt="Preloader">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Video Controls -->
                <div class="video-controls">
                    <div class="video-controls-left">
                        <button class="control-btn prev-lesson" title="{{ __('Previous Lesson') }}">
                            <i class="fas fa-step-backward"></i>
                        </button>
                        <button class="control-btn next-lesson" title="{{ __('Next Lesson') }}">
                            <i class="fas fa-step-forward"></i>
                        </button>
                    </div>
                    <div class="video-controls-right">
                        <button class="control-btn playback-speed" title="{{ __('Playback Speed') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>1x</span>
                        </button>
                        <button class="control-btn fullscreen" title="{{ __('Fullscreen') }}">
                            <i class="fas fa-expand"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Content Tabs -->
            <div class="content-tabs">
                <div class="tab-navigation">
                    <button class="tab-button active" data-tab="overview">
                        <i class="fas fa-info-circle"></i>
                        {{ __('Overview') }}
                    </button>
                    <button class="tab-button" data-tab="qna">
                        <i class="fas fa-question-circle"></i>
                        {{ __('Q&A') }}
                    </button>
                    <button class="tab-button" data-tab="announcements">
                        <i class="fas fa-bullhorn"></i>
                        {{ __('Announcements') }}
                    </button>
                    <button class="tab-button" data-tab="reviews">
                        <i class="fas fa-star"></i>
                        {{ __('Reviews') }}
                    </button>
                </div>

                <div class="tab-content">
                    <div class="tab-panel active" id="overview">
                        <div class="overview-content">
                            <h3>{{ __('About this Lesson') }}</h3>
                            <div class="lesson-description">
                                {{ $currentProgress?->lesson->description ?? __('No description available for this lesson.') }}
                            </div>
                            
                            @if($currentProgress?->lesson->resources ?? false)
                            <div class="lesson-resources">
                                <h4>{{ __('Resources') }}</h4>
                                <div class="resources-list">
                                    <!-- Resources will be loaded here -->
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="tab-panel" id="qna">
                        @include('frontend.pages.learning-player.bottom-panel')
                    </div>

                    <div class="tab-panel" id="announcements">
                        <div class="announcements-content">
                            <h3>{{ __('Course Announcements') }}</h3>
                            <div class="announcements-list">
                                <div class="empty-state">
                                    <i class="fas fa-bullhorn"></i>
                                    <p>{{ __('No announcements yet.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-panel" id="reviews">
                        <div class="reviews-content">
                            <h3>{{ __('Student Reviews') }}</h3>
                            <div class="reviews-list">
                                @if($reviews && $reviews->count() > 0)
                                    @foreach($reviews as $review)
                                        <div class="review-item">
                                            <div class="review-header">
                                                <div class="reviewer-info">
                                                    <div class="reviewer-avatar">
                                                        @if($review->user->image)
                                                            <img src="{{ asset($review->user->image) }}" alt="{{ $review->user->name }}">
                                                        @else
                                                            <div class="avatar-placeholder">
                                                                {{ substr($review->user->name, 0, 1) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="reviewer-details">
                                                        <h4>{{ $review->user->name }}</h4>
                                                        <div class="review-rating">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <i class="fas fa-star {{ $i <= $review->rating ? 'active' : '' }}"></i>
                                                            @endfor
                                                            <span class="rating-text">({{ $review->rating }}/5)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="review-date">
                                                    {{ $review->created_at->format('M d, Y') }}
                                                </div>
                                            </div>
                                            @if($review->comment)
                                                <div class="review-comment">
                                                    <p>{{ $review->comment }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <div class="empty-state">
                                        <i class="fas fa-star"></i>
                                        <p>{{ __('No reviews yet.') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Course Sidebar -->
        <div class="course-sidebar" id="courseSidebar">
            <div class="sidebar-header">
                <h3>{{ __('Course Content') }}</h3>
                <button class="sidebar-close" id="sidebarClose">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="sidebar-content">
                <div class="course-progress-summary">
                    <div class="progress-circle">
                        <svg class="progress-ring" width="60" height="60">
                            <circle class="progress-ring-circle" stroke="var(--tg-theme-primary)" stroke-width="4" 
                                    fill="transparent" r="26" cx="30" cy="30" 
                                    style="stroke-dasharray: {{ 2 * 3.14159 * 26 }}; stroke-dashoffset: {{ 2 * 3.14159 * 26 * (1 - $courseCompletedPercent / 100) }}"/>
                        </svg>
                        <span class="progress-percentage">{{ number_format($courseCompletedPercent) }}%</span>
                    </div>
                    <div class="progress-info">
                        <p class="progress-label">{{ __('Course Progress') }}</p>
                        <p class="lessons-completed">{{ $courseLectureCompletedByUser }} / {{ $courseLectureCount }} {{ __('lessons completed') }}</p>
                    </div>
                </div>

                <div class="course-chapters">
                    @foreach ($course->chapters as $chapter)
                        <div class="chapter-item">
                            <div class="chapter-header" data-chapter="{{ $chapter->id }}">
                                <div class="chapter-info">
                                    <h4 class="chapter-title">{{ $chapter->title }}</h4>
                                    <span class="chapter-duration">{{ $chapter->total_duration ?? '0 min' }}</span>
                                </div>
                                <i class="fas fa-chevron-down chapter-toggle"></i>
                            </div>
                            
                            <div class="chapter-content {{ $currentProgress?->chapter_id == $chapter->id ? 'show' : '' }}" id="chapter-{{ $chapter->id }}">
                                <div class="lessons-list">
                                    @foreach ($chapter->chapterItems as $chapterItem)
                                        @if ($chapterItem->type == 'lesson' || $chapterItem->type == 'live')
                                            <div class="lesson-item {{ $chapterItem->lesson->id == $currentProgress?->lesson_id ? 'active' : '' }}" 
                                                 data-lesson-id="{{ $chapterItem->lesson->id }}">
                                                <div class="lesson-checkbox">
                                                    <input type="checkbox" id="lesson_{{ $chapterItem->lesson->id }}"
                                                        {{ in_array($chapterItem->lesson->id, $alreadyWatchedLectures) ? 'checked' : '' }}
                                                        class="form-check-input lesson-completed-checkbox"
                                                        data-lesson-id="{{ $chapterItem->lesson->id }}" value="1"
                                                        data-type="{{ $chapterItem->type }}">
                                                    <label for="lesson_{{ $chapterItem->lesson->id }}"></label>
                                                </div>
                                                <div class="lesson-content">
                                                    <div class="lesson-link"
                                                         data-lesson-id="{{ $chapterItem->lesson->id }}"
                                                         data-chapter-id="{{ $chapter->id }}" data-course-id="{{ $course->id }}"
                                                         data-type="{{ $chapterItem->type }}">
                                                        <div class="lesson-icon {{ $chapterItem->type }}">
                                                            <img src="{{ $chapterItem->type == 'live' ? asset('frontend/img/live.png') : asset('frontend/img/video_icon_black_2.png') }}"
                                                                alt="video" class="img-fluid">
                                                        </div>
                                                        <div class="lesson-details">
                                                            <span class="lesson-title">{{ $chapterItem->lesson->title }}</span>
                                                            <span class="lesson-duration">{{ $chapterItem->lesson->duration ? minutesToHours($chapterItem->lesson->duration) : '--.--' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($chapterItem->type == 'document')
                                            <div class="lesson-item document {{ $chapterItem->lesson->id == $currentProgress?->lesson_id ? 'active' : '' }}">
                                                <div class="lesson-checkbox">
                                                    <input type="checkbox" id="doc_{{ $chapterItem->lesson->id }}"
                                                        {{ in_array($chapterItem->lesson->id, $alreadyWatchedLectures) ? 'checked' : '' }}
                                                        class="form-check-input lesson-completed-checkbox"
                                                        data-lesson-id="{{ $chapterItem->lesson->id }}" value="1"
                                                        data-type="document">
                                                    <label for="doc_{{ $chapterItem->lesson->id }}"></label>
                                                </div>
                                                <div class="lesson-content">
                                                    <div class="lesson-link"
                                                         data-lesson-id="{{ $chapterItem->lesson->id }}"
                                                         data-chapter-id="{{ $chapter->id }}" data-course-id="{{ $course->id }}"
                                                         data-type="document">
                                                        <div class="lesson-icon document">
                                                            <img src="{{ asset('frontend/img/' . $chapterItem->lesson->file_type . '.png') }}"
                                                                alt="document" class="img-fluid">
                                                        </div>
                                                        <div class="lesson-details">
                                                            <span class="lesson-title">{{ $chapterItem->lesson->title }}</span>
                                                            <span class="lesson-type">{{ __('Document') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="lesson-item quiz">
                                                <div class="lesson-checkbox">
                                                    <input type="checkbox" id="quiz_{{ $chapterItem->quiz->id }}"
                                                        {{ in_array($chapterItem->quiz->id, $alreadyCompletedQuiz) ? 'checked' : '' }}
                                                        class="form-check-input lesson-completed-checkbox"
                                                        data-lesson-id="{{ $chapterItem->quiz->id }}" value="1"
                                                        data-type="quiz">
                                                    <label for="quiz_{{ $chapterItem->quiz->id }}"></label>
                                                </div>
                                                <div class="lesson-content">
                                                    <div class="lesson-link"
                                                         data-chapter-id="{{ $chapter->id }}" data-course-id="{{ $course->id }}"
                                                         data-lesson-id="{{ $chapterItem->quiz->id }}" data-type="quiz">
                                                        <div class="lesson-icon quiz">
                                                            <i class="fas fa-question-circle"></i>
                                                        </div>
                                                        <div class="lesson-details">
                                                            <span class="lesson-title">{{ $chapterItem->quiz->title }}</span>
                                                            <span class="lesson-type">{{ __('Quiz') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
    </div>
@endsection
@push('scripts')
    <script>
        var preloader_path = "{{ asset(Cache::get('setting')->preloader) }}";
        var watermark = "{{ property_exists($setting, 'watermark_img') ? asset($setting->watermark_img) : '' }}";
    </script>
    <script src="{{ asset('frontend/js/videojs-watermark.min.js') }}"></script>
    <script src="{{ asset('frontend/js/default/learning-player.js') }}?v={{ $setting?->version }}"></script>
    <script src="{{ asset('frontend/js/default/quiz-page.js') }}?v={{ $setting?->version }}"></script>
    <script src="{{ asset('frontend/js/default/qna.js') }}?v={{ $setting?->version }}"></script>
    <script src="{{ asset('frontend/js/default/qna.js') }}?v={{ $setting?->version }}"></script>
    <script src="{{ asset('frontend/js/pdf.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jszip.min.js') }}"></script>
    <script src="{{ asset('frontend/js/docx-preview.min.js') }}"></script>
    <script>
        "use strict";
        $(document).ready(function() {
            // reset quiz timer
            resetCountdown();
            // auto click on current lesson
            var lessonId = "{{ request('lesson') }}";
            var type = "{{ request('type') }}";
            var currentLessonSelector = $(
                '.lesson-item[data-lesson-id="{{ $currentProgress?->lesson_id }}"][data-type="{{ $currentProgress?->type }}"]'
            );
            var targetLessonSelector = $(`.lesson-item[data-lesson-id="${lessonId}"][data-type="${type}"]`);

            if (targetLessonSelector.length) {
                targetLessonSelector.trigger('click');
            } else if (currentLessonSelector.length) {
                currentLessonSelector.trigger('click');
            } else {
                $('.lesson-item:first').trigger('click');
            }

        })
    </script>
    <script src="{{ asset('frontend/js/custom-tinymce.js') }}"></script>
@endpush
@push('styles')
    <style>
.vjs-watermark {
    max-width: {{ $setting?->max_width ?? '300' }}px;
    opacity: {{ $setting?->opacity ?? '0.7' }} !important;
    @php $position =$setting?->position ?? 'top_right'; @endphp
    @if ($position === 'top_left')
    top: 0;
    left: 0;
    @elseif ($position === 'bottom_right') 
    bottom: 44px;
    right: 0;
    @elseif ($position === 'bottom_left') 
    bottom: 44px;
    left: 0;
    @else
    top: 0;
    right: 0;
    @endif
    @if ((property_exists($setting, 'watermark_status') ? $setting?->watermark_status : 'inactive')  === 'active')
    display:inline;
    @endif
}
    </style>
@endpush
