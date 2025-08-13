@extends('frontend.student-dashboard.layouts.master')

@push('styles')
<style>
    .modern-settings-container {
        background: #f8fafc;
        min-height: 100vh;
        padding: 2rem 0;
    }
    
    .settings-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: none;
    }
    
    .settings-header {
        background: linear-gradient(135deg, #0066cc 0%, #004499 100%);
        color: white;
        padding: 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .settings-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }
    
    .settings-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        position: relative;
        z-index: 2;
    }
    
    .settings-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-top: 0.5rem;
        position: relative;
        z-index: 2;
    }
    
    .modern-nav-tabs {
        background: #f8fafc;
        border: none;
        padding: 1rem;
        border-radius: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        justify-content: center;
    }
    
    .modern-nav-tabs .nav-item {
        margin: 0;
    }
    
    .modern-nav-tabs .nav-link {
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        color: #64748b;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        margin: 0;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .modern-nav-tabs .nav-link:hover {
        background: #f1f5f9;
        border-color: #0066cc;
        color: #0066cc;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 102, 204, 0.2);
    }
    
    .modern-nav-tabs .nav-link.active {
        background: #0066cc;
        border-color: #0066cc;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 102, 204, 0.3);
    }
    
    .modern-nav-tabs .nav-link.active::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        animation: shimmer 2s infinite;
    }
    
    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }
    
    .modern-tab-content {
        padding: 2rem;
        background: white;
    }
    
    .tab-pane {
        animation: fadeInUp 0.5s ease;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @media (max-width: 768px) {
        .modern-settings-container {
            padding: 1rem 0;
        }
        
        .settings-header {
            padding: 1.5rem;
        }
        
        .settings-title {
            font-size: 2rem;
        }
        
        .modern-nav-tabs {
            padding: 0.5rem;
        }
        
        .modern-nav-tabs .nav-link {
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
        }
        
        .modern-tab-content {
            padding: 1rem;
        }
    }
</style>
@endpush

@section('dashboard-contents')
    <div class="modern-settings-container">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="settings-card">
                        <div class="settings-header">
                            <h1 class="settings-title">{{ __('Profile Settings') }}</h1>
                            <p class="settings-subtitle">{{ __('Manage your account settings and preferences') }}</p>
                        </div>
                        
                        <div class="modern-nav-tabs">
                            <ul class="nav nav-tabs w-100 justify-content-center" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ session('profile_tab') == 'profile' ? 'active' : '' }}" id="itemOne-tab" data-bs-toggle="tab"
                                        data-bs-target="#itemOne-tab-pane" type="button" role="tab"
                                        aria-controls="itemOne-tab-pane" aria-selected="true">
                                        <i class="fas fa-user me-2"></i>{{ __('Profile') }}
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ session('profile_tab') == 'bio' ? 'active' : '' }}" id="itemFour-tab" data-bs-toggle="tab"
                                        data-bs-target="#itemFour-tab-pane" type="button" role="tab"
                                        aria-controls="itemFour-tab-pane" aria-selected="false">
                                        <i class="fas fa-file-alt me-2"></i>{{ __('Biography') }}
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ session('profile_tab') == 'location' ? 'active' : '' }}" id="itemSix-tab" data-bs-toggle="tab"
                                        data-bs-target="#itemSix-tab-pane" type="button" role="tab"
                                        aria-controls="itemSix-tab-pane" aria-selected="false">
                                        <i class="fas fa-map-marker-alt me-2"></i>{{ __('Location') }}
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ session('profile_tab') == 'password' ? 'active' : '' }}" id="itemTwo-tab" data-bs-toggle="tab"
                                        data-bs-target="#itemTwo-tab-pane" type="button" role="tab"
                                        aria-controls="itemTwo-tab-pane" aria-selected="false">
                                        <i class="fas fa-lock me-2"></i>{{ __('Password') }}
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ session('profile_tab') == 'social' ? 'active' : '' }}" id="itemThree-tab" data-bs-toggle="tab"
                                        data-bs-target="#itemThree-tab-pane" type="button" role="tab"
                                        aria-controls="itemThree-tab-pane" aria-selected="false">
                                        <i class="fas fa-share-alt me-2"></i>{{ __('Social') }}
                                    </button>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="modern-tab-content">
                            <div class="tab-content" id="myTabContent">
                                @include('frontend.student-dashboard.profile.sections.profile')
                                @include('frontend.student-dashboard.profile.sections.biography')
                                @include('frontend.student-dashboard.profile.sections.password')
                                @include('frontend.student-dashboard.profile.sections.location')
                                @include('frontend.student-dashboard.profile.sections.social')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
