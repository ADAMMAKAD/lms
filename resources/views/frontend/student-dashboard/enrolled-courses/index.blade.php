@extends('frontend.student-dashboard.layouts.master')

@section('title', __('My Enrolled Courses'))

@push('styles')
<style>
/* Coursera-Inspired Compact Design */
.modern-enrolled-courses {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 1.5rem 0;
}

.courses-header {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.header-info h1 {
    color: #1f2937;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.header-info p {
    color: #6b7280;
    font-size: 1rem;
    margin: 0;
}

.header-stats {
    display: flex;
    gap: 1.5rem;
}

.stat-item {
    text-align: center;
    background: #f8f9fa;
    padding: 1rem 1.5rem;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
}

.stat-number {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    color: #0056d3;
    margin-bottom: 0.25rem;
}

.stat-label {
    color: #6b7280;
    font-size: 0.875rem;
    font-weight: 500;
}

/* Compact Grid Layout - Coursera Style */
.courses-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

/* Compact Course Cards */
.modern-course-card {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
    transition: all 0.2s ease;
    position: relative;
    height: fit-content;
}

.modern-course-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
}

/* Compact Thumbnail */
.course-thumbnail {
    position: relative;
    height: 140px;
    overflow: hidden;
}

.course-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.2s ease;
}

.modern-course-card:hover .course-thumbnail img {
    transform: scale(1.05);
}

.course-status-badge {
    position: absolute;
    top: 0.75rem;
    right: 0.75rem;
    padding: 0.25rem 0.75rem;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 600;
    backdrop-filter: blur(10px);
}

.status-unlocked {
    background: rgba(34, 197, 94, 0.9);
    color: white;
}

.status-locked {
    background: rgba(245, 158, 11, 0.9);
    color: white;
}

.lock-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
}

/* Compact Content */
.course-content {
    padding: 1rem;
}

.course-category {
    display: inline-block;
    background: #0056d3;
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
}

.course-title {
    font-size: 1rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.75rem;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 2.8rem;
}

.course-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s ease;
}

.course-title a:hover {
    color: #0056d3;
}

.course-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid #f3f4f6;
}

.instructor-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.instructor-avatar {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    object-fit: cover;
}

.instructor-name {
    font-size: 0.8rem;
    color: #6b7280;
    font-weight: 500;
}

.course-rating {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    color: #fbbf24;
    font-size: 0.8rem;
    font-weight: 600;
}

/* Compact Progress Section */
.progress-section {
    margin-bottom: 1rem;
}

.progress-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
}

.progress-label {
    font-size: 0.8rem;
    color: #6b7280;
    font-weight: 500;
}

.progress-percentage {
    font-size: 0.8rem;
    font-weight: 600;
    color: #0056d3;
}

.modern-progress-bar {
    height: 6px;
    background: #e5e7eb;
    border-radius: 3px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: #0056d3;
    border-radius: 3px;
    transition: width 0.3s ease;
}

.course-stats {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.stat-item-small {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    color: #6b7280;
    font-size: 0.75rem;
}

/* Compact Action Buttons */
.course-actions {
    display: flex;
    gap: 0.5rem;
}

.btn-continue {
    flex: 1;
    background: #0056d3;
    color: white;
    border: none;
    padding: 0.6rem 1rem;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    text-align: center;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.375rem;
}

.btn-continue:hover {
    background: #004bb5;
    transform: translateY(-1px);
    color: white;
}

.btn-certificate {
    background: #059669;
    color: white;
    border: none;
    padding: 0.6rem 1rem;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 0.375rem;
}

.btn-certificate:hover {
    background: #047857;
    transform: translateY(-1px);
    color: white;
}

.empty-state {
    text-align: center;
    padding: 3rem 2rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
}

.empty-icon {
    font-size: 3rem;
    color: #d1d5db;
    margin-bottom: 1rem;
}

.empty-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.75rem;
}

.empty-description {
    color: #6b7280;
    margin-bottom: 1.5rem;
    line-height: 1.5;
}

.btn-browse {
    background: #0056d3;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-browse:hover {
    background: #004bb5;
    transform: translateY(-1px);
    color: white;
}

.modern-pagination {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

.modern-pagination .pagination {
    background: white;
    border-radius: 8px;
    padding: 0.75rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
}

/* Responsive Design */
@media (max-width: 768px) {
    .courses-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1rem;
    }
    
    .header-content {
        flex-direction: column;
        text-align: center;
    }
    
    .header-stats {
        justify-content: center;
        gap: 1rem;
    }
    
    .course-actions {
        flex-direction: column;
    }
    
    .modern-enrolled-courses {
        padding: 1rem 0;
    }
    
    .courses-header {
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
}

@media (max-width: 480px) {
    .courses-grid {
        grid-template-columns: 1fr;
    }
    
    .header-stats {
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .stat-item {
        padding: 0.75rem 1rem;
    }
}
</style>
@endpush

@section('dashboard-contents')
    <div class="modern-enrolled-courses">
        <!-- Professional Header -->
        <div class="courses-header">
            <div class="header-content">
                <div class="header-info">
                    <h1>{{ __('My Learning Journey') }}</h1>
                    <p>{{ __('Continue your education with your enrolled courses') }}</p>
                </div>
                <div class="header-stats">
                    <div class="stat-item">
                        <span class="stat-number">{{ $enrolls->total() }}</span>
                        <span class="stat-label">{{ __('Enrolled') }}</span>
                    </div>
                    <div class="stat-item">
                        @php
                            $completedCount = 0;
                            foreach($enrolls as $enroll) {
                                $courseLectureCount = App\Models\CourseChapterItem::whereHas('chapter', function ($q) use ($enroll) {
                                    $q->where('course_id', $enroll->course->id);
                                })->count();
                                $courseLectureCompletedByUser = App\Models\CourseProgress::where('user_id', userAuth()->id)
                                    ->where('course_id', $enroll->course->id)
                                    ->where('watched', 1)
                                    ->count();
                                $courseCompletedPercent = $courseLectureCount > 0 ? ($courseLectureCompletedByUser / $courseLectureCount) * 100 : 0;
                                if($courseCompletedPercent == 100) $completedCount++;
                            }
                        @endphp
                        <span class="stat-number">{{ $completedCount }}</span>
                        <span class="stat-label">{{ __('Completed') }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ $enrolls->total() - $completedCount }}</span>
                        <span class="stat-label">{{ __('In Progress') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Courses Grid -->
        @forelse ($enrolls as $enroll)
            @if($loop->first)
                <div class="courses-grid">
            @endif
            
            @php
                $courseLectureCount = App\Models\CourseChapterItem::whereHas('chapter', function ($q) use ($enroll) {
                    $q->where('course_id', $enroll->course->id);
                })->count();

                $courseLectureCompletedByUser = App\Models\CourseProgress::where('user_id', userAuth()->id)
                    ->where('course_id', $enroll->course->id)
                    ->where('watched', 1)
                    ->count();
                    
                $courseCompletedPercent = $courseLectureCount > 0 ? ($courseLectureCompletedByUser / $courseLectureCount) * 100 : 0;
            @endphp

            <div class="modern-course-card">
                <div class="course-thumbnail">
                    @if($enroll->course->is_locked ?? false)
                        <img src="{{ asset($enroll->course->thumbnail) }}" alt="{{ $enroll->course->title }}">
                        <div class="lock-overlay">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="course-status-badge status-locked">
                            <i class="fas fa-lock me-1"></i>{{ __('Locked') }}
                        </div>
                    @else
                        <a href="{{ route('student.learning.index', $enroll->course->slug) }}">
                            <img src="{{ asset($enroll->course->thumbnail) }}" alt="{{ $enroll->course->title }}">
                        </a>
                        <div class="course-status-badge status-unlocked">
                            <i class="fas fa-unlock me-1"></i>{{ __('Unlocked') }}
                        </div>
                    @endif
                </div>

                <div class="course-content">
                    <div class="course-category">
                        {{ $enroll->course->category->translation->name ?? $enroll->course->category->name ?? __('Uncategorized') }}
                    </div>

                    <h3 class="course-title">
                        @if($enroll->course->is_locked ?? false)
                            <span>{{ $enroll->course->title }}</span>
                        @else
                            <a href="{{ route('student.learning.index', $enroll->course->slug) }}">
                                {{ $enroll->course->title }}
                            </a>
                        @endif
                    </h3>

                    <div class="course-meta">
                        <div class="instructor-info">
                            <img src="{{ asset($enroll->course->instructor->image ?? 'frontend/img/default-avatar.png') }}" 
                                 alt="{{ $enroll->course->instructor->name ?? __('Unknown Instructor') }}" 
                                 class="instructor-avatar">
                            <span class="instructor-name">{{ $enroll->course->instructor->name ?? __('Unknown Instructor') }}</span>
                        </div>
                        <div class="course-rating">
                            <i class="fas fa-star"></i>
                            <span>{{ number_format($enroll->course->reviews()->avg('rating') ?? 0, 1) }}</span>
                        </div>
                    </div>

                    <div class="progress-section">
                        <div class="progress-header">
                            <span class="progress-label">{{ __('Progress') }}</span>
                            <span class="progress-percentage">{{ number_format($courseCompletedPercent, 1) }}%</span>
                        </div>
                        <div class="modern-progress-bar">
                            <div class="progress-fill" style="width: {{ number_format($courseCompletedPercent, 1) }}%"></div>
                        </div>
                    </div>

                    <div class="course-stats">
                        <div class="stat-item-small">
                            <i class="fas fa-book"></i>
                            <span>{{ $courseLectureCount }} {{ __('Lessons') }}</span>
                        </div>
                        <div class="stat-item-small">
                            <i class="fas fa-clock"></i>
                            <span>{{ minutesToHours($enroll->course->duration ?? 0) }}</span>
                        </div>
                        <div class="stat-item-small">
                            <i class="fas fa-users"></i>
                            <span>{{ $enroll->course->progresses()->distinct('user_id')->count() }} {{ __('Students') }}</span>
                        </div>
                    </div>

                    <div class="course-actions">
                        @if(!($enroll->course->is_locked ?? false))
                            <a href="{{ route('student.learning.index', $enroll->course->slug) }}" class="btn-continue">
                                <i class="fas fa-play"></i>
                                {{ $courseCompletedPercent > 0 ? __('Continue Learning') : __('Start Learning') }}
                            </a>
                        @endif
                        
                        @if ($courseCompletedPercent == 100)
                            <a href="{{ route('student.download-certificate', $enroll->course->id) }}" class="btn-certificate">
                                <i class="fas fa-certificate"></i>
                                {{ __('Certificate') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            @if($loop->last)
                </div>
            @endif
        @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3 class="empty-title">{{ __('No Enrolled Courses Yet') }}</h3>
                <p class="empty-description">
                    {{ __('Start your learning journey by enrolling in courses that interest you.') }}
                </p>
                <a href="{{ route('courses') }}" class="btn-browse">
                    <i class="fas fa-search"></i>
                    {{ __('Browse Courses') }}
                </a>
            </div>
        @endforelse

        <!-- Pagination -->
        @if($enrolls->hasPages())
            <div class="modern-pagination">
                {{ $enrolls->links() }}
            </div>
        @endif
    </div>
@endsection
