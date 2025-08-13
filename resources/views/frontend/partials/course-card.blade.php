@forelse ($courses as $course)
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-2">
        <div class="courses__item shine__animate-item modern-course-card" style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.06); transition: all 0.3s ease; border: 1px solid rgba(0,0,0,0.05); height: 100%; display: flex; flex-direction: column;" onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.12)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 12px rgba(0,0,0,0.06)';">
            <div class="courses__item-thumb" style="position: relative; overflow: hidden;">
                <a href="{{ route('course.show', $course->slug) }}" class="shine__animate-link">
                    <img src="{{ asset($course->thumbnail) }}" alt="{{ $course->title }}" style="width: 100%; height: 160px; object-fit: cover; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.05)';" onmouseout="this.style.transform='scale(1)';">
                </a>
                <a href="javascript:;" class="wsus-wishlist-btn common-white courses__wishlist-two"
                    data-slug="{{ $course?->slug }}" aria-label="WishList" style="position: absolute; top: 8px; right: 8px; width: 28px; height: 28px; border-radius: 50%; background: rgba(255,255,255,0.9); backdrop-filter: blur(8px); border: none; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; box-shadow: 0 1px 4px rgba(0,0,0,0.1);" onmouseover="this.style.background='rgba(255,255,255,1)'; this.style.transform='scale(1.05)';" onmouseout="this.style.background='rgba(255,255,255,0.9)'; this.style.transform='scale(1)';">
                    <i class="{{ $course?->favorite_by_client ? 'fas' : 'far' }} fa-heart" style="color: #ff4757; font-size: 12px;"></i>
                </a>
            </div>
            <div class="courses__item-content" style="padding: 16px; display: flex; flex-direction: column; flex-grow: 1;">
                <div class="course-meta-top" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                    <span class="course-category" style="background: linear-gradient(135deg, #e0f2fe, #b3e5fc); color: #0277bd; padding: 4px 10px; border-radius: 6px; font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                        <a href="{{ route('courses', ['category' => $course->category->id]) }}" style="color: #0277bd; text-decoration: none;">{{ $course->category->translation->name }}</a>
                    </span>
                    <div class="course-rating" style="display: flex; align-items: center; gap: 3px; color: #f59e0b; font-size: 0.8rem; font-weight: 600;">
                        <i class="fas fa-star" style="color: #f59e0b; font-size: 11px;"></i>
                        <span style="color: #374151;">{{ number_format($course->reviews()->avg('rating'), 1) ?? 0 }}</span>
                    </div>
                </div>
                <h5 class="course-title" style="font-size: 1.1rem; font-weight: 700; color: #1f2937; margin-bottom: 8px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"><a href="{{ route('course.show', $course->slug) }}" style="color: #1f2937; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='#3b82f6';" onmouseout="this.style.color='#1f2937';">{{ truncate($course->title, 45) }}</a></h5>
                <p style="color: #6b7280; font-size: 0.8rem; line-height: 1.4; margin-bottom: 10px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ truncate($course->short_description ?? $course->description, 70) }}</p>
                @if($course->instructor && $course->instructor->id && $course->instructor->name)
                <div class="course-instructor" style="display: flex; align-items: center; gap: 6px; margin-bottom: 12px; padding-top: 8px; border-top: 1px solid #e5e7eb;">
                    <img src="{{ asset($course->instructor->image) }}" alt="{{ $course->instructor->name }}" style="width: 24px; height: 24px; border-radius: 50%; object-fit: cover; border: 2px solid #e5e7eb;">
                    <span style="color: #6b7280; font-size: 0.75rem;">{{ __('By') }} <a href="{{ route('instructor-details', ['id' => $course->instructor->id, 'slug' => \Illuminate\Support\Str::slug($course->instructor->name)]) }}" style="color: #3b82f6; text-decoration: none; font-weight: 600;">{{ $course->instructor->name }}</a></span>
                </div>
                @endif
                <div class="courses__item-bottom" style="margin-top: auto; padding-top: 8px;">
                    @if (in_array($course->id, session('enrollments') ?? []))
                        <div class="button" style="width: 100%;">
                            <a href="{{ route('student.enrolled-courses') }}" class="already-enrolled-btn" style="width: 100%; background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.8rem; display: flex; align-items: center; justify-content: center; gap: 6px; transition: all 0.3s ease; border: none; box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(16, 185, 129, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(16, 185, 129, 0.3)';">
                                <i class="fas fa-check-circle" style="font-size: 14px;"></i>
                                <span class="text">{{ __('Enrolled') }}</span>
                            </a>
                        </div>
                    @else
                        <div class="button" style="width: 100%;">
                            <a href="javascript:;" class="start-learning-btn professional-start-btn" data-id="{{ $course->id }}" style="width: 100%; background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.8rem; display: flex; align-items: center; justify-content: center; gap: 6px; transition: all 0.3s ease; border: none; box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(59, 130, 246, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(59, 130, 246, 0.3)';">
                                <i class="fas fa-play-circle" style="font-size: 14px;"></i>
                                <span class="text">{{ __('Start Learning') }}</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="w-100">
        <h6 class="text-center">{{ __('No Course Found!') }}</h6>
    </div>
@endforelse
