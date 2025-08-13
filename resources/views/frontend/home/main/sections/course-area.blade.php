@php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

// Get all courses for simple grid display
$allCourses = App\Models\Course::with('favoriteBy','category.translation', 'instructor')
    ->where('status', 'active')
    ->whereHas('instructor') // Only get courses that have instructors
    ->withCount([
        'reviews as avg_rating' => function ($query) {
            $query->select(DB::raw('coalesce(avg(rating), 0)'));
        },
    ])
    ->take(8) // Show 8 courses in grid
    ->get();
@endphp

<section class="courses-area py-5" style="background: #f8f9fa;">
    <div class="container">
        <!-- Simple Header -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="section-title" style="font-size: 2.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 1rem;">
                    {{ __('Our Latest Courses') }}
                </h2>
                <p class="section-subtitle" style="color: #6c757d; font-size: 1.1rem; margin-bottom: 2rem;">
                    {{ __('Explore New Skills and Knowledge') }}
                </p>
                
            </div>
        </div>
        <!-- Simple Course Grid -->
        <div class="row g-4">
            @foreach ($allCourses as $course)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="course-card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: all 0.3s ease; height: 100%;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)';">
                        <!-- Course Image -->
                        <div class="course-image" style="position: relative; overflow: hidden;">
                            <a href="{{ route('course.show', $course->slug) }}">
                                <img src="{{ asset($course->thumbnail) }}" 
                                     alt="{{ $course->title }}" 
                                     style="width: 100%; height: 200px; object-fit: cover; transition: transform 0.3s ease;" 
                                     onmouseover="this.style.transform='scale(1.05)';" 
                                     onmouseout="this.style.transform='scale(1)';">
                            </a>
                            
                            <!-- Category Badge -->
                            <div class="category-badge" style="position: absolute; top: 15px; left: 15px; background: #007bff; color: white; padding: 5px 12px; border-radius: 12px; font-size: 0.8rem; font-weight: 600;">
                                {{ $course->category?->name }}
                            </div>
                            
                            <!-- Rating -->
                            @if($course->avg_rating > 0)
                            <div class="rating-badge" style="position: absolute; top: 15px; right: 15px; background: rgba(255,255,255,0.9); padding: 5px 10px; border-radius: 12px; display: flex; align-items: center;">
                                <i class="fas fa-star" style="color: #ffc107; font-size: 12px; margin-right: 4px;"></i>
                                <span style="font-size: 0.8rem; font-weight: 600; color: #333;">{{ number_format($course->avg_rating, 1) }}</span>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Course Content -->
                        <div class="course-content" style="padding: 20px;">
                            <h3 class="course-title" style="font-size: 1.1rem; font-weight: 700; color: #2c3e50; line-height: 1.4; margin-bottom: 10px; min-height: 50px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                <a href="{{ route('course.show', $course->slug) }}" style="color: inherit; text-decoration: none;">
                                    {{ $course->title }}
                                </a>
                            </h3>
                            
                            <!-- Course Description -->
                            <p class="course-description" style="color: #6c757d; font-size: 0.9rem; line-height: 1.5; margin-bottom: 15px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $course->short_description ?? Str::limit(strip_tags($course->description), 80) }}
                            </p>
                            
                            <!-- Instructor -->
                            @if($course->instructor && $course->instructor->id && $course->instructor->name)
                            <p class="course-instructor" style="color: #6c757d; font-size: 0.85rem; margin-bottom: 20px; display: flex; align-items: center;">
                                <i class="fas fa-user" style="margin-right: 6px; opacity: 0.7;"></i>
                                {{ __('By') }} 
                                <a href="{{ route('instructor-details', ['id' => $course->instructor->id, 'slug' => \Illuminate\Support\Str::slug($course->instructor->name)]) }}" 
                                   style="color: #007bff; text-decoration: none; margin-left: 4px; font-weight: 600;">
                                    {{ $course->instructor->name }}
                                </a>
                            </p>
                            @endif
                            
                            <!-- Action Button -->
                            <div class="course-action text-center">
                                @if (in_array($course->id, session('enrollments') ?? []))
                                    <a href="{{ route('student.enrolled-courses') }}" 
                                       class="btn btn-success" 
                                       style="border-radius: 25px; padding: 10px 25px; font-weight: 600; width: 100%;">
                                        <i class="fas fa-check-circle me-2"></i>{{ __('Enrolled') }}
                                    </a>
                                @elseif ($course->enrollments_count >= $course->capacity && $course->capacity != null)
                                    <a href="javascript:;" 
                                       class="btn btn-secondary" 
                                       style="border-radius: 25px; padding: 10px 25px; font-weight: 600; width: 100%; cursor: not-allowed;">
                                        {{ __('Booked') }}
                                    </a>
                                @else
                                    <a href="javascript:;" 
                                       class="btn btn-primary start-learning-btn home-start-learning-btn" 
                                       data-id="{{ $course->id }}"
                                       style="border-radius: 25px; padding: 12px 28px; font-weight: 600; width: 100%; background: linear-gradient(135deg, #1e40af, #3b82f6); border: none; box-shadow: 0 4px 15px rgba(30, 64, 175, 0.3); transition: all 0.3s ease; position: relative; overflow: hidden;">
                                        <span style="position: relative; z-index: 2; color: white;"><i class="fas fa-play me-2"></i>{{ __('Start Learning') }}</span>
                                        <div class="btn-overlay" style="position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(135deg, #fbbf24, #f59e0b); transition: left 0.3s ease; z-index: 1;"></div>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- View All Button -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="{{ route('courses') }}" 
                   class="btn btn-primary btn-lg professional-view-all-btn" 
                   style="border-radius: 12px; padding: 18px 45px; font-weight: 700; background: linear-gradient(135deg, #4F46E5, #7C3AED); border: none; box-shadow: 0 8px 25px rgba(79, 70, 229, 0.25); font-size: 1.1rem; letter-spacing: 0.5px; text-transform: uppercase; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); position: relative; overflow: hidden;">
                    <span style="position: relative; z-index: 2;">{{ __('View All Training Programs') }}</span>
                    <i class="fas fa-arrow-right ms-3" style="transition: transform 0.3s ease; position: relative; z-index: 2;"></i>
                    <div style="position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(135deg, #6366F1, #8B5CF6); transition: left 0.4s ease; z-index: 1;"></div>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.modern-course-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(0, 123, 255, 0.15);
}

.modern-course-card:hover .course-image-link img {
    transform: scale(1.05);
}

.modern-wishlist-btn:hover {
    background: rgba(0, 123, 255, 0.1);
    transform: scale(1.1);
}

.modern-course-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 123, 255, 0.3);
}

.modern-view-all-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(0, 123, 255, 0.4);
}

.modern-view-all-btn:hover svg {
    transform: translateX(5px);
}

.professional-view-all-btn:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 15px 40px rgba(79, 70, 229, 0.4);
}

.professional-view-all-btn:hover i {
    transform: translateX(8px);
}

.professional-view-all-btn:hover div {
    left: 0;
}

.professional-view-all-btn:active {
    transform: translateY(-2px) scale(0.98);
}

.modern-nav-link:not(.active):hover {
    background: rgba(0, 123, 255, 0.1) !important;
    color: #007bff !important;
}

.modern-nav-link.active {
    background: linear-gradient(135deg, #007bff, #0056b3) !important;
    color: white !important;
}

@media (max-width: 768px) {
    .modern-section-title {
        font-size: 2.2rem !important;
    }
    
    .modern-nav-pills {
        flex-direction: column !important;
        gap: 10px;
    }
    
    .modern-nav-link {
        margin: 5px 0 !important;
        text-align: center;
    }
    
    .course-footer {
        flex-direction: column !important;
        gap: 15px;
        align-items: stretch !important;
    }
    
    .modern-course-btn {
        text-align: center;
        justify-content: center !important;
    }
}
</style>
