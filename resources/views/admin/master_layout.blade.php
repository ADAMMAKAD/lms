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
</head>

<body>
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

                <!-- Center - Modern Search Bar -->
                <div class="navbar-center flex-grow-1 mx-4">
                    <div class="modern-search-container">
                        <div class="search-input-wrapper">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" id="search_menu" class="modern-search-input"
                                placeholder="{{ __('Search anything...') }}">
                        </div>
                        <div id="admin_menu_list" class="modern-search-dropdown d-none">
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
                <div class="navbar-right d-flex align-items-center">
                    <!-- Visit Website -->
                    <a target="_blank" href="{{ route('home') }}" class="navbar-action-btn mr-3" title="{{ __('Visit Website') }}">
                        <i class="fas fa-external-link-alt"></i>
                    </a>

                    <!-- Notifications -->
                    <div class="dropdown notification-dropdown mr-3">
                        <button class="navbar-action-btn notification-btn" data-toggle="dropdown">
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

                    <!-- User Profile Dropdown -->
                    <div class="dropdown user-dropdown">
                        <a href="#" data-toggle="dropdown" class="user-profile-btn">
                            <div class="user-avatar">
                                @if ($header_admin->image)
                                    <img alt="{{ $header_admin->name }}" src="{{ asset($header_admin->image) }}">
                                @else
                                    <div class="avatar-placeholder">
                                        {{ strtoupper(substr($header_admin->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <div class="user-info d-none d-lg-block">
                                <span class="user-name">{{ $header_admin->name }}</span>
                                <span class="user-role">{{ __('Administrator') }}</span>
                            </div>
                            <i class="fas fa-chevron-down ml-2"></i>
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
            
            // Handle window resize
            $(window).on('resize', function() {
                if ($(window).width() > 768) {
                    $('.modern-sidebar').removeClass('show');
                    $('.sidebar-overlay').removeClass('show');
                }
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
        });
    </script>

    @stack('js')

</body>

</html>
