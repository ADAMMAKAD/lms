@extends('frontend.student-dashboard.layouts.master')

@section('dashboard-contents')
    <div class="dashboard__content-wrap">
        <div class="dashboard__content-title d-flex justify-content-between">
            <h4 class="title">{{ __('Course History') }}</h4>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="tab-content" id="courseTabContent">
                            @forelse ($courses as $course)
                                <div class="tab-pane fade show active" id="all-tab-pane" role="tabpanel"
                                    aria-labelledby="all-tab" tabindex="0">
                                    <div class="dashboard-courses-active dashboard_courses">
                                        <div class="courses__item courses__item-two shine__animate-item">
                                            <div class="row align-items-center">
                                                <div class="col-xl-5">
                                                    <div class="courses__item-thumb courses__item-thumb-two">
                                                        <a href="{{ route('student.learning.index', $course->slug) }}"
                                                            class="shine__animate-link">
                                                            <img src="{{ asset($course->thumbnail) }}"
                                                                alt="img">
                                                        </a>
                                                        @if($course->status == 'completed')
                                                            <div class="course-status-badge completed">
                                                                <i class="fas fa-check-circle"></i> {{ __('Completed') }}
                                                            </div>
                                                        @else
                                                            <div class="course-status-badge in-progress">
                                                                <i class="fas fa-play-circle"></i> {{ __('In Progress') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xl-7">
                                                    <div class="courses__item-content courses__item-content-two">
                                                        <ul class="courses__item-meta list-wrap">
                                                            <li class="courses__item-tag">
                                                                <a href="javascript:;">{{ $course->category->translation->name ?? $course->category->name ?? 'Uncategorized' }}</a>
                                                            </li>
                                                        </ul>

                                                        <h5 class="title"><a
                                                                href="{{ route('student.learning.index', $course->slug) }}">{{ $course->title }}</a>
                                                        </h5>
                                                        <div class="courses__item-content-bottom">
                                                            <div class="author-two">
                                                                <a href="javascript:;"><img
                                                                        src="{{ asset($course->instructor->image ?? 'default-avatar.png') }}"
                                                                        alt="img">{{ $course->instructor->name ?? 'Unknown Instructor' }}</a>
                                                            </div>
                                                            <div class="avg-rating">
                                                                <i class="fas fa-star"></i>
                                                                {{ number_format($course->reviews()->avg('rating') ?? 0, 1) }}
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="progress-item progress-item-two">
                                                            <h6 class="title">
                                                                {{ __('PROGRESS') }}<span>{{ $course->progress_percent }}%</span>
                                                            </h6>
                                                            <div class="progress" role="progressbar"
                                                                aria-label="Course progress" aria-valuenow="{{ $course->progress_percent }}"
                                                                aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-bar @if($course->status == 'completed') bg-success @else bg-primary @endif"
                                                                    style="width: {{ $course->progress_percent }}%">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="courses__item-bottom-two">
                                                        <ul class="list-wrap">
                                                            <li><i class="flaticon-book"></i>{{ $course->total_lectures }} {{ __('Lectures') }}</li>
                                                            <li><i class="fas fa-check-circle"></i>{{ $course->completed_lectures }} {{ __('Completed') }}</li>
                                                            <li><i class="flaticon-clock"></i>{{ minutesToHours($course->duration ?? 0) }}</li>
                                                            @if ($course->status == 'completed')
                                                                <li class="ms-auto">
                                                                    <a class="basic-button"
                                                                        href="{{ route('student.download-certificate', $course->id) }}"><i
                                                                            class="certificate fas fa-download"></i>
                                                                        {{ __('Certificate') }}</a>
                                                                </li>
                                                            @else
                                                                <li class="ms-auto">
                                                                    <a class="basic-button btn-primary"
                                                                        href="{{ route('student.learning.index', $course->slug) }}">
                                                                        <i class="fas fa-play"></i> {{ __('Continue Learning') }}
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                                    <h6>{{ __('No Course History Found') }}</h6>
                                    <p class="text-muted">{{ __('Start learning courses to see your progress here.') }}</p>
                                    <a href="{{ route('courses') }}" class="btn btn-primary mt-3">
                                        <i class="fas fa-search"></i> {{ __('Browse Courses') }}
                                    </a>
                                </div>
                            @endforelse
                        </div>
                        @if($courses->hasPages())
                            <div class="course-history pagination__wrap mt-25">
                                {{ $courses->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .course-status-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            color: white;
            z-index: 2;
        }
        
        .course-status-badge.completed {
            background: linear-gradient(135deg, #28a745, #20c997);
        }
        
        .course-status-badge.in-progress {
            background: linear-gradient(135deg, #3B82F6, #1D4ED8);
        }
        
        .progress-bar.bg-success {
            background: linear-gradient(90deg, #28a745, #20c997) !important;
        }
        
        .progress-bar.bg-primary {
            background: linear-gradient(90deg, #3B82F6, #1D4ED8) !important;
        }
    </style>
@endsection