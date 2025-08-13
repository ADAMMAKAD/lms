<section class="categories-area py-5" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">
                <div class="section__title text-center mb-5">
                    <span class="sub-title d-inline-block px-4 py-2 mb-4 fw-semibold" style="background: linear-gradient(135deg, #8B5CF6, #A855F7); color: white; border-radius: 25px; font-size: 0.9rem; letter-spacing: 0.5px;">{{ __("Course Categories") }}</span>
                    <h2 class="title fw-bold text-dark mb-4" style="font-size: 3rem; line-height: 1.2; font-family: 'Inter', sans-serif;">{{ __('Top Categories') }}</h2>
                    <p class="lead text-muted mx-auto" style="max-width: 650px; line-height: 1.7; font-size: 1.1rem;">{{ __('Organize courses by subject areas, helping learners quickly find content relevant to their interests or needs.') }}</p>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-4">
            @foreach ($trendingCategories->take(8) as $index => $category)
                @php
                    $exactCourseCount = $category->courses()->count();
                    $colorClasses = ['purple', 'cyan', 'amber', 'red', 'emerald'];
                    $colorClass = $colorClasses[$index % count($colorClasses)];
                @endphp
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="category-card category-{{ $colorClass }} h-100 bg-white rounded-4 p-4 border-0 position-relative overflow-hidden" 
                         style="transition: all 0.4s ease; cursor: pointer;">
                        <a href="{{ route('courses', ['main_category' => $category->slug]) }}" style="text-decoration: none; color: inherit; display: block; height: 100%;">
                            <div class="d-flex align-items-center mb-3">
                                <div class="category-icon d-flex align-items-center justify-content-center" 
                                     style="width: 60px; height: 60px; border-radius: 16px; margin-right: 1rem;">
                                    <img src="{{ asset($category?->icon) }}" alt="{{ $category?->translation?->name }}" style="width: 28px; height: 28px; filter: brightness(0) invert(1);">
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="category-title fw-bold text-dark mb-1 lh-base" style="font-size: 1.2rem; font-family: 'Inter', sans-serif;">{{ $category?->translation?->name }}</h5>
                                    <div class="d-flex align-items-center">
                                        <span class="course-count fw-semibold" style="font-size: 0.95rem;">{{ $exactCourseCount }}</span>
                                        <span class="text-muted ms-1" style="font-size: 0.9rem;">{{ __('courses') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="category-description">
                                <p class="text-muted mb-0" style="line-height: 1.6; font-size: 0.9rem;">{{ __('Explore comprehensive courses in this category') }}</p>
                            </div>
                        </a>
                        <div class="position-absolute top-0 end-0 p-3">
                            <div class="category-accent" style="width: 30px; height: 30px; border-radius: 50%; opacity: 0.1;"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
.category-purple {
    box-shadow: 0 8px 30px rgba(139, 92, 246, 0.1);
}
.category-purple:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(139, 92, 246, 0.15);
}
.category-purple .category-icon {
    background: linear-gradient(135deg, #8B5CF6, #A855F7);
    box-shadow: 0 8px 25px rgba(139, 92, 246, 0.2);
}
.category-purple .course-count {
    color: #8B5CF6;
}
.category-purple .category-accent {
    background: #8B5CF6;
}

.category-cyan {
    box-shadow: 0 8px 30px rgba(6, 182, 212, 0.1);
}
.category-cyan:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(6, 182, 212, 0.15);
}
.category-cyan .category-icon {
    background: linear-gradient(135deg, #06B6D4, #0891B2);
    box-shadow: 0 8px 25px rgba(6, 182, 212, 0.2);
}
.category-cyan .course-count {
    color: #06B6D4;
}
.category-cyan .category-accent {
    background: #06B6D4;
}

.category-amber {
    box-shadow: 0 8px 30px rgba(245, 158, 11, 0.1);
}
.category-amber:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(245, 158, 11, 0.15);
}
.category-amber .category-icon {
    background: linear-gradient(135deg, #F59E0B, #D97706);
    box-shadow: 0 8px 25px rgba(245, 158, 11, 0.2);
}
.category-amber .course-count {
    color: #F59E0B;
}
.category-amber .category-accent {
    background: #F59E0B;
}

.category-red {
    box-shadow: 0 8px 30px rgba(239, 68, 68, 0.1);
}
.category-red:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(239, 68, 68, 0.15);
}
.category-red .category-icon {
    background: linear-gradient(135deg, #EF4444, #DC2626);
    box-shadow: 0 8px 25px rgba(239, 68, 68, 0.2);
}
.category-red .course-count {
    color: #EF4444;
}
.category-red .category-accent {
    background: #EF4444;
}

.category-emerald {
    box-shadow: 0 8px 30px rgba(16, 185, 129, 0.1);
}
.category-emerald:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(16, 185, 129, 0.15);
}
.category-emerald .category-icon {
    background: linear-gradient(135deg, #10B981, #059669);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.2);
}
.category-emerald .course-count {
    color: #10B981;
}
.category-emerald .category-accent {
    background: #10B981;
}
</style>
