@extends('frontend.layouts.master')
@section('meta_title', $seo_setting['course_page']['seo_title'])
@section('meta_description', $seo_setting['course_page']['seo_description'])

@push('styles')
<style>
/* Coursera-Inspired Modern Design */
:root {
    --primary-blue: #0056d3;
    --primary-dark: #003d96;
    --secondary-blue: #1e40af;
    --accent-gold: #ffd700;
    --text-primary: #1f2937;
    --text-secondary: #6b7280;
    --text-light: #9ca3af;
    --bg-light: #f8fafc;
    --bg-white: #ffffff;
    --border-light: #e5e7eb;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}

/* Global Styles */
body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    line-height: 1.6;
    color: var(--text-primary);
}

/* Hero Section - Coursera Style */
.coursera-hero {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-dark) 100%);
    position: relative;
    padding: 120px 0 80px;
    overflow: hidden;
}

.coursera-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
    opacity: 0.4;
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: white;
    max-width: 800px;
    margin: 0 auto;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    line-height: 1.2;
    background: linear-gradient(45deg, #ffffff, var(--accent-gold));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-subtitle {
    font-size: 1.25rem;
    color: rgba(255,255,255,0.9);
    margin-bottom: 3rem;
    line-height: 1.6;
}

.hero-search {
    max-width: 600px;
    margin: 0 auto 3rem;
    position: relative;
}

.hero-search-input {
    width: 100%;
    padding: 18px 60px 18px 24px;
    border: none;
    border-radius: 50px;
    font-size: 1.1rem;
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(10px);
    box-shadow: var(--shadow-lg);
    transition: all 0.3s ease;
}

.hero-search-input:focus {
    outline: none;
    background: white;
    box-shadow: 0 0 0 4px rgba(255,255,255,0.2);
}

.hero-search-btn {
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    background: var(--primary-blue);
    border: none;
    border-radius: 50%;
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.hero-search-btn:hover {
    background: var(--primary-dark);
    transform: translateY(-50%) scale(1.05);
}

.hero-stats {
    display: flex;
    justify-content: center;
    gap: 4rem;
    margin-top: 3rem;
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--accent-gold);
    display: block;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 0.9rem;
    color: rgba(255,255,255,0.8);
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 500;
}

/* Main Content Area */
.courses-main-area {
    background: var(--bg-light);
    padding: 60px 0;
    min-height: 100vh;
}

.courses-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 24px;
}

/* Filters Section */
.filters-section {
    background: white;
    border-radius: 16px;
    margin-bottom: 32px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
    overflow: hidden;
}

.filters-header {
    padding: 0;
    margin: 0;
}

.filters-toggle {
    width: 100%;
    background: linear-gradient(135deg, var(--primary-blue) 0%, #004bb5 100%);
    color: white;
    border: none;
    padding: 20px 24px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 1.1rem;
}

.filters-toggle:hover {
    background: linear-gradient(135deg, #004bb5 0%, var(--primary-blue) 100%);
    transform: translateY(-1px);
}

.filters-toggle-content {
    display: flex;
    align-items: center;
    gap: 12px;
}

.filters-toggle-text {
    font-size: 1.1rem;
}

.filters-count {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.875rem;
    font-weight: 600;
    min-width: 24px;
    text-align: center;
}

.filters-toggle-arrow {
    transition: transform 0.3s ease;
}

.filters-toggle.active .filters-toggle-arrow {
    transform: rotate(180deg);
}

.filters-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
    padding: 0 24px;
}

.filters-content.active {
    max-height: 1000px;
    padding: 24px;
}

.filters-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 24px;
    align-items: start;
}

.filter-group {
    background: var(--bg-light);
    padding: 20px;
    border-radius: 12px;
    border: 1px solid var(--border-light);
}

.filter-label {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 12px;
    display: block;
    font-size: 0.95rem;
}

.filter-select {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid var(--border-light);
    border-radius: 8px;
    background: white;
    font-size: 0.95rem;
    color: var(--text-primary);
    transition: all 0.3s ease;
}

.filter-select:focus {
    outline: none;
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 3px rgba(0, 86, 211, 0.1);
}

.filter-checkboxes {
    max-height: 200px;
    overflow-y: auto;
}

.filter-checkbox-item {
    display: flex;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.filter-checkbox-item:last-child {
    border-bottom: none;
}

.filter-checkbox {
    margin-right: 12px;
    width: 18px;
    height: 18px;
    accent-color: var(--primary-blue);
}

.filter-checkbox-label {
    font-size: 0.9rem;
    color: var(--text-secondary);
    cursor: pointer;
    flex: 1;
}

/* Results Header */
.results-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
    flex-wrap: wrap;
    gap: 16px;
}

.results-info {
    font-size: 1.1rem;
    color: var(--text-secondary);
}

.results-count {
    font-weight: 600;
    color: var(--primary-blue);
}

.sort-controls {
    display: flex;
    align-items: center;
    gap: 12px;
}

.sort-label {
    font-weight: 500;
    color: var(--text-secondary);
    font-size: 0.95rem;
}

.sort-select {
    padding: 10px 16px;
    border: 2px solid var(--border-light);
    border-radius: 8px;
    background: white;
    font-size: 0.95rem;
    color: var(--text-primary);
    min-width: 180px;
    transition: all 0.3s ease;
}

.sort-select:focus {
    outline: none;
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 3px rgba(0, 86, 211, 0.1);
}

/* Courses Grid */
.courses-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 24px;
    margin-bottom: 48px;
}

/* Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 48px;
}

.pagination {
    display: flex;
    align-items: center;
    gap: 8px;
    background: white;
    padding: 16px 24px;
    border-radius: 12px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
}

.pagination .page-link {
    padding: 10px 16px;
    border: 2px solid transparent;
    border-radius: 8px;
    color: var(--text-secondary);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.pagination .page-link:hover {
    background: var(--bg-light);
    color: var(--primary-blue);
    border-color: var(--border-light);
}

.pagination .page-item.active .page-link {
    background: var(--primary-blue);
    color: white;
    border-color: var(--primary-blue);
}

/* Responsive Design */
@media (max-width: 1200px) {
    .courses-container {
        max-width: 1200px;
        padding: 0 20px;
    }
    
    .hero-stats {
        gap: 2rem;
    }
}

@media (max-width: 992px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-stats {
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .filters-grid {
        grid-template-columns: 1fr;
    }
    
    .filters-toggle {
        display: block;
    }
    
    .filters-content {
        display: none;
    }
    
    .filters-content.show {
        display: block;
        margin-top: 24px;
    }
    
    .results-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .courses-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }
}

@media (max-width: 768px) {
    .coursera-hero {
        padding: 80px 0 60px;
    }
    
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .courses-container {
        padding: 0 16px;
    }
    
    .filters-section {
        padding: 24px;
    }
    
    .courses-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
}

@media (max-width: 576px) {
    .hero-title {
        font-size: 1.75rem;
    }
    
    .hero-search-input {
        padding: 16px 50px 16px 20px;
        font-size: 1rem;
    }
    
    .hero-search-btn {
        width: 40px;
        height: 40px;
        right: 6px;
    }
    
    .filters-section {
        padding: 20px;
    }
    
    .filter-group {
        padding: 16px;
    }
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
    accent-color: #282f76;
    width: 18px;
    height: 18px;
    border: 2px solid #ddd;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.form-check-input:checked {
    background-color: #282f76;
    border-color: #282f76;
}

.form-check-input:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
    border-color: #282f76;
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
    color: #282f76;
}

/* Main Content Area */
.courses-main-content {
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    padding: 32px;
    margin-bottom: 2rem;
    margin-left: 20px;
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
    color: #282f76;
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
    border-color: #282f76;
    box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
}

/* Container Spacing */
.all-courses-area .container {
    background: rgba(248, 250, 252, 0.5);
    border-radius: 20px;
    padding: 30px 20px;
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
    color: #282f76;
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
    border-color: #282f76;
    box-shadow: 0 0 0 3px rgba(0,102,204,0.1);
    outline: none;
}

/* Course Grid */
.course-holder {
    gap: 20px;
    margin-bottom: 2rem;
    display: flex;
    flex-wrap: wrap;
}

.course-holder .col-xl-4,
.course-holder .col-lg-4,
.course-holder .col-md-4 {
    margin-bottom: 20px;
    padding-left: 10px;
    padding-right: 10px;
    flex: 0 0 calc(33.333333% - 20px);
    max-width: calc(33.333333% - 20px);
}

/* Force 3 columns on large screens */
@media (min-width: 992px) {
    .course-holder .col-xl-4,
    .course-holder .col-lg-4 {
        flex: 0 0 calc(33.333333% - 20px);
        max-width: calc(33.333333% - 20px);
    }
}

/* 2 columns on medium screens */
@media (min-width: 768px) and (max-width: 991px) {
    .course-holder .col-md-4 {
        flex: 0 0 calc(50% - 20px);
        max-width: calc(50% - 20px);
    }
}

/* 1 column on small screens */
@media (max-width: 767px) {
    .course-holder .col-md-4 {
        flex: 0 0 100%;
        max-width: 100%;
    }
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
    background: #282f76;
    color: white;
    transform: translateY(-2px);
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #282f76, #282f76);
    color: white;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
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

@media (max-width: 992px) {
    .courses__sidebar {
        margin-right: 0;
        margin-bottom: 20px;
    }
    
    .courses-main-content {
        margin-left: 0;
    }
    
    .all-courses-area .container {
        padding: 20px 15px;
    }
}

@media (max-width: 768px) {
    .all-courses-area .container {
        max-width: 100%;
        padding: 15px 10px;
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
    
    .all-courses-area .container {
        padding: 10px 5px;
    }
    
    .courses-main-content {
        padding: 15px;
    }
}
</style>
@endpush

@section('contents')
    <!-- Modern Coursera-inspired Hero Section -->
    <section class="coursera-hero">
        <div class="courses-container">
            <div class="hero-content">
                <h1 class="hero-title">{{ __('Learn without limits') }}</h1>
                <p class="hero-subtitle">{{ __('Start, switch, or advance your career with more than 5,000 courses, Professional Certificates, and degrees from world-class universities and companies.') }}</p>
                
                <!-- Hero Search Bar -->
                <div class="hero-search">
                    <div class="hero-search-wrapper">
                        <input type="text" class="hero-search-input" placeholder="{{ __('What do you want to learn?') }}" id="hero-search">
                        <button class="hero-search-btn" type="button">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Hero Stats -->
                <div class="hero-stats">
                    <div class="hero-stat">
                        <div class="hero-stat-number">{{ $initialCourses->total() }}+</div>
                        <div class="hero-stat-label">{{ __('Courses') }}</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-number">{{ $categories->count() }}+</div>
                        <div class="hero-stat-label">{{ __('Categories') }}</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-number">{{ $languages->count() }}+</div>
                        <div class="hero-stat-label">{{ __('Languages') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modern Courses Section -->
    <section class="modern-courses-section">
        <div class="courses-container">
            <!-- Filters Section -->
            <div class="filters-section">
                <div class="filters-header">
                    <button class="filters-toggle" type="button" id="filtersToggle">
                        <div class="filters-toggle-content">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 4H21V6H3V4ZM7 10H17V12H7V10ZM10 16H14V18H10V16Z" fill="currentColor"/>
                            </svg>
                            <span class="filters-toggle-text">{{ __('Find the right course for you') }}</span>
                            <span class="filters-count" id="activeFiltersCount" style="display: none;">0</span>
                        </div>
                        <svg class="filters-toggle-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
                
                <div class="filters-content" id="filtersContent">
                    <div class="filters-grid">
                        <!-- Categories Filter -->
                        <div class="filter-group">
                            <h4 class="filter-title">{{ __('Categories') }}</h4>
                            <div class="filter-options">
                                @foreach ($categories->sortBy('translation.name')->take(8) as $category)
                                    <div class="filter-option">
                                        <input class="filter-checkbox main-category-checkbox" type="checkbox"
                                            name="main_categories[]" value="{{ $category->slug }}"
                                            id="cat_{{ $category->id }}">
                                        <label class="filter-label" for="cat_{{ $category->id }}">
                                            {{ $category->translation->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Language Filter -->
                        <div class="filter-group">
                            <h4 class="filter-title">{{ __('Language') }}</h4>
                            <div class="filter-options">
                                <div class="filter-option">
                                    <input class="filter-checkbox language-checkbox" type="checkbox"
                                        value="" id="lang_all">
                                    <label class="filter-label" for="lang_all">{{ __('All Languages') }}</label>
                                </div>
                                @foreach ($languages->take(6) as $language)
                                    <div class="filter-option">
                                        <input class="filter-checkbox language-checkbox" type="checkbox"
                                            value="{{ $language->id }}" id="lang_{{ $language->id }}">
                                        <label class="filter-label" for="lang_{{ $language->id }}">
                                            {{ $language->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Skill Level Filter -->
                        <div class="filter-group">
                            <h4 class="filter-title">{{ __('Skill Level') }}</h4>
                            <div class="filter-options">
                                <div class="filter-option">
                                    <input class="filter-checkbox level-checkbox" type="checkbox"
                                        value="" id="level_all">
                                    <label class="filter-label" for="level_all">{{ __('All Levels') }}</label>
                                </div>
                                @foreach ($levels as $level)
                                    <div class="filter-option">
                                        <input class="filter-checkbox level-checkbox" type="checkbox"
                                            value="{{ $level->id }}" id="level_{{ $level->id }}">
                                        <label class="filter-label" for="level_{{ $level->id }}">
                                            {{ $level->translation->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Results Section -->
            <div class="results-section">
                <div class="results-header">
                    <div class="results-info">
                        <h3 class="results-count">
                            <span class="count-number">{{ $initialCourses->total() }}</span> {{ __('courses') }}
                        </h3>
                    </div>
                    <div class="results-controls">
                        <div class="sort-control">
                            <label for="sort-select" class="sort-label">{{ __('Sort by:') }}</label>
                            <select name="orderby" class="sort-select" id="sort-select">
                                <option value="desc">{{ __('Most Recent') }}</option>
                                <option value="asc">{{ __('Oldest First') }}</option>
                                <option value="popular">{{ __('Most Popular') }}</option>
                                <option value="rating">{{ __('Highest Rated') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Courses Grid -->
                <div class="courses-grid">
                    @include('frontend.partials.course-card', ['courses' => $initialCourses])
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    {{ $initialCourses->links() }}
                </div>
            </div>

            <!-- Hidden sidebar for compatibility -->
            <div style="display: none;">
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
            </div>
        </div>
    </section>
    <!-- modern-courses-section-end -->
@endsection

@push('scripts')
    <script src="{{ asset('frontend/js/default/course-page.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filtersToggle = document.getElementById('filtersToggle');
            const filtersContent = document.getElementById('filtersContent');
            const activeFiltersCount = document.getElementById('activeFiltersCount');
            
            // Toggle filters dropdown
            filtersToggle.addEventListener('click', function() {
                this.classList.toggle('active');
                filtersContent.classList.toggle('active');
            });
            
            // Count active filters
            function updateActiveFiltersCount() {
                const checkedFilters = document.querySelectorAll('.filter-checkbox:checked');
                const count = checkedFilters.length;
                
                if (count > 0) {
                    activeFiltersCount.textContent = count;
                    activeFiltersCount.style.display = 'inline-block';
                } else {
                    activeFiltersCount.style.display = 'none';
                }
            }
            
            // Listen for filter changes
            document.addEventListener('change', function(e) {
                if (e.target.classList.contains('filter-checkbox')) {
                    updateActiveFiltersCount();
                }
            });
            
            // Initialize count
            updateActiveFiltersCount();
            
            // Auto-close on mobile when clicking outside
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && 
                    !filtersToggle.contains(e.target) && 
                    !filtersContent.contains(e.target) &&
                    filtersContent.classList.contains('active')) {
                    filtersToggle.classList.remove('active');
                    filtersContent.classList.remove('active');
                }
            });
        });
    </script>
@endpush
