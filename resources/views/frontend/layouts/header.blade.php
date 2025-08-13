@php
    $nav_menu = menu_get_by_slug('nav-menu');
    $categories = \Modules\Course\app\Models\CourseCategory::with('translation')
        ->where('status', 1)
        ->whereNull('parent_id')
        ->get();
@endphp
<!-- header-area -->
<header>
    @if ($setting?->header_topbar_status == 'active')
        <div class="tg-header__top">
            <div class="container custom-container xl_container">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="tg-header__top-info list-wrap">
                            @if ($setting?->site_address)
                                <li><img src="{{ asset('frontend/img/icons/map_marker.svg') }}" alt="Icon">
                                    <span style="color: #333; font-weight: 500;">{{ $setting?->site_address }}</span>
                                </li>
                            @endif
                            @if ($setting?->site_email)
                                <li><img src="{{ asset('frontend/img/icons/envelope.svg') }}" alt="Icon"> <a
                                        href="mailto:{{ $setting?->site_email }}" style="color: #0066cc; font-weight: 500; text-decoration: none;">{{ $setting?->site_email }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="tg-header__top-right">
                            @if ($setting?->header_social_status == 'active')
                                <ul class="tg-header__top-social list-wrap">
                                    <li style="color: #333; font-weight: 500;">{{ __('Follow Us On') }} :</li>
                                    @foreach (getSocialLinks() as $socialLink)
                                        <li class="header-social">
                                            <a href="{{ $socialLink->link }}" target="_blank">
                                                <img src="{{ asset($socialLink->icon) }}" alt="img">
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="header_language_area d-flex flex-wrap d-none d-xl-flex">

                                <ul>
                                    <li>
                                        @if (count(allLanguages()?->where('status', 1)) > 1)
                                            <form action="{{ route('set-language') }}" id="setLanguageHeader">
                                                <select name="code" class="select_js">
                                                    @forelse (allLanguages()?->where('status', 1) as $language)
                                                        <option value="{{ $language->code }}"
                                                            {{ getSessionLanguage() == $language->code ? 'selected' : '' }}>
                                                            {{ $language->name }}
                                                        </option>
                                                    @empty
                                                        <option value="en"
                                                            {{ getSessionLanguage() == 'en' ? 'selected' : '' }}>
                                                            {{ __('English') }}
                                                        </option>
                                                    @endforelse
                                                </select>
                                            </form>
                                        @endif
                                    </li>
                                    <li>
                                        @if (count(allCurrencies()?->where('status', 'active')) > 1)
                                            <form action="{{ route('set-currency') }}" class="set-currency-header"
                                                method="GET">
                                                <select name="currency" class="change-currency select_js">
                                                    @forelse (allCurrencies()?->where('status', 'active') as $currency)
                                                        <option value="{{ $currency->currency_code }}"
                                                            {{ getSessionCurrency() == $currency->currency_code ? 'selected' : '' }}>
                                                            {{ $currency->currency_name }}
                                                        </option>
                                                    @empty
                                                        <option value="USD"
                                                            {{ getSessionCurrency() == 'USD' ? 'selected' : '' }}>
                                                            {{ __('USD') }}
                                                        </option>
                                                    @endforelse
                                                </select>
                                            </form>
                                        @endif
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div id="header-fixed-height"></div>
    <div id="sticky-header" class="tg-header__area">
        <div class="container custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="tgmenu__wrap">
                        <nav class="tgmenu__nav">
                            <div class="logo">
                                <a href="{{ route('home') }}" style="text-decoration: none;">
                                    <h2 style="color: #0066cc; font-weight: 800; margin: 0; font-size: 1.8rem; letter-spacing: -0.5px;">UNDP LMS</h2>
                                </a>
                            </div>
                            <div class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-xl-flex">
                                @if ($nav_menu)
                                    <ul class="navigation" style="font-weight: 600;">
                                        @foreach ($nav_menu->menuItems as $menu)
                                            @if ($menu?->link == '/' && $setting?->show_all_homepage == 1)
                                                <li class="menu-item-has-children">
                                                    <a href="{{ url('/') }}"
                                                        title="" style="color: #333; font-weight: 600; text-decoration: none;">{{ __('Home') }}</a>
                                                    <ul class="sub-menu">
                                                        @foreach (App\Enums\ThemeList::cases() as $theme)
                                                            <li class=""><a
                                                                    href="{{ route('change-theme', $theme->value) }}"
                                                                    title="" style="color: #333; font-weight: 500;">{{ __($theme->value) }}</a></li>
                                                        @endforeach
                                                    </ul><!-- /.sub-menu -->
                                                </li>
                                            @else
                                                <li
                                                    class="{{ $menu->child && count($menu->child) ? 'menu-item-has-children' : '' }}">
                                                    <a href="{{ $menu->child && count($menu->child) ? 'javascript:;' : url($menu?->link) }}"
                                                        title="" style="color: #333; font-weight: 600; text-decoration: none;">{{ $menu?->label }}</a>
                                                    @if ($menu->child && count($menu->child))
                                                        <ul class="sub-menu">
                                                            @foreach ($menu?->child as $child)
                                                                <li class=""><a href="{{ url($child?->link) }}"
                                                                        title="" style="color: #333; font-weight: 500;">{{ $child?->label }}</a></li>
                                                            @endforeach
                                                        </ul><!-- /.sub-menu -->
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul><!-- /.menu -->
                                @endif

                            </div>
                            <div class="tgmenu__search d-none d-md-block">
                                <form action="{{ route('courses') }}" class="tgmenu__search-form">
                                    <div class="select-grp">
                                        <i class="fas fa-th-large" style="color: #0066cc; font-size: 16px;"></i>

                                        <select class="form-select select_js w_150px"
                                            aria-label="Default select example" name="main_category" style="color: #333; font-weight: 500;">
                                            <option selected disabled>{{ __('Categories') }}</option>
                                            @foreach ($categories as $category)
                                                <option @selected(request('main_category') == $category->slug) value="{{ $category->slug }}">
                                                    {{ $category?->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-grp">
                                        <input type="text" placeholder="{{ __('Search For Course') }} . . ."
                                            name="search" value="{{ request('search') }}" style="color: #333; font-weight: 500;">
                                        <button type="submit" aria-label="Search" style="background: #0066cc; border: none; color: white;"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="tgmenu__action">
                                <ul class="list-wrap">
                                    <li class="mini-cart-icon user_icon">
                                        <a href="javascript:;" class="cart-count" style="color: #0066cc; font-size: 20px; display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 50%; background: rgba(0, 102, 204, 0.1); transition: all 0.3s ease;">
                                            <i class="fas fa-user"></i>
                                        </a>
                                        <ul class="menu_user_list" style="background: white; border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                            @auth('admin')
                                                <li><a
                                                        href="{{ route('admin.dashboard') }}" style="color: #333; font-weight: 500; padding: 10px 15px; display: block; text-decoration: none;">{{ __('Admin Dashboard') }}</a>
                                                </li>
                                            @endauth
                                            @guest
                                                <li><a href="{{ route('login') }}" style="color: #333; font-weight: 500; padding: 10px 15px; display: block; text-decoration: none;">{{ __('Sign in') }}</a></li>
                                                <li><a href="{{ route('register') }}" style="color: #333; font-weight: 500; padding: 10px 15px; display: block; text-decoration: none;">{{ __('Sign Up') }}</a></li>
                                            @else
                                                @if (Auth::guard('web')->user())
                                                    @if (instructorStatus() == 'approved')
                                                        <li><a
                                                                href="{{ route('instructor.dashboard') }}" style="color: #333; font-weight: 500; padding: 10px 15px; display: block; text-decoration: none;">{{ __('Instructor Dashboard') }}</a>
                                                        </li>
                                                    @endif
                                                    <li><a
                                                            href="{{ route('student.dashboard') }}" style="color: #333; font-weight: 500; padding: 10px 15px; display: block; text-decoration: none;">{{ __('Student Dashboard') }}</a>
                                                    </li>
                                                    <li><a
                                                            href="{{ userAuth()->role == 'instructor' ? route('instructor.setting.index') : route('student.setting.index') }}" style="color: #333; font-weight: 500; padding: 10px 15px; display: block; text-decoration: none;">{{ __('Profile') }}</a>
                                                    </li>
                                                    <li><a
                                                            href="{{ userAuth()->role == 'instructor' ? route('instructor.courses.index') : route('student.enrolled-courses') }}" style="color: #333; font-weight: 500; padding: 10px 15px; display: block; text-decoration: none;">{{ __('Courses') }}</a>
                                                    </li>
                                                    <li><a href=""
                                                            class="text-danger logout-btn" style="color: #dc3545; font-weight: 500; padding: 10px 15px; display: block; text-decoration: none;">{{ __('Logout') }}</a>
                                                    </li>
                                                @endif
                                            @endguest
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="mobile-nav-toggler"><i class="tg-flaticon-menu-1"></i></div>
                        </nav>
                    </div>

                    <!-- Mobile Menu  -->
                    <div class="tgmobile__menu">
                        <nav class="tgmobile__menu-box">
                            <div class="close-btn"><i class="tg-flaticon-close-1"></i></div>
                            <div class="nav-logo">
                                <a href="{{ route('home') }}" style="text-decoration: none;">
                                    <h2 style="color: #0066cc; font-weight: 800; margin: 0; font-size: 1.5rem; letter-spacing: -0.5px;">UNDP LMS</h2>
                                </a>
                            </div>

                            <div class="header_language_area d-flex flex-wrap">

                                <ul>
                                    <li>
                                        @if (count(allLanguages()?->where('status', 1)) > 1)
                                            <form action="{{ route('set-language') }}"
                                                class="change-language-header-mobile" method="GET">
                                                <select name="code" class="select_js set-language-header-mobile">
                                                    @forelse (allLanguages()?->where('status', 1) as $language)
                                                        <option value="{{ $language->code }}"
                                                            {{ getSessionLanguage() == $language->code ? 'selected' : '' }}>
                                                            {{ $language->name }}
                                                        </option>
                                                    @empty
                                                        <option value="en"
                                                            {{ getSessionLanguage() == 'en' ? 'selected' : '' }}>
                                                            {{ __('English') }}
                                                        </option>
                                                    @endforelse
                                                </select>
                                            </form>
                                        @endif
                                    </li>
                                    <li>
                                        @if (count(allCurrencies()?->where('status', 'active')) > 1)
                                            <form action="{{ route('set-currency') }}"
                                                class="change-currency-header-mobile" method="GET">
                                                <select name="currency" class="set-currency-header-mobile select_js">
                                                    @forelse (allCurrencies()?->where('status', 'active') as $currency)
                                                        <option value="{{ $currency->currency_code }}"
                                                            {{ getSessionCurrency() == $currency->currency_code ? 'selected' : '' }}>
                                                            {{ $currency->currency_name }}
                                                        </option>
                                                    @empty
                                                        <option value="USD"
                                                            {{ getSessionCurrency() == 'USD' ? 'selected' : '' }}>
                                                            {{ __('USD') }}
                                                        </option>
                                                    @endforelse
                                                </select>
                                            </form>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <ul class="mobile_menu_login d-flex flex-wrap">
                                @auth('admin')
                                    <li><a href="{{ route('admin.dashboard') }}" style="color: #333; font-weight: 600; text-decoration: none;">{{ __('Admin Dashboard') }}</a></li>
                                @endauth
                                @guest
                                    <li><a href="{{ route('login') }}" style="color: #333; font-weight: 600; text-decoration: none;">{{ __('login') }}</a></li>
                                    <li><a href="{{ route('register') }}" style="color: #333; font-weight: 600; text-decoration: none;">{{ __('register') }}</a></li>
                                @endguest

                                @auth('web')
                                    @php
                                        $user = Auth::guard('web')->user();
                                        $dashboardRoute =
                                            $user->role == 'instructor' ? 'instructor.dashboard' : 'student.dashboard';
                                        $coursesRoute =
                                            $user->role == 'instructor'
                                                ? 'instructor.courses.index'
                                                : 'student.enrolled-courses';
                                    @endphp
                                    <li><a href="{{ route($dashboardRoute) }}" style="color: #333; font-weight: 600; text-decoration: none;">{{ __('Dashboard') }}</a></li>
                                    <li><a href="{{ route($coursesRoute) }}" style="color: #333; font-weight: 600; text-decoration: none;">{{ __('Courses') }}</a></li>
                                @endauth
                            </ul>

                            <div class="tgmobile__search">
                                <form action="{{ route('courses') }}">
                                    <select class="form-select w_150px" aria-label="Default select example"
                                        name="main_category">
                                        <option selected disabled>{{ __('Categories') }}</option>
                                        @foreach ($categories as $category)
                                            <option @selected(request('main_category') == $category->slug) value="{{ $category->slug }}">
                                                {{ $category?->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" placeholder="{{ __('Search here') }}..." name="search">
                                    <button aria-label="Search"><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                            <div class="tgmobile__menu-outer">
                                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                            </div>
                            <div class="social-links">
                                @if (count(getSocialLinks()) > 0)
                                    <ul class="list-wrap">
                                        @foreach (getSocialLinks() as $socialLink)
                                            <li>
                                                <a href="{{ $socialLink->link }}" target="_blank">
                                                    <img src="{{ asset($socialLink->icon) }}" alt="img">
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </nav>
                    </div>
                    <div class="tgmobile__menu-backdrop"></div>
                    <!-- End Mobile Menu -->

                    {{-- start admin logout form --}}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    {{-- end admin logout form --}}
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-area-end -->
