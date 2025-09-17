@php
    $header_admin = Auth::guard('admin')->user();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="" type="image/x-icon">
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="mode" content="{{ env('PROJECT_MODE') ?? 'LIVE' }}">
    <!-- Custom Meta -->
    @yield('custom_meta')

    @yield('title')
    <link rel="icon" href="{{ asset($setting->favicon) }}">
    @include('admin.partials.styles')
    @stack('css')
    @yield('vite')
    
    <style>
    /* Enhanced Top Bar Styles */
    .modern-navbar {
        background: linear-gradient(135deg, #4787ed 0%, #4787ed 100%);
        box-shadow: 0 2px 20px rgba(37, 99, 235, 0.3);
        border: none;
        padding: 1rem 2rem;
        min-height: 70px;
        display: flex;
        align-items: center;
    }
    
    /* Compact Search Styles */
    .compact-search-container {
        position: relative;
        display: flex;
        align-items: center;
    }
    
    .search-toggle-btn {
        background: rgba(255, 255, 255, 0.15);
        border: none;
        color: #fff;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .search-toggle-btn:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: scale(1.05);
    }
    
    .search-input-wrapper {
        position: absolute;
        left: 50px;
        top: 50%;
        transform: translateY(-50%);
        background: #fff;
        border-radius: 25px;
        padding: 0;
        width: 0;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
    }
    
    .search-input-wrapper.active {
        width: 300px;
        padding: 0 15px;
    }
    
    .compact-search-input {
        border: none;
        outline: none;
        background: transparent;
        padding: 12px 0;
        font-size: 0.9rem;
        flex: 1;
        color: #333;
    }
    
    .compact-search-input::placeholder {
        color: #999;
    }
    
    .search-close-btn {
        background: none;
        border: none;
        color: #999;
        padding: 5px;
        cursor: pointer;
        transition: color 0.3s ease;
    }
    
    .search-close-btn:hover {
        color: #666;
    }
    
    .compact-search-dropdown {
        position: absolute;
        top: 100%;
        left: 50px;
        right: 0;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        max-height: 400px;
        overflow-y: auto;
        margin-top: 5px;
    }
    
    /* Enhanced User Profile Styles */
    .enhanced-user-profile-btn {
        display: flex;
        align-items: center;
        padding: 10px 16px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.05));
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 30px;
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        color: #fff;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .enhanced-user-profile-btn:hover {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.25), rgba(255, 255, 255, 0.15));
        text-decoration: none;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        border-color: rgba(255, 255, 255, 0.4);
    }
    
    .user-avatar-enhanced {
        position: relative;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 14px;
        border: 2px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }
    
    .enhanced-user-profile-btn:hover .user-avatar-enhanced {
        border-color: rgba(255, 255, 255, 0.6);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
        transform: scale(1.05);
    }
    
    .user-avatar-enhanced img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .avatar-placeholder-enhanced {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .status-indicator {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 12px;
        height: 12px;
        background: #4CAF50;
        border: 2px solid #fff;
        border-radius: 50%;
    }
    
    .user-info-enhanced {
        display: flex;
        flex-direction: column;
        margin-right: 8px;
    }
    
    .user-name-enhanced {
        font-weight: 600;
        font-size: 0.9rem;
        line-height: 1.2;
        color: #fff;
    }
    
    .user-role-enhanced {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.2;
    }
    
    .dropdown-arrow {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.8);
        transition: transform 0.3s ease;
    }
    
    .enhanced-user-profile-btn[aria-expanded="true"] .dropdown-arrow {
        transform: rotate(180deg);
    }
    
    /* Enhanced Navbar Actions */
    .navbar-action-btn {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        position: relative;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        font-size: 16px;
    }
    
    .navbar-action-btn:hover {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.2));
        color: #fff;
        text-decoration: none;
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        border-color: rgba(255, 255, 255, 0.4);
    }
    
    .navbar-action-btn:active {
        transform: translateY(0) scale(0.98);
        transition: all 0.1s ease;
    }
    
    .notification-badge {
        position: absolute;
        top: -4px;
        right: -4px;
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        color: #fff;
        font-size: 0.65rem;
        font-weight: 700;
        padding: 3px 7px;
        border-radius: 12px;
        min-width: 20px;
        text-align: center;
        border: 2px solid #fff;
        box-shadow: 0 2px 8px rgba(255, 107, 107, 0.4);
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    
    /* Enhanced Dropdown Styles */
    .modern-dropdown-menu {
        background: #fff;
        border: none;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        padding: 0;
        margin-top: 8px;
        min-width: 280px;
        backdrop-filter: blur(20px);
        animation: dropdownFadeIn 0.3s ease-out;
    }
    
    @keyframes dropdownFadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    .modern-dropdown-item {
        padding: 12px 20px;
        color: #2c3e50;
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        border-radius: 0;
    }
    
    .modern-dropdown-item:hover {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        color: #4787ed;
        text-decoration: none;
        transform: translateX(4px);
    }
    
    .modern-dropdown-item i {
        margin-right: 12px;
        width: 18px;
        text-align: center;
        font-size: 16px;
    }
    
    /* User Avatar Large in Dropdown */
    .user-avatar-large {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 16px;
        flex-shrink: 0;
        border: 3px solid #f8f9fa;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .user-avatar-large img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .dropdown-header {
        display: flex;
        align-items: center;
        padding: 20px;
        background: linear-gradient(135deg, #f8f9fa, #ffffff);
        border-radius: 16px 16px 0 0;
        border-bottom: 1px solid #e9ecef;
    }
    
    .user-details {
        flex: 1;
    }
    
    .user-details h6 {
        margin: 0 0 4px 0;
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.1rem;
    }
    
    .user-details p {
        margin: 0;
        color: #6c757d;
        font-size: 0.875rem;
        font-weight: 500;
    }
    
    /* Notification Menu Specific Styles */
    .notification-menu {
        min-width: 320px;
        max-height: 400px;
        overflow-y: auto;
    }
    
    .notification-menu .dropdown-header h6 {
        color: #2c3e50;
        font-weight: 700;
        margin: 0;
        font-size: 1.1rem;
    }
    
    .logout-item {
        color: #dc3545 !important;
        border-top: 1px solid #e9ecef;
        margin-top: 8px;
    }
    
    .logout-item:hover {
        background: linear-gradient(135deg, #fff5f5, #fee);
        color: #dc3545 !important;
    }
    
    /* Navbar Action Wrapper */
    .navbar-action-wrapper {
        position: relative;
        display: inline-block;
    }
    
    /* Tooltip Styles */
    .navbar-action-btn[data-tooltip]:hover::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: -35px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.8);
        color: #fff;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 12px;
        white-space: nowrap;
        z-index: 1000;
        opacity: 0;
        animation: tooltipFadeIn 0.3s ease-out forwards;
    }
    
    .navbar-action-btn[data-tooltip]:hover::before {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        border: 4px solid transparent;
        border-bottom-color: rgba(0, 0, 0, 0.8);
        z-index: 1001;
        opacity: 0;
        animation: tooltipFadeIn 0.3s ease-out forwards;
    }
    
    @keyframes tooltipFadeIn {
        from {
            opacity: 0;
            transform: translateX(-50%) translateY(5px);
        }
        to {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
    }
    
    /* Enhanced Navbar Right Section */
    .navbar-right {
        margin-left: auto;
        padding-left: 20px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .search-input-wrapper.active {
            width: 250px;
        }
        
        .user-info-enhanced {
            display: none !important;
        }
        
        .enhanced-user-profile-btn {
            padding: 8px;
        }
        
        .navbar-right {
            gap: 8px !important;
        }
        
        .navbar-action-btn {
            width: 40px;
            height: 40px;
            font-size: 14px;
        }
    }
    
    @media (max-width: 576px) {
        .search-input-wrapper.active {
            width: 200px;
        }
        
        .navbar-right {
            gap: 6px !important;
        }
        
        .navbar-action-btn {
            width: 36px;
            height: 36px;
            font-size: 13px;
        }
    }
    </style>
</head>

<body class="{{ request()->routeIs('admin.dashboard') ? 'dashboard-page' : '' }}">
    <div id="app">
        <div class="main-wrapper">
            <!-- Sidebar Overlay for Mobile -->
            <div class="sidebar-overlay"></div>
            
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg modern-navbar">
                <!-- Left side - Menu toggle and brand -->
                <div class="navbar-left d-flex align-items-center">
                    <button class="sidebar-toggle-btn" data-toggle="sidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <!-- Language and Currency selectors -->
                    <div class="navbar-controls d-flex align-items-center ml-3">
                        @if (Module::isEnabled('Language') && Route::has('set-language'))
                            @if (count(allLanguages()?->where('status', 1)) > 1)
                                <form id="setLanguageHeader" action="{{ route('set-language') }}" class="mr-2">
                                    <select class="modern-select" name="code">
                                        @forelse (allLanguages()?->where('status', 1) as $language)
                                            <option value="{{ $language->code }}"
                                                {{ getSessionLanguage() == $language->code ? 'selected' : '' }}>
                                                {{ $language->name }}
                                            </option>
                                        @empty
                                            <option value="en" {{ getSessionLanguage() == 'en' ? 'selected' : '' }}>
                                                English
                                            </option>
                                        @endforelse
                                    </select>
                                </form>
                            @endif
                        @endif

                        @if (count(allCurrencies()?->where('status', 'active')) > 1)
                            <form action="{{ route('set-currency') }}" class="set-currency-header">
                                <select name="currency" class="modern-select change-currency">
                                    @forelse (allCurrencies()?->where('status', 'active') as $currency)
                                        <option value="{{ $currency->currency_code }}"
                                            {{ getSessionCurrency() == $currency->currency_code ? 'selected' : '' }}>
                                            {{ $currency->currency_name }}
                                        </option>
                                    @empty
                                        <option value="USD" {{ getSessionCurrency() == 'USD' ? 'selected' : '' }}>
                                            {{ __('USD') }}
                                        </option>
                                    @endforelse
                                </select>
                            </form>
                        @endif
                    </div>
                </div>

                <!-- Center - Compact Search Bar -->
                <div class="navbar-center">
                    <div class="compact-search-container">
                        <button class="search-toggle-btn" id="searchToggleBtn">
                            <i class="fas fa-search"></i>
                        </button>
                        <div class="search-input-wrapper" id="searchInputWrapper">
                            <input type="text" id="search_menu" class="compact-search-input"
                                placeholder="{{ __('Search...') }}">
                            <button class="search-close-btn" id="searchCloseBtn">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div id="admin_menu_list" class="compact-search-dropdown d-none">
                            @foreach (adminSearchRouteList() as $route_item)
                                @if (checkAdminHasPermission($route_item?->permission) || empty($route_item?->permission))
                                    <a @isset($route_item->tab) 
                                            data-active-tab="{{ $route_item->tab }}" class="search-item" 
                                        @else 
                                            class="search-item" 
                                        @endisset
                                        href="{{ $route_item?->route }}">
                                        <i class="fas fa-search mr-2"></i>
                                        {{ $route_item?->name }}
                                    </a>
                                @endif
                            @endforeach
                            <a class="search-item not-found-message d-none" href="javascript:;">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ __('No results found') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right side - Actions and Profile -->
                <div class="navbar-right d-flex align-items-center" style="gap: 12px;">
                    <!-- Visit Website -->
                    <div class="navbar-action-wrapper">
                        <a target="_blank" href="{{ route('home') }}" class="navbar-action-btn" title="{{ __('Visit Website') }}" data-tooltip="Visit Website">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>

                    <!-- Notifications -->
                    <div class="dropdown notification-dropdown navbar-action-wrapper">
                        <button class="navbar-action-btn notification-btn" data-toggle="dropdown" title="{{ __('Notifications') }}" data-tooltip="Notifications">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </button>
                        <div class="dropdown-menu modern-dropdown-menu notification-menu">
                            <div class="dropdown-header">
                                <h6>{{ __('Notifications') }}</h6>
                            </div>
                            <div class="dropdown-divider"></div>
                            <!-- Sample notifications -->
                            <a href="#" class="dropdown-item modern-dropdown-item">
                                <i class="fas fa-bell mr-2"></i>
                                <span>New course enrollment</span>
                            </a>
                            <a href="#" class="dropdown-item modern-dropdown-item">
                                <i class="fas fa-bell mr-2"></i>
                                <span>System update available</span>
                            </a>
                            <a href="#" class="dropdown-item modern-dropdown-item">
                                <i class="fas fa-bell mr-2"></i>
                                <span>User feedback received</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item text-center">
                                {{ __('View all notifications') }}
                            </a>
                        </div>
                    </div>

                    <!-- Enhanced User Profile Dropdown -->
                    <div class="dropdown user-dropdown">
                        <a href="#" data-toggle="dropdown" class="enhanced-user-profile-btn">
                            <div class="user-avatar-enhanced">
                                @if ($header_admin->image)
                                    <img alt="{{ $header_admin->name }}" src="{{ asset($header_admin->image) }}">
                                @else
                                    <div class="avatar-placeholder-enhanced">
                                        {{ strtoupper(substr($header_admin->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="status-indicator"></div>
                            </div>
                            <div class="user-info-enhanced d-none d-lg-block">
                                <span class="user-name-enhanced">{{ $header_admin->name }}</span>
                                <span class="user-role-enhanced">{{ __('Administrator') }}</span>
                            </div>
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                        </a>
                        <div class="dropdown-menu modern-dropdown-menu">
                            <div class="dropdown-header">
                                <div class="user-avatar-large">
                                    @if ($header_admin->image)
                                        <img alt="{{ $header_admin->name }}" src="{{ asset($header_admin->image) }}">
                                    @else
                                        <div class="avatar-placeholder">
                                            {{ strtoupper(substr($header_admin->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="user-details">
                                    <h6>{{ $header_admin->name }}</h6>
                                    <p>{{ $header_admin->email }}</p>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            @adminCan('admin.profile.view')
                                <a href="{{ route('admin.edit-profile') }}" class="dropdown-item modern-dropdown-item">
                                    <i class="fas fa-user-circle"></i>
                                    <span>{{ __('My Profile') }}</span>
                                </a>
                            @endadminCan
                            <a href="{{ route('admin.settings') }}" class="dropdown-item modern-dropdown-item">
                                <i class="fas fa-cog"></i>
                                <span>{{ __('Settings') }}</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:;" class="dropdown-item modern-dropdown-item logout-item"
                                onclick="event.preventDefault(); $('#admin-logout-form').trigger('submit');">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>{{ __('Logout') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            @if (request()->routeIs(
                    'admin.general-setting',
                    'admin.marketing-setting',
                    'admin.commission-setting',
                    'admin.crediential-setting',
                    'admin.email-configuration',
                    'admin.edit-email-template',
                    'admin.currency.*',
                    'admin.seo-setting',
                    'admin.custom-code',
                    'admin.cache-clear',
                    'admin.database-clear',
                    'admin.system-update.index',
                    'admin.addons.*',
                    'admin.admin.*',
                    'admin.languages.*',

                    'admin.role.*'))
                @include('admin.settings.sidebar')
            @else
                @include('admin.sidebar')
            @endif
            @yield('admin-content')

            {{-- Dark Mode Toggle --}}
            @include('admin.partials.dark-mode-toggle')

            <footer class="main-footer">
                <div class="footer-left">
                    {{ $setting->copyright_text }}
                </div>
                <div class="footer-right">
                    <span>{{ __('version') }}: {{ $setting->version ?? '' }}</span>
                </div>
            </footer>

        </div>
    </div>

    {{-- start admin logout form --}}
    <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    {{-- end admin logout form --}}
    @include('admin.partials.modal')
    @include('admin.partials.javascripts')
    @include('global.dynamic-js-variables')

    <!-- Modern Admin Scripts -->
    <script>
        $(document).ready(function() {
            // Sidebar toggle functionality
            $('.sidebar-toggle-btn').on('click', function() {
                $('.modern-sidebar').toggleClass('show');
                $('.sidebar-overlay').toggleClass('show');
            });
            
            // Sidebar collapse functionality
            $('.sidebar-collapse-btn').on('click', function() {
                $('.modern-sidebar').toggleClass('collapsed');
                $('body').toggleClass('sidebar-mini');
                
                // Update main content area
                $('.section-body').toggleClass('sidebar-collapsed');
                $('.main-content').toggleClass('sidebar-collapsed');
                
                // Clear any inline styles that might interfere
                $('.main-content').removeAttr('style');
                $('.section-body').removeAttr('style');
                
                // Store collapse state in localStorage
                const isCollapsed = $('.modern-sidebar').hasClass('collapsed');
                localStorage.setItem('sidebarCollapsed', isCollapsed);
                
                // Trigger resize event for charts and responsive elements
                setTimeout(function() {
                    $(window).trigger('resize');
                    // Recalculate chart dimensions if any
                    if (typeof Chart !== 'undefined') {
                        Chart.helpers.each(Chart.instances, function(instance) {
                            instance.resize();
                        });
                    }
                }, 300);
            });
            
            // Restore sidebar collapse state from localStorage
            const sidebarCollapsed = localStorage.getItem('sidebarCollapsed');
            if (sidebarCollapsed === 'true') {
                $('.modern-sidebar').addClass('collapsed');
                $('body').addClass('sidebar-mini');
                $('.section-body').addClass('sidebar-collapsed');
                $('.main-content').addClass('sidebar-collapsed');
            }
            
            // Close sidebar when clicking overlay
            $('.sidebar-overlay').on('click', function() {
                $('.modern-sidebar').removeClass('show');
                $('.sidebar-overlay').removeClass('show');
            });
            
            // Close sidebar when clicking outside on mobile
            $(document).on('click', function(e) {
                if ($(window).width() <= 768) {
                    if (!$(e.target).closest('.modern-sidebar, .sidebar-toggle-btn').length) {
                        $('.modern-sidebar').removeClass('show');
                        $('.sidebar-overlay').removeClass('show');
                    }
                }
            });
            
            // Handle window resize for responsive layout
            $(window).on('resize', function() {
                const windowWidth = $(window).width();
                
                // Auto-hide sidebar on mobile
                if (windowWidth <= 768) {
                    $('.modern-sidebar').removeClass('show');
                    $('.sidebar-overlay').removeClass('show');
                    // Ensure main content takes full width on mobile
                    $('.main-content').css('padding-left', '15px');
                } else if (windowWidth <= 1024) {
                    // Tablet view adjustments
                    if (!$('body').hasClass('sidebar-mini')) {
                        $('.main-content').css('padding-left', '30px');
                    }
                } else {
                    // Desktop view - restore proper padding
                    $('.main-content').removeAttr('style');
                }
                
                // Trigger chart resize if charts exist
                setTimeout(function() {
                    if (typeof Chart !== 'undefined') {
                        Chart.helpers.each(Chart.instances, function(instance) {
                            instance.resize();
                        });
                    }
                }, 100);
            });
            
            // Initial responsive check
            $(window).trigger('resize');
        });

        // Search functionality
        $('.modern-search-input').on('focus', function() {
            $('#admin_menu_list').addClass('show');
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('.modern-search-container').length) {
                $('#admin_menu_list').removeClass('show');
            }
        });

        // Notification dropdown
        $('.notification-btn').on('click', function(e) {
            e.preventDefault();
            // Add notification functionality here
            console.log('Notification clicked');
        });
    </script>

    <script>
    // Enhanced Top Bar Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchToggleBtn = document.getElementById('searchToggleBtn');
        const searchInputWrapper = document.getElementById('searchInputWrapper');
        const searchCloseBtn = document.getElementById('searchCloseBtn');
        const searchInput = document.getElementById('search_menu');
        const searchDropdown = document.getElementById('admin_menu_list');
        
        // Toggle search input
        searchToggleBtn.addEventListener('click', function() {
            searchInputWrapper.classList.add('active');
            searchInput.focus();
        });
        
        // Close search input
        searchCloseBtn.addEventListener('click', function() {
            searchInputWrapper.classList.remove('active');
            searchInput.value = '';
            searchDropdown.classList.add('d-none');
        });
        
        // Close search when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.compact-search-container')) {
                searchInputWrapper.classList.remove('active');
                searchDropdown.classList.add('d-none');
            }
        });
        
        // Close search on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                searchInputWrapper.classList.remove('active');
                searchInput.value = '';
                searchDropdown.classList.add('d-none');
            }
        });
        
        // Enhanced search functionality
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase().trim();
                const searchItems = searchDropdown.querySelectorAll('.search-item:not(.not-found-message)');
                const notFoundMessage = searchDropdown.querySelector('.not-found-message');
                let hasResults = false;
                
                if (query.length > 0) {
                    searchDropdown.classList.remove('d-none');
                    
                    searchItems.forEach(item => {
                        const text = item.textContent.toLowerCase();
                        if (text.includes(query)) {
                            item.style.display = 'block';
                            hasResults = true;
                        } else {
                            item.style.display = 'none';
                        }
                    });
                    
                    // Show/hide not found message
                    if (hasResults) {
                        notFoundMessage.classList.add('d-none');
                    } else {
                        notFoundMessage.classList.remove('d-none');
                    }
                } else {
                    searchDropdown.classList.add('d-none');
                }
            });
        }
        
        // Enhanced dropdown animations
        const dropdowns = document.querySelectorAll('.dropdown');
        dropdowns.forEach(dropdown => {
            const toggle = dropdown.querySelector('[data-toggle="dropdown"]');
            const menu = dropdown.querySelector('.dropdown-menu');
            
            if (toggle && menu) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Close other dropdowns
                    dropdowns.forEach(otherDropdown => {
                        if (otherDropdown !== dropdown) {
                            const otherMenu = otherDropdown.querySelector('.dropdown-menu');
                            const otherToggle = otherDropdown.querySelector('[data-toggle="dropdown"]');
                            if (otherMenu) {
                                otherMenu.classList.remove('show');
                                otherToggle.setAttribute('aria-expanded', 'false');
                            }
                        }
                    });
                    
                    // Toggle current dropdown
                    const isOpen = menu.classList.contains('show');
                    if (isOpen) {
                        menu.classList.remove('show');
                        toggle.setAttribute('aria-expanded', 'false');
                    } else {
                        menu.classList.add('show');
                        toggle.setAttribute('aria-expanded', 'true');
                    }
                });
            }
        });
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) {
                dropdowns.forEach(dropdown => {
                    const menu = dropdown.querySelector('.dropdown-menu');
                    const toggle = dropdown.querySelector('[data-toggle="dropdown"]');
                    if (menu) {
                        menu.classList.remove('show');
                        toggle.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        });
    });
    </script>

    @stack('js')

    <!-- Chat Widget -->
    @include('chat::components.chat-widget', ['isAdmin' => true])

</body>

</html>
