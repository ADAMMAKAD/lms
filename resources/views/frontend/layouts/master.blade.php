<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('meta_title', $setting->app_name)</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', '')">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Custom Meta -->
    @stack('custom_meta')
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset($setting->favicon) }}">
    <!-- CSS here -->
    @include('frontend.layouts.styles')
    <!-- CustomCSS here -->
    @stack('styles')
    @if (customCode()?->css)
        <style>
            {!! customCode()->css !!}
        </style>
    @endif

    {{-- dynamic header scripts --}}
    @include('frontend.layouts.header-scripts')

    @php
        setEnrollmentIdsInSession();
        setInstructorCourseIdsInSession();
        $theme_name = session()->has('demo_theme') ? session()->get('demo_theme') : DEFAULT_HOMEPAGE;
    @endphp
</head>
<body class="{{ isRoute('home', "home_{$theme_name}") }}">
    @if ($setting->google_tagmanager_status == 'active' && $setting->google_tagmanager_id != 'google_tagmanager_id' && !empty($setting->google_tagmanager_id))
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $setting->google_tagmanager_id }}"
                height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endif

    {{-- Preloader removed as requested --}}

    <!-- Scroll-top -->
    <button class="scroll__top scroll-to-target modern-scroll-top" data-target="html" aria-label="Scroll Top" 
            style="position: fixed; bottom: 30px; right: 30px; width: 55px; height: 55px; background: linear-gradient(135deg, #0066cc, #004499); border: none; border-radius: 50%; color: white; font-size: 20px; cursor: pointer; z-index: 9999; box-shadow: 0 4px 20px rgba(0,102,204,0.3); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); opacity: 0; visibility: hidden; transform: translateY(20px);" 
            onmouseover="this.style.transform='translateY(-5px) scale(1.1)'; this.style.boxShadow='0 8px 30px rgba(0,102,204,0.5)'; this.style.background='linear-gradient(135deg, #ffd700, #ffed4e)'; this.style.color='#0066cc'" 
            onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 4px 20px rgba(0,102,204,0.3)'; this.style.background='linear-gradient(135deg, #0066cc, #004499)'; this.style.color='white'">
        <i class="fas fa-arrow-up" style="font-size: 18px;"></i>
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%; height: 100%; border-radius: 50%; background: rgba(255,255,255,0.1); opacity: 0; transition: all 0.3s ease;" class="ripple-effect"></div>
    </button>
    
    <style>
        .modern-scroll-top.show {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) !important;
        }
        
        .modern-scroll-top:hover .ripple-effect {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1.5);
        }
        
        .modern-scroll-top:active {
            transform: translateY(0) scale(0.95) !important;
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 4px 20px rgba(0,102,204,0.3); }
            50% { box-shadow: 0 4px 25px rgba(0,102,204,0.5); }
            100% { box-shadow: 0 4px 20px rgba(0,102,204,0.3); }
        }
        
        .modern-scroll-top {
            animation: pulse 2s infinite;
        }
    </style>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scrollBtn = document.querySelector('.modern-scroll-top');
            
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    scrollBtn.classList.add('show');
                } else {
                    scrollBtn.classList.remove('show');
                }
            });
            
            scrollBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });
    </script>
    <!-- Scroll-top-end-->

    <!-- header-area -->
    @include('frontend.layouts.header')
    <!-- header-area-end -->

    <!-- main-area -->
    <main class="main-area fix">
        @yield('contents')
    </main>
    <!-- main-area-end -->

    <!-- modal-area -->
    @include('frontend.partials.modal')
    @include('frontend.instructor-dashboard.course.partials.add-new-section-modal')
    <!-- modal-area -->

    <!-- footer-area -->
    @include('frontend.layouts.footer')
    <!-- footer-area-end -->


    <!-- JS here -->
    @include('frontend.layouts.scripts')

    <!-- Language Translation Variables -->
    @include('global.dynamic-js-variables')

    <!-- Page specific js -->
    @if (session('registerUser') && $setting->google_tagmanager_status == 'active' && $setting->google_tagmanager_id != 'google_tagmanager_id' && !empty($setting->google_tagmanager_id) && $marketing_setting?->register)
        @php
            $registerUser = session('registerUser');
            session()->forget('registerUser');
        @endphp
        <script>
            $(function() {
                dataLayer.push({
                    'event': 'newStudent',
                    'student_info': @json($registerUser)
                });
            });
        </script>
    @endif
    @stack('scripts')
    @if (customCode()?->javascript)
        <script>
            "use strict";
            {!! customCode()->javascript !!}
        </script>
    @endif
</body>

</html>
