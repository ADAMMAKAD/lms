@extends('admin.master_layout')
@section('title')
    <title>{{ __('Settings') }}</title>
@endsection

@push('css')
<style>
/* Modern Settings Page Styles */
.modern-settings-container {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: calc(100vh - 120px);
    padding: 2rem 0;
}

.settings-header {
    text-align: center;
    margin-bottom: 3rem;
}

.settings-title {
    font-size: 2.5rem;
    font-weight: 700;
    background: linear-gradient(135deg, #282f76 0%, #667eea 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
}

.settings-subtitle {
    color: #64748b;
    font-size: 1.1rem;
    font-weight: 500;
}

.modern-settings-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

.modern-setting-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(71, 135, 237, 0.1);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.modern-setting-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #282f76 0%, #667eea 50%, #764ba2 100%);
    border-radius: 20px 20px 0 0;
}

.modern-setting-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(71, 135, 237, 0.15);
    border-color: rgba(71, 135, 237, 0.3);
}

.setting-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #282f76 0%, #667eea 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    box-shadow: 0 8px 25px rgba(71, 135, 237, 0.3);
    transition: all 0.3s ease;
}

.modern-setting-card:hover .setting-icon {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 12px 35px rgba(71, 135, 237, 0.4);
}

.setting-icon i {
    font-size: 2rem;
    color: white;
}

.setting-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    text-align: center;
    margin-bottom: 0.75rem;
}

.setting-description {
    color: #64748b;
    font-size: 0.95rem;
    text-align: center;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.setting-action {
    display: block;
    width: 100%;
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, #282f76 0%, #667eea 100%);
    color: white;
    text-decoration: none;
    border-radius: 12px;
    font-weight: 500;
    text-align: center;
    transition: all 0.3s ease;
    border: none;
    position: relative;
    overflow: hidden;
}

.setting-action::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.setting-action:hover::before {
    left: 100%;
}

.setting-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(71, 135, 237, 0.4);
    color: white;
    text-decoration: none;
}

.setting-action i {
    margin-left: 0.5rem;
    transition: transform 0.3s ease;
}

.setting-action:hover i {
    transform: translateX(3px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .modern-settings-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
        padding: 0 0.5rem;
    }
    
    .modern-setting-card {
        padding: 1.5rem;
    }
    
    .settings-title {
        font-size: 2rem;
    }
    
    .setting-icon {
        width: 70px;
        height: 70px;
    }
    
    .setting-icon i {
        font-size: 1.75rem;
    }
}

@media (max-width: 480px) {
    .modern-settings-container {
        padding: 1rem 0;
    }
    
    .settings-title {
        font-size: 1.75rem;
    }
    
    .modern-setting-card {
        padding: 1.25rem;
    }
}
</style>
@endpush

@section('admin-content')
    <div class="main-content" style="margin-top: 1rem;">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Settings') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Settings') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="modern-settings-container">
                    <div class="settings-header">
                        <h1 class="settings-title">{{ __('System Settings') }}</h1>
                        <p class="settings-subtitle">{{ __('Configure and manage your application settings') }}</p>
                    </div>
                    
                    <div class="modern-settings-grid">
                    @if (Module::isEnabled('GlobalSetting') && checkAdminHasPermission('setting.view'))
                        <div class="modern-setting-card">
                            <div class="setting-icon">
                                <i class="fas fa-cog"></i>
                            </div>
                            <h4 class="setting-title">{{ __('General Setting') }}</h4>
                            <p class="setting-description">{{ __('Configure basic application settings, site information, and general preferences') }}</p>
                            <a href="{{ route('admin.general-setting') }}" class="setting-action">
                                {{ __('Configure Settings') }}
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                        
                        <div class="modern-setting-card">
                            <div class="setting-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h4 class="setting-title">{{ __('Email Configuration') }}</h4>
                            <p class="setting-description">{{ __('Set up SMTP settings, email templates, and notification preferences') }}</p>
                            <a href="{{ route('admin.email-configuration') }}" class="setting-action">
                                {{ __('Configure Email') }}
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                        
                        <div class="modern-setting-card">
                            <div class="setting-icon">
                                <i class="fas fa-key"></i>
                            </div>
                            <h4 class="setting-title">{{ __('Credential Settings') }}</h4>
                            <p class="setting-description">{{ __('Manage API keys, third-party integrations, and security credentials') }}</p>
                            <a href="{{ route('admin.crediential-setting') }}" class="setting-action">
                                {{ __('Manage Credentials') }}
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                        
                        <div class="modern-setting-card">
                            <div class="setting-icon">
                                <i class="fas fa-arrow-circle-up"></i>
                            </div>
                            <h4 class="setting-title">{{ __('System Update') }}</h4>
                            <p class="setting-description">{{ __('Check for updates, manage system versions, and apply security patches') }}</p>
                            <a href="{{ route('admin.system-update.index') }}" class="setting-action">
                                {{ __('Check Updates') }}
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                        
                        <!-- <div class="modern-setting-card">
                            <div class="setting-icon">
                                <i class="fas fa-money-bill"></i>
                            </div>
                            <h4 class="setting-title">{{ __('Admin Commission') }}</h4>
                            <p class="setting-description">{{ __('Configure commission rates, payment settings, and revenue management') }}</p>
                            <a href="{{ route('admin.commission-setting') }}" class="setting-action">
                                {{ __('Set Commission') }}
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    @endif -->
                    <!-- @if (Module::isEnabled('GlobalSetting') && checkAdminHasPermission('addon.view'))
                        <div class="modern-setting-card">
                            <div class="setting-icon">
                                <i class="fas fa-plug"></i>
                            </div>
                            <h4 class="setting-title">{{ __('Manage Addons') }}</h4>
                            <p class="setting-description">{{ __('Install, activate, and configure system addons and extensions') }}</p>
                            <a href="{{ route('admin.addons.view') }}" class="setting-action">
                                {{ __('Manage Addons') }}
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    @endif
                     -->
                    <!-- @adminCan('currency.view')
                        <div class="modern-setting-card">
                            <div class="setting-icon">
                                <i class="fas fa-coins"></i>
                            </div>
                            <h4 class="setting-title">{{ __('Multi Currency') }}</h4>
                            <p class="setting-description">{{ __('Configure multiple currencies, exchange rates, and payment options') }}</p>
                            <a href="{{ route('admin.currency.index') }}" class="setting-action">
                                {{ __('Manage Currency') }}
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    @endadminCan -->
                    
                    @adminCan('language.view')
                        <div class="modern-setting-card">
                            <div class="setting-icon">
                                <i class="fas fa-language"></i>
                            </div>
                            <h4 class="setting-title">{{ __('Manage Language') }}</h4>
                            <p class="setting-description">{{ __('Add languages, manage translations, and configure localization settings') }}</p>
                            <a href="{{ route('admin.languages.index') }}" class="setting-action">
                                {{ __('Manage Languages') }}
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    @endadminCan

                    @if (checkAdminHasPermission('admin.view') || checkAdminHasPermission('role.view'))
                        <div class="modern-setting-card">
                            <div class="setting-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h4 class="setting-title">{{ __('Admin & Roles') }}</h4>
                            <p class="setting-description">{{ __('Manage administrators, assign roles, and configure user permissions') }}</p>
                            <a href="{{ route('admin.admin.index') }}" class="setting-action">
                                {{ __('Manage Access') }}
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    @endif
                    
                    @if (Module::isEnabled('GlobalSetting') && checkAdminHasPermission('setting.view'))
                        <div class="modern-setting-card">
                            <div class="setting-icon">
                                <i class="fas fa-ad"></i>
                            </div>
                            <h4 class="setting-title">{{ __('Marketing Settings') }}</h4>
                            <p class="setting-description">{{ __('Configure SEO settings, analytics, and marketing tools integration') }}</p>
                            <a href="{{ route('admin.marketing-setting') }}" class="setting-action">
                                {{ __('Configure Marketing') }}
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection
