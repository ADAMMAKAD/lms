@extends('frontend.layouts.master')

@section('meta_title')
    {{ __('Instructor Dashboard') }}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/modern-dashboard.css') }}">
@endpush

@section('contents')
    <!-- Breadcrumb Area -->
    <div class="breadcrumb-area" style="background: linear-gradient(135deg, #282f76); padding: 60px 0;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2 class="text-white mb-3">{{ __('Instructor Dashboard') }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active text-white" aria-current="page">{{ __('Instructor Dashboard') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modern Header -->
    <div class="modern-header" style="background: linear-gradient(135deg, #282f76); padding: 40px 0; margin-top: -1px;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="user-profile-section d-flex align-items-center">
                        <div class="user-avatar me-4">
                            @if(auth()->user()->image)
                                <img src="{{ asset(auth()->user()->image) }}" alt="Profile" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover; border: 4px solid rgba(255,255,255,0.3);">
                            @else
                                <div class="avatar-placeholder rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: rgba(255,255,255,0.2); border: 4px solid rgba(255,255,255,0.3);">
                                    <i class="fas fa-user text-white" style="font-size: 30px;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="user-info text-white">
                            <h3 class="mb-1" style="font-weight: 600;">{{ auth()->user()->name }}</h3>
                            <p class="mb-1 opacity-75">{{ auth()->user()->email }}</p>
                            @if(auth()->user()->phone)
                                <p class="mb-0 opacity-75"><i class="fas fa-phone me-2"></i>{{ auth()->user()->phone }}</p>
                            @endif
                            <span class="badge bg-success mt-2">{{ __('Instructor') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <div class="quick-actions">
                        <a href="{{ route('instructor.chat') }}" class="btn btn-light btn-sm me-2">
                            <i class="fas fa-comments me-1"></i> {{ __('Chat') }}
                        </a>
                        <a href="{{ route('instructor.meetings') }}" class="btn btn-outline-light btn-sm">
                            <i class="fas fa-calendar me-1"></i> {{ __('Meetings') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Content -->
    <div class="dashboard-area py-5">
        <div class="container">
            <div class="dashboard-inner-wrap">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-lg-3 col-md-4">
                        <div class="sidebar-wrapper">
                            @include('frontend.instructor-dashboard.layouts.sidebar')
                        </div>
                    </div>
                    <!-- Main Content -->
                    <div class="col-lg-9 col-md-8">
                        <div class="dashboard-content">
                            @yield('dashboard-content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .dashboard-area {
            background-color: #f8f9fa;
            min-height: 70vh;
        }
        
        .dashboard-inner-wrap {
            margin-top: -60px;
            position: relative;
            z-index: 10;
        }
        
        .sidebar-wrapper {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .dashboard-content {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 30px;
            min-height: 600px;
        }
        
        .modern-header .quick-actions .btn {
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 500;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255,255,255,0.5);
        }
    </style>
@endsection