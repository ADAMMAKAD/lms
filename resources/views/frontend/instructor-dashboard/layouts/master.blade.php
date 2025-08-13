@extends('frontend.layouts.master')

<!-- meta -->
@section('meta_title', __('Instructor Dashboard'))
<!-- end meta -->

@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/modern-dashboard.css') }}">
@endpush

@section('contents')
    <!-- breadcrumb-area -->
    <x-frontend.breadcrumb :title="__('')" :links="[]" />
    <!-- breadcrumb-area-end -->

    <!-- dashboard-area -->
    <section class="dashboard__area">
        <div class="container">
            <div class="dashboard__top">
                <div class="dashboard__instructor-info">
                    <div class="dashboard__instructor-info-left">
                        <div class="thumb">
                            <img src="{{ asset(auth()->user()->image) }}" alt="img">
                        </div>
                        <div class="content">
                            <h4 class="title">{{ auth()->user()->name }}</h4>
                            <ul class="list-wrap">
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    {{ auth()->user()->email }}
                                </li>
                                @if (auth()->user()->phone)
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        {{ auth()->user()->phone }}
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="dashboard__instructor-info-right">
                        <a href="{{ route('student.dashboard') }}" class="btn btn-primary">{{ __('Student Dashboard') }}</a>
                    </div>
                </div>
            </div>
            <div class="dashboard__content">
                <div class="dashboard__sidebar-wrap">
                    @include('frontend.instructor-dashboard.layouts.sidebar')
                </div>
                <div class="dashboard__main-content">
                    {{-- <div class="preloader d-none">
                        <div class="loader-icon"><img src="{{ asset(Cache::get('setting')->preloader) }}" alt="Preloader">
                        </div>
                    </div> --}} {{-- Removed preloader functionality --}}

                    @yield('dashboard-contents')
                </div>
            </div>
        </div>
    </section>
    <!-- dashboard-area-end -->
@endsection
@push('scripts')
<script src="{{ asset('frontend/js/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('frontend/js/custom-tinymce.js') }}"></script>
@endpush
