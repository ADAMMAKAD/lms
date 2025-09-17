@extends('frontend.layouts.master')

<!-- meta -->
@section('meta_title', __('Student Dashboard'))
<!-- end meta -->

@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/modern-dashboard.css') }}">
@endpush

@section('contents')
    <!-- breadcrumb-area -->
    <x-frontend.breadcrumb
        :title="__('')"
        :links="[]"
    />
    <!-- breadcrumb-area-end -->

    <!-- dashboard-area -->
    <section class="dashboard__area" style="margin-top: 0 !important; padding-top: 2rem !important;">
        <div class="container-fluid">
            <!-- Modern Header with Gradient Background -->
            <div class="modern-dashboard-header" style="background: linear-gradient(135deg, #282f76 100%); border-radius: 16px; padding: 2rem; margin-bottom: 2rem; position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);">
                <!-- Background Pattern -->
                <div style="position: absolute; top: 0; right: 0; width: 200px; height: 200px; background: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22%3E%3Cdefs%3E%3Cpattern id=%22grain%22 width=%22100%22 height=%22100%22 patternUnits=%22userSpaceOnUse%22%3E%3Ccircle cx=%2250%22 cy=%2250%22 r=%221%22 fill=%22%23ffffff%22 opacity=%220.1%22/%3E%3C/pattern%3E%3C/defs%3E%3Crect width=%22100%22 height=%22100%22 fill=%22url(%23grain)%22/%3E%3C/svg%3E'); opacity: 0.3;"></div>
                
                <div class="header-content" style="position: relative; z-index: 2;">
                    <div class="user-profile-section" style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 1rem;">
                        <div class="user-avatar" style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; border: 3px solid rgba(255, 255, 255, 0.3); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);">
                            <img src="{{ asset(auth()->user()->image) }}" alt="{{ auth()->user()->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="user-info">
                            <h2 style="color: white; font-size: 2rem; font-weight: 700; margin: 0 0 0.5rem 0; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">{{ auth()->user()->name }}</h2>
                            <div class="user-details" style="display: flex; flex-direction: column; gap: 0.3rem;">
                                <div style="display: flex; align-items: center; gap: 0.5rem; color: rgba(255, 255, 255, 0.9); font-size: 0.95rem;">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <span>{{ auth()->user()->email }}</span>
                                </div>
                                @if(auth()->user()->phone)
                                <div style="display: flex; align-items: center; gap: 0.5rem; color: rgba(255, 255, 255, 0.9); font-size: 0.95rem;">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    <span>{{ auth()->user()->phone }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div>
            <div class="dashboard__inner-wrap">
                <div class="row g-4">
                    <div class="col-lg-3 col-md-4">
                        <div class="dashboard__sidebar-wrapper">
                            @include('frontend.student-dashboard.layouts.sidebar')
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8">
                        <div class="dashboard__content" style="background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); border: 1px solid #e5e7eb; min-height: 500px;">
                            <div class="dashboard__content-inner">
                                @yield('dashboard-contents')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- dashboard-area-end -->
@endsection

<style>
/* Dashboard Layout Fixes - Override frontend.css conflicts */
section.dashboard__area {
    background: #f8fafc !important;
    min-height: 100vh !important;
    margin-top: 0 !important;
    padding-top: 2rem !important;
    position: static !important;
    z-index: auto !important;
}

/* Specific override for the negative margin in frontend.css */
.dashboard__area {
    margin-top: 0 !important;
}

.dashboard__inner-wrap {
    margin-top: 0 !important;
}

.dashboard__sidebar-wrapper {
    /* Remove static positioning to allow modern sidebar to work */
}

.dashboard__sidebar-wrap {
    /* Remove static positioning to allow modern sidebar to work */
    margin-top: 0 !important;
}

.dashboard__content {
    width: 100% !important;
    margin-top: 0 !important;
}

.dashboard__content-wrap {
    margin-top: 0 !important;
}

/* Ensure proper Bootstrap grid behavior */
.row {
    margin-left: 0 !important;
    margin-right: 0 !important;
    display: flex !important;
    flex-wrap: wrap !important;
}

.col-lg-3, .col-lg-9, .col-md-4, .col-md-8 {
    padding-left: 15px !important;
    padding-right: 15px !important;
    position: relative !important;
    width: 100%;
    min-height: 1px;
}

/* Allow proper positioning for sidebar and other elements */
.dashboard__inner-wrap .row > div {
    position: relative !important;
}

/* Responsive Design for Dashboard */
@media (max-width: 991.98px) {
    .dashboard__sidebar-wrapper {
        position: static !important;
        margin-bottom: 2rem;
        width: 100% !important;
        height: auto !important;
    }
    
    .dashboard__content {
        margin-top: 0 !important;
    }
}

@media (max-width: 768px) {
    .dashboard__sidebar-wrapper {
        position: static !important;
        top: auto !important;
        left: auto !important;
        width: 100% !important;
        height: auto !important;
        z-index: auto !important;
        margin-bottom: 1rem;
    }
    
    .col-lg-3, .col-lg-9, .col-md-4, .col-md-8 {
        width: 100% !important;
        max-width: 100% !important;
        flex: 0 0 100% !important;
    }
    
    .modern-sidebar {
        height: auto !important;
        overflow-y: visible !important;
    }
    
    .dashboard__content {
        margin-top: 0;
    }
    
    .modern-dashboard-header {
        margin-bottom: 1rem !important;
        padding: 1.5rem !important;
    }
    
    .user-profile-section {
        flex-direction: column !important;
        text-align: center !important;
        gap: 1rem !important;
    }
    
    .user-info h2 {
        font-size: 1.5rem !important;
    }
    
    .header-actions {
        justify-content: center !important;
    }
}

@media (max-width: 480px) {
    .modern-dashboard-header {
        padding: 1rem !important;
    }
    
    .user-info h2 {
        font-size: 1.25rem !important;
    }
    
    .dashboard__content {
        padding: 1rem !important;
    }
}

/* Mobile Menu Toggle */
.mobile-menu-toggle {
    display: none;
    position: fixed;
    top: 1rem;
    left: 1rem;
    z-index: 1001;
    background: #282f76;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 0.75rem;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

@media (max-width: 768px) {
    .mobile-menu-toggle {
        display: block;
    }
}
</style>

<script>
// Mobile menu functionality
document.addEventListener('DOMContentLoaded', function() {
    // Create mobile menu toggle button
    const toggleButton = document.createElement('button');
    toggleButton.className = 'mobile-menu-toggle';
    toggleButton.innerHTML = '<i class="fas fa-bars"></i>';
    document.body.appendChild(toggleButton);
    
    const sidebarWrapper = document.querySelector('.dashboard__sidebar-wrapper');
    
    toggleButton.addEventListener('click', function() {
        sidebarWrapper.classList.toggle('active');
        toggleButton.innerHTML = sidebarWrapper.classList.contains('active') ? 
            '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
    });
    
    // Close sidebar when clicking outside
    sidebarWrapper.addEventListener('click', function(e) {
        if (e.target === sidebarWrapper) {
            sidebarWrapper.classList.remove('active');
            toggleButton.innerHTML = '<i class="fas fa-bars"></i>';
        }
    });
    
    // Close sidebar when clicking on a link (mobile)
    const sidebarLinks = document.querySelectorAll('.modern-sidebar a');
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                sidebarWrapper.classList.remove('active');
                toggleButton.innerHTML = '<i class="fas fa-bars"></i>';
            }
        });
    });
});
</script>
