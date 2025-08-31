@forelse ($courses as $course)
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-4">
        <div class="courses__item shine__animate-item modern-course-card" style="background: linear-gradient(145deg, #ffffff, #f8fafc); border-radius: 20px; overflow: hidden; box-shadow: 0 8px 32px rgba(0,0,0,0.06); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); border: 1px solid rgba(71, 135, 237, 0.08); height: auto; display: flex; flex-direction: column; position: relative;" onmouseover="this.style.transform='translateY(-12px) scale(1.02)'; this.style.boxShadow='0 20px 60px rgba(71, 135, 237, 0.15)';" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 8px 32px rgba(0,0,0,0.06)';">
            
            <div class="courses__item-thumb" style="position: relative; overflow: hidden; border-radius: 20px 20px 0 0;">
                <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(71, 135, 237, 0.1), rgba(71, 135, 237, 0.05)); z-index: 1;"></div>
                <img src="{{ asset($course->thumbnail) }}" alt="{{ $course->title }}" style="width: 100%; height: 220px; object-fit: cover; transition: all 0.4s ease; filter: brightness(1.05) contrast(1.1);" onmouseover="this.style.transform='scale(1.08)'; this.style.filter='brightness(1.1) contrast(1.15)';" onmouseout="this.style.transform='scale(1)'; this.style.filter='brightness(1.05) contrast(1.1)';">
            </div>
            
            <div class="courses__item-content" style="padding: 28px 24px 24px; display: flex; flex-direction: column; flex-grow: 1; background: linear-gradient(180deg, rgba(255,255,255,0.95), rgba(248,250,252,0.95));">
                
                <h5 class="course-title" style="font-size: 1.3rem; font-weight: 400; color: #2d3748; margin-bottom: 24px; line-height: 1.5; text-align: center; letter-spacing: 0.3px;">
                    {{ $course->title }}
                </h5>
                
                <div class="courses__item-bottom">
                    @if (in_array($course->id, session('enrollments') ?? []))
                        <div class="button" style="width: 100%;">
                            <a href="{{ route('student.enrolled-courses') }}" class="already-enrolled-btn" style="width: 100%; background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 14px 20px; border-radius: 12px; text-decoration: none; font-weight: 600; font-size: 16px; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.3s ease; border: none; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(16, 185, 129, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(16, 185, 129, 0.3)';">
                                <i class="fas fa-check-circle" style="font-size: 18px;"></i>
                                <span class="text">{{ __('Continue Learning') }}</span>
                            </a>
                        </div>
                    @else
                        <div class="button" style="width: 100%;">
                            <a href="javascript:;" class="start-learning-btn professional-start-btn" data-id="{{ $course->id }}" style="width: 100%; background: linear-gradient(135deg, #0066cc, #004499); color: white; padding: 14px 20px; border-radius: 12px; text-decoration: none; font-weight: 600; font-size: 16px; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.3s ease; border: none; box-shadow: 0 4px 15px rgba(0, 102, 204, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0, 102, 204, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0, 102, 204, 0.3)';">
                                <i class="fas fa-play-circle" style="font-size: 18px;"></i>
                                <span class="text">{{ __('Enroll') }}</span>
                            </a>
                        </div>
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
        <a href="{{ route('courses') }}" style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #0066cc, #004499); color: white; padding: 12px 24px; border-radius: 12px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0, 102, 204, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0, 102, 204, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0, 102, 204, 0.3)';">
            <i class="fas fa-arrow-left"></i>
            <span>{{ __('Browse All Courses') }}</span>
        </a>
    </div>
@endforelse

<style>
@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-10px) rotate(5deg); }
}

.already-enrolled-btn:hover div,
.professional-start-btn:hover div {
    left: 100% !important;
}

.modern-course-card:hover .courses__item-thumb img {
    transform: scale(1.1) !important;
    filter: brightness(1.1) !important;
}

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
</style>
