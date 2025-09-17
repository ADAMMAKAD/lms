@forelse ($courses as $course)
    <div class="modern-course-card">
        <div class="course-card-inner">
            <!-- Course Thumbnail -->
            <div class="course-thumbnail">
                <img src="{{ asset($course->thumbnail) }}" alt="{{ $course->title }}" class="course-image">
                <div class="course-overlay">
                    <div class="course-category">
                        @if($course->category)
                            <span class="category-badge">{{ $course->category->translation->name ?? 'Course' }}</span>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Course Content -->
            <div class="course-content">
                <!-- Course Meta -->
                <div class="course-meta">
                    @if($course->instructor)
                        <span class="instructor-name">{{ $course->instructor->name }}</span>
                    @endif
                    @if($course->level)
                        <span class="course-level">{{ $course->level->translation->name }}</span>
                    @endif
                </div>
                
                <!-- Course Title -->
                <h3 class="course-title">
                    <a href="{{ route('course.show', $course->slug) }}">{{ $course->title }}</a>
                </h3>
                
                <!-- Course Stats -->
                <div class="course-stats">
                    <div class="stat-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>4.8</span>
                    </div>
                    <div class="stat-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>{{ number_format(rand(1000, 50000)) }}</span>
                    </div>
                </div>
                
                <!-- Course Action -->
                <div class="course-action">
                    @if (in_array($course->id, session('enrollments') ?? []))
                        <a href="{{ route('student.enrolled-courses') }}" class="btn-enrolled">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ __('Continue Learning') }}
                        </a>
                    @else
                        <a href="{{ route('course.show', $course->slug) }}" class="btn-enroll">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 12l2 2 4-4"/>
                                <circle cx="12" cy="12" r="10"/>
                            </svg>
                            Enroll Now
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="w-100" style="text-align: center; padding: 60px 20px; background: white; border-radius: 20px; box-shadow: 0 8px 30px rgba(0,0,0,0.08); border: 1px solid rgba(0,102,204,0.1);">
        <div style="font-size: 4rem; color: #e5e7eb; margin-bottom: 20px;">
            <i class="fas fa-search"></i>
        </div>
        <h6 style="font-size: 1.5rem; font-weight: 600; color: #374151; margin-bottom: 12px;">{{ __('No Courses Found') }}</h6>
        <p style="color: #6b7280; font-size: 16px; margin-bottom: 24px;">{{ __('Try adjusting your search criteria or browse our featured courses.') }}</p>
        <a href="{{ route('courses') }}" style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #282f76, #282f76); color: white; padding: 12px 24px; border-radius: 12px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0, 102, 204, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0, 102, 204, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0, 102, 204, 0.3)';">
            <i class="fas fa-arrow-left"></i>
            <span>{{ __('Browse All Courses') }}</span>
        </a>
    </div>
@endforelse

<style>
/* Modern Course Card Styles */
.modern-course-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 1px solid #e5e7eb;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.modern-course-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    border-color: #0056d3;
}

.course-card-inner {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.course-thumbnail {
    position: relative;
    overflow: hidden;
    aspect-ratio: 16/9;
}

.course-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.modern-course-card:hover .course-image {
    transform: scale(1.05);
}

.course-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), transparent);
    display: flex;
    align-items: flex-start;
    justify-content: flex-end;
    padding: 16px;
}

.category-badge {
    background: rgba(255, 255, 255, 0.9);
    color: #374151;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    backdrop-filter: blur(10px);
}

.course-content {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.course-meta {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
    font-size: 14px;
}

.instructor-name {
    color: #6b7280;
    font-weight: 500;
}

.course-level {
    color: #0056d3;
    font-weight: 600;
    background: #eff6ff;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 12px;
}

.course-title {
    margin: 0 0 16px 0;
    font-size: 18px;
    font-weight: 700;
    line-height: 1.4;
}

.course-title a {
    color: #1f2937;
    text-decoration: none;
    transition: color 0.3s ease;
}

.course-title a:hover {
    color: #0056d3;
}

.course-stats {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 20px;
    color: #6b7280;
    font-size: 14px;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 4px;
}

.stat-item svg {
    color: #fbbf24;
}

.course-action {
    margin-top: auto;
}

.btn-enroll,
.btn-enrolled {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 12px 20px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-enroll {
    background: #0056d3;
    color: white;
}

.btn-enroll:hover {
    background: #004bb5;
    transform: translateY(-1px);
}

.btn-enrolled {
    background: #10b981;
    color: white;
}

.btn-enrolled:hover {
    background: #059669;
    transform: translateY(-1px);
}

/* Animation */
.modern-course-card {
    animation: fadeInUp 0.6s ease-out both;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .course-content {
        padding: 16px;
    }
    
    .course-title {
        font-size: 16px;
    }
}
</style>
