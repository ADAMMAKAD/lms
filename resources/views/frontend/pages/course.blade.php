@extends('frontend.layouts.master')
@section('meta_title', $seo_setting['course_page']['seo_title'])
@section('meta_description', $seo_setting['course_page']['seo_description'])

@push('styles')
<style>
/* Modern Courses Page Styling */
.courses-hero-section {
    background: linear-gradient(135deg, #0066cc 0%, #004499 50%, #002266 100%);
    position: relative;
    padding: 80px 0 60px;
    overflow: hidden;
}

.courses-hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.3;
}

.courses-hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: white;
}

.courses-hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    background: linear-gradient(45deg, #ffffff, #ffd700);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.courses-hero-subtitle {
    font-size: 1.25rem;
    color: rgba(255,255,255,0.9);
    margin-bottom: 2rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.courses-stats {
    display: flex;
    justify-content: center;
    gap: 3rem;
    margin-top: 2rem;
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #ffd700;
    display: block;
}

.stat-label {
    font-size: 0.9rem;
    color: rgba(255,255,255,0.8);
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Modern Sidebar Styling */
.courses__sidebar {
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    padding: 0;
    overflow: hidden;
    border: 1px solid rgba(0,102,204,0.1);
}

.courses-widget {
    padding: 28px;
    border-bottom: 1px solid rgba(0,102,204,0.1);
}

.courses-widget:last-child {
    border-bottom: none;
}

.widget-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #0066cc;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid #ffd700;
    display: inline-block;
}

.form-check {
    margin-bottom: 16px;
    padding: 12px 16px;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.form-check:hover {
    background: rgba(0,102,204,0.05);
    transform: translateX(4px);
}

.form-check-input {
    margin-right: 16px;
    accent-color: #0066cc;
    width: 18px;
    height: 18px;
    border: 2px solid #ddd;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.form-check-input:checked {
    background-color: #0066cc;
    border-color: #0066cc;
}

.form-check-input:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
    border-color: #0066cc;
}

.form-check-label {
    color: #333;
    font-weight: 500;
    cursor: pointer;
    transition: color 0.3s ease;
    white-space: nowrap;
    font-size: 15px;
    line-height: 1.4;
}

.form-check:hover .form-check-label {
    color: #0066cc;
}

/* Main Content Area */
.courses-main-content {
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    padding: 36px;
    margin-bottom: 2rem;
}

.courses-top-wrap {
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #f0f0f0;
}

.courses-top-left p {
    font-size: 16px;
    font-weight: 500;
    color: #666;
    margin: 0;
}

.course-count {
    font-weight: 700;
    color: #0066cc;
}

.courses-top-right {
    display: flex;
    align-items: center;
    gap: 12px;
}

.sort-by {
    font-weight: 500;
    color: #666;
    font-size: 15px;
}

.courses-top-right-select select {
    padding: 8px 16px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    background: white;
    font-size: 14px;
    font-weight: 500;
    color: #333;
    transition: all 0.3s ease;
}

.courses-top-right-select select:focus {
    outline: none;
    border-color: #0066cc;
    box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
}

/* Container Spacing */
.all-courses-area .container {
    background: rgba(248, 250, 252, 0.5);
    border-radius: 20px;
    padding: 40px;
    margin-top: 2rem;
    margin-bottom: 2rem;
}

.course-holder {
    gap: 20px;
}

.course-holder .col-xl-4 {
    margin-bottom: 20px;
}

.courses-top-wrap {
    background: linear-gradient(135deg, #f8faff 0%, #e8f2ff 100%);
    padding: 24px;
    border-radius: 12px;
    margin-bottom: 32px;
    border: 1px solid rgba(0,102,204,0.1);
}

.courses-top-left p {
    font-size: 1.1rem;
    font-weight: 600;
    color: #0066cc;
    margin: 0;
}

.course-count {
    color: #ffd700;
    font-weight: 700;
}

.sort-by {
    color: #666;
    font-weight: 500;
    margin-right: 12px;
}

.orderby {
    border: 2px solid rgba(0,102,204,0.2);
    border-radius: 8px;
    padding: 8px 16px;
    background: white;
    color: #333;
    font-weight: 500;
    transition: all 0.3s ease;
}

.orderby:focus {
    border-color: #0066cc;
    box-shadow: 0 0 0 3px rgba(0,102,204,0.1);
    outline: none;
}

/* Course Grid */
.course-holder {
    gap: 12px;
    margin-bottom: 2rem;
}

.course-holder .col-xl-4 {
    margin-bottom: 12px;
    padding-left: 6px;
    padding-right: 6px;
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
}

.course-holder {
    display: flex;
    flex-wrap: wrap;
    margin-left: -6px;
    margin-right: -6px;
}

/* Modern Course Cards */
.modern-course-card {
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.modern-course-card:hover {
    transform: translateY(-8px) !important;
    box-shadow: 0 20px 60px rgba(0,0,0,0.15) !important;
}

/* Enhanced Pagination */
.pagination-wrap {
    margin-top: 4rem;
    display: flex;
    justify-content: center;
}

.pagination {
    background: white;
    border-radius: 16px;
    padding: 1rem;
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
}

.pagination .page-link {
    border: none;
    color: #64748b;
    font-weight: 600;
    padding: 12px 16px;
    margin: 0 4px;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.pagination .page-link:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

/* Animations */
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

.courses__sidebar,
.courses-main-content {
    animation: fadeInUp 0.6s ease-out;
}

.courses__sidebar {
    animation-delay: 0.1s;
}

.courses-main-content {
    animation-delay: 0.2s;
}

/* Responsive Design */
@media (max-width: 768px) {
    .courses-hero-title {
        font-size: 2.5rem;
    }
    
    .courses-stats {
        gap: 1.5rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .courses-main-content {
        padding: 20px;
    }
}

@media (max-width: 576px) {
    .courses-hero-section {
        padding: 60px 0 40px;
    }
    
    .courses-hero-title {
        font-size: 2rem;
    }
    
    .courses-stats {
        flex-direction: column;
        gap: 1rem;
    }
}
</style>
@endpush

@section('contents')
    <!-- breadcrumb-area -->
    <x-frontend.breadcrumb :title="__('Courses')" :subtitle="__('Elevate your learning journey with cutting-edge content')" :links="[['url' => route('home'), 'text' => __('Home')], ['url' => '', 'text' => __('Courses')]]" />
    <!-- breadcrumb-area-end -->

    <!-- Modern Hero Section -->
    <section class="courses-hero-section">
        <div class="container" style="max-width: 1400px; margin: 0 auto; padding: 0 40px;">
            <div class="courses-hero-content">
                <h1 class="courses-hero-title">{{ __('Discover Your Next Skill') }}</h1>
                <p class="courses-hero-subtitle">{{ __('Explore our comprehensive collection of professional courses designed to accelerate your career growth and unlock new opportunities.') }}</p>
                <div class="courses-stats">
                    <div class="stat-item">
                        <span class="stat-number">500+</span>
                        <span class="stat-label">{{ __('Courses') }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">50+</span>
                        <span class="stat-label">{{ __('Instructors') }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">10K+</span>
                        <span class="stat-label">{{ __('Students') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- all-courses -->
    <section class="all-courses-area section-py-120">
        <div class="container position-relative" style="max-width: 1400px; margin: 0 auto; padding: 0 40px;">
            {{-- <div class="preloader-two d-none">
                <div class="loader-icon-two"><img src="{{ asset(Cache::get('setting')->preloader) }}" alt="Preloader"></div>
            </div> --}} {{-- Removed preloader functionality --}}
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="courses__sidebar_area">
                        <div class="courses__sidebar_button d-lg-none">
                            <h4>{{ __('filter') }}</h4>
                        </div>
                        <aside class="courses__sidebar">
                            <div class="courses-widget">
                                <h4 class="widget-title">{{ __('Categories') }}</h4>
                                <div class="courses-cat-list">
                                    <ul class="list-wrap">
                                        @foreach ($categories->sortBy('translation.name') as $category)
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input main-category-checkbox" type="checkbox"
                                                        name="main_categories[]" value="{{ $category->slug }}"
                                                        id="cat_{{ $category->id }}">
                                                    <label class="form-check-label"
                                                        for="cat_{{ $category->id }}">{{ $category->translation->name }}</label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="show-more">
                                    </div>
                                </div>
                            </div>

                            <div class="sub-category-holder "></div>
                            <div class="courses-widget">
                                <h4 class="widget-title">{{ __('Language') }}</h4>
                                <div class="courses-cat-list">
                                    <ul class="list-wrap">

                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input language-checkbox" type="checkbox"
                                                    value="" id="lang">
                                                <label class="form-check-label"
                                                    for="lang">{{ __('All Language') }}</label>
                                            </div>
                                        </li>
                                        @foreach ($languages as $language)
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input language-checkbox" type="checkbox"
                                                        value="{{ $language->id }}" id="lang_{{ $language->id }}">
                                                    <label class="form-check-label"
                                                        for="lang_{{ $language->id }}">{{ $language->name }}</label>
                                                </div>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                                <div class="show-more">
                                </div>
                            </div>
                            
                            <div class="courses-widget">
                                <h4 class="widget-title">{{ __('Skill level') }}</h4>
                                <div class="courses-cat-list">
                                    <ul class="list-wrap">
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input level-checkbox" type="checkbox"
                                                    value="" id="difficulty_1">
                                                <label class="form-check-label"
                                                    for="difficulty_1">{{ __('All Levels') }}</label>
                                            </div>
                                        </li>
                                        @foreach ($levels as $level)
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input level-checkbox" type="checkbox"
                                                        value="{{ $level->id }}" id="difficulty_{{ $level->id }}">
                                                    <label class="form-check-label"
                                                        for="difficulty_{{ $level->id }}">{{ $level->translation->name }}</label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="courses-main-content">
                        <div class="courses-top-wrap">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <div class="courses-top-left">
                                        <p>{{ __('Total') }} <span class="course-count">{{ $initialCourses->total() }}</span> {{ __('courses found') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="d-flex justify-content-center align-items-center flex-wrap">
                                        <div class="courses-top-right m-0 ms-md-auto">
                                            <span class="sort-by">{{ __('Sort By') }}:</span>
                                            <div class="courses-top-right-select">
                                                <select name="orderby" class="orderby">
                                                    <option value="desc">{{ __('Latest to Oldest') }}</option>
                                                    <option value="asc">{{ __('Oldest to Latest') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="grid" role="tabpanel"
                            aria-labelledby="grid-tab">
                            <div class="course-holder row">
                                @include('frontend.partials.course-card', ['courses' => $initialCourses])
                            </div>

                            <div class="pagination-wrap">
                                <div class="pagination">
                                    {{ $initialCourses->links() }}
                                </div>
                            </div>

                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- all-courses-end -->
@endsection

@push('scripts')
    <script src="{{ asset('frontend/js/default/course-page.js') }}"></script>
@endpush
