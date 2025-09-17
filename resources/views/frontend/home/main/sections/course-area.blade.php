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

<section class="py-5" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); position: relative; padding: 5rem 0;">
    <!-- Background Pattern -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.03; background-image: radial-gradient(circle at 25% 25%, #0066CC 0%, transparent 50%), radial-gradient(circle at 75% 75%, #004499 0%, transparent 50%); z-index: 1;"></div>
    
    <div class="container" style="position: relative; z-index: 2;">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <div style="display: inline-block; background: linear-gradient(135deg, #0066CC, #004499); color: white; padding: 0.5rem 1.5rem; border-radius: 25px; font-size: 0.9rem; font-weight: 600; margin-bottom: 1.5rem; box-shadow: 0 4px 15px rgba(0, 102, 204, 0.3);">
                    🎓 UNDP Learning Excellence
                </div>
                <h2 style="font-size: 3rem; font-weight: 800; color: #1e293b; margin-bottom: 1.5rem; line-height: 1.1;">Featured Training Programs</h2>
                <p style="font-size: 1.2rem; color: #475569; max-width: 700px; margin: 0 auto; line-height: 1.6;">Discover our comprehensive collection of expert-led courses designed to advance your career and contribute to sustainable development goals</p>
            </div>
        </div>
        <!-- Simple Course Grid -->
        <div class="row g-4">
            @foreach ($allCourses as $course)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="modern-course-card" style="background: linear-gradient(145deg, #ffffff, #f8fafc); border-radius: 20px; overflow: hidden; box-shadow: 0 8px 32px rgba(0,0,0,0.06); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); height: 100%; border: 1px solid rgba(71, 135, 237, 0.08); position: relative;" onmouseover="this.style.transform='translateY(-12px) scale(1.02)'; this.style.boxShadow='0 20px 60px rgba(71, 135, 237, 0.15)';" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 8px 32px rgba(0,0,0,0.06)';">
                        
                        <div style="position: relative; overflow: hidden; border-radius: 20px 20px 0 0;">
                            <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(71, 135, 237, 0.1), rgba(71, 135, 237, 0.05)); z-index: 1;"></div>
                            <img src="{{ asset($course->thumbnail) }}" 
                                 alt="{{ $course->title }}" 
                                 style="width: 100%; height: 220px; object-fit: cover; transition: all 0.4s ease; filter: brightness(1.05) contrast(1.1);" 
                                 onmouseover="this.style.transform='scale(1.08)'; this.style.filter='brightness(1.1) contrast(1.15)';" 
                                 onmouseout="this.style.transform='scale(1)'; this.style.filter='brightness(1.05) contrast(1.1)';">
                        </div>
                        
                        
                        <div style="padding: 28px 24px 24px; display: flex; flex-direction: column; flex-grow: 1; background: linear-gradient(180deg, rgba(255,255,255,0.95), rgba(248,250,252,0.95));">
                            <h5 style="font-size: 1.3rem; font-weight: 400; color: #2d3748; margin-bottom: 24px; line-height: 1.5; text-align: center; letter-spacing: 0.3px;">
                                {{ $course->title }}
                            </h5>
                            
                            @if (in_array($course->id, session('enrollments') ?? []))
                                <a href="{{ route('student.enrolled-courses') }}" 
                                   class="modern-course-btn" 
                                   style="display: flex; align-items: center; justify-content: center; width: 100%; background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 14px 20px; border-radius: 12px; text-decoration: none; font-weight: 600; font-size: 16px; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3); gap: 8px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(16, 185, 129, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(16, 185, 129, 0.3)';">
                                    <i class="fas fa-check-circle" style="font-size: 18px;"></i>
                                    {{ __('Continue Learning') }}
                                </a>
                            @elseif ($course->enrollments_count >= $course->capacity && $course->capacity != null)
                                <a href="javascript:;" 
                                   class="modern-course-btn" 
                                   style="display: flex; align-items: center; justify-content: center; width: 100%; background: #6c757d; color: white; padding: 14px 20px; border-radius: 12px; text-decoration: none; font-weight: 600; font-size: 16px; cursor: not-allowed; gap: 8px;">
                                    {{ __('Booked') }}
                                </a>
                            @else
                                <a href="javascript:;" 
                                   class="modern-course-btn start-learning-btn home-start-learning-btn" 
                                   data-id="{{ $course->id }}"
                                   style="display: flex; align-items: center; justify-content: center; width: 100%; background: linear-gradient(135deg, #0066cc, #004499); color: white; padding: 14px 20px; border-radius: 12px; text-decoration: none; font-weight: 600; font-size: 16px; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0, 102, 204, 0.3); gap: 8px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0, 102, 204, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0, 102, 204, 0.3)';">
                                    <i class="fas fa-play-circle" style="font-size: 18px;"></i>
                                    {{ __('Enroll') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- View All Button -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="{{ route('courses') }}" 
                   class="btn btn-primary professional-view-all-btn" 
                   style="border-radius: 10px; padding: 10px 22px; font-weight: 700; background: linear-gradient(135deg, #0d6efd, #0a58ca); border: none; box-shadow: 0 6px 18px rgba(13, 110, 253, 0.25); font-size: 0.95rem; letter-spacing: 0.5px; text-transform: uppercase; transition: all 0.3s ease; position: relative; overflow: hidden;">
                    <span style="position: relative; z-index: 2;">{{ __('View All Training Programs') }}</span>
                    <i class="fas fa-arrow-right ms-3" style="transition: transform 0.3s ease; position: relative; z-index: 2;"></i>
                    <div style="position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(135deg, #3d8bfd, #0d6efd); transition: left 0.4s ease; z-index: 1;"></div>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
/* Enhanced Modern Course Card Styles */
.modern-course-card {
    position: relative;
    overflow: hidden;
}

.modern-course-card:hover {
    transform: translateY(-12px) scale(1.02);
    box-shadow: 0 25px 60px rgba(0, 102, 204, 0.2);
}

.modern-course-card:hover .course-image-link img {
    transform: scale(1.08);
}

.modern-course-card:hover > div:first-child {
    opacity: 1;
}

.modern-course-btn {
    position: relative;
    overflow: hidden;
}

.modern-course-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.modern-course-btn:hover::before {
    left: 100%;
}

.modern-course-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(0, 102, 204, 0.5);
}

.modern-wishlist-btn:hover {
    background: rgba(0, 123, 255, 0.1);
    transform: scale(1.1);
}

.modern-view-all-btn:hover {
    transform: translateY(-4px);
    box-shadow: 0 15px 35px rgba(0, 102, 204, 0.4);
}

.modern-view-all-btn:hover svg {
    transform: translateX(5px);
}

.professional-view-all-btn:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 15px 40px rgba(13, 110, 253, 0.4);
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

/* Shimmer Animation */
@keyframes shimmer {
    0% { left: -100%; }
    100% { left: 100%; }
}

/* Pulse Animation for Stats */
@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.modern-course-card:hover .fas.fa-users {
    animation: pulse 1s infinite;
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
    
    .modern-course-card {
        margin-bottom: 2rem;
    }
    
    .modern-course-card:hover {
        transform: translateY(-8px);
    }
}
</style>
