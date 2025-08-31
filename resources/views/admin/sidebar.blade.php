<div class="main-sidebar modern-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
                <div class="brand-logo">
                    <img class="admin_logo" src="{{ asset($setting->logo) ?? '' }}" alt="UNDP LMS">
                </div>
            </a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}" class="brand-link-sm">
                <img class="admin_logo_sm" src="{{ asset($setting->favicon) ?? '' }}" alt="UNDP">
            </a>
        </div>

        <ul class="sidebar-menu">
            @adminCan('dashboard.view')
                <li class="{{ isRoute('admin.dashboard', 'active') }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
            @endadminCan

            @if(checkAdminHasPermission('course.management') || checkAdminHasPermission('course.certificate.management') || checkAdminHasPermission('badge.management') || checkAdminHasPermission('blog.view'))
                <li class="menu-header">{{ __('Manage Contents') }}</li>

                @if (Module::isEnabled('Course') && checkAdminHasPermission('course.management'))
                    @include('course::sidebar')
                @endif

                @if (Module::isEnabled('CertificateBuilder') && checkAdminHasPermission('course.certificate.management'))
                    @include('certificatebuilder::sidebar')
                @endif

                @if (Module::isEnabled('Badges') && checkAdminHasPermission('badge.management'))
                    @include('badges::sidebar')
                @endif

                @if (Module::isEnabled('Blog'))
                    @include('blog::sidebar')
                @endif
            @endif

            {{-- Order management section removed - system is now free --}}

            @if(checkAdminHasPermission('instructor.request.list') || checkAdminHasPermission('customer.view') || checkAdminHasPermission('location.view'))
                <li class="menu-header">{{ __('Manage Users') }}</li>
                @if (
                    (Module::isEnabled('InstructorRequest') && checkAdminHasPermission('instructor.request.list')) ||
                        checkAdminHasPermission('instructor.request.setting'))
                    @include('instructorrequest::sidebar')
                @endif

                @if (Module::isEnabled('Customer') && checkAdminHasPermission('customer.view'))
                    @include('customer::sidebar')
                @endif

                @if (Module::isEnabled('Location') && checkAdminHasPermission('location.view'))
                    @include('location::sidebar')
                @endif
            @endif

            @if(checkAdminHasPermission('section.management') || checkAdminHasPermission('footer.management') || checkAdminHasPermission('brand.managemen'))
                <li class="menu-header">{{ __('Site Contents') }}</li>

                @if (Module::isEnabled('Frontend') && checkAdminHasPermission('section.management'))
                    @include('frontend::sidebar')
                @endif

                @if (Module::isEnabled('Brand') && checkAdminHasPermission('brand.management'))
                    @include('brand::sidebar')
                @endif

                @if (Module::isEnabled('FooterSetting') && checkAdminHasPermission('footer.management'))
                    @include('footersetting::sidebar')
                @endif
            @endif


            @if(checkAdminHasPermission('menu.view') || checkAdminHasPermission('page.management') || checkAdminHasPermission('social.link.management') || checkAdminHasPermission('faq.view'))
                <li class="menu-header">{{ __('Manage Website') }}</li>

                @if (Module::isEnabled('MenuBuilder') && checkAdminHasPermission('menu.view'))
                    @include('menubuilder::sidebar')
                @endif
                
                @if (Module::isEnabled('PageBuilder') && checkAdminHasPermission('page.management'))
                    @include('pagebuilder::sidebar')
                @endif

                @if (Module::isEnabled('SocialLink') && checkAdminHasPermission('social.link.management'))
                    @include('sociallink::sidebar')
                @endif

                @if (Module::isEnabled('Faq') && checkAdminHasPermission('faq.view'))
                    @include('faq::sidebar')
                @endif
            @endif

            @if(checkAdminHasPermission('setting.view') || checkAdminHasPermission('basic.payment.view') || checkAdminHasPermission('payment.view') || checkAdminHasPermission('currency.view') || checkAdminHasPermission('role.view') || checkAdminHasPermission('admin.view') || checkAdminHasPermission('addon.view'))
                <li class="menu-header">{{ __('Settings') }}</li>
                <li class="{{ isRoute('admin.settings', 'active') }}">
                    <a class="nav-link" href="{{ route('admin.settings') }}"><i class="fas fa-cog"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                </li>
            @endif

            @if(checkAdminHasPermission('newsletter.view') || checkAdminHasPermission('testimonial.view') || checkAdminHasPermission('contect.message.view'))
                <li class="menu-header">{{ __('Utility') }}</li>

                @if (Module::isEnabled('NewsLetter') && checkAdminHasPermission('newsletter.view'))
                    @include('newsletter::sidebar')
                @endif

                @if (Module::isEnabled('Testimonial') && checkAdminHasPermission('testimonial.view'))
                    @include('testimonial::sidebar')
                @endif

                @if (Module::isEnabled('ContactMessage') && checkAdminHasPermission('contect.message.view'))
                    @include('contactmessage::sidebar')
                @endif
            @endif
            <li class="nav-item dropdown {{ isRoute('admin.addon.*') ? 'active' : '' }}" id="addon_sidemenu">
                <a class="nav-link has-dropdown" data-toggle="dropdown" href="#"><i class="fas fa-gem"></i>
                    <span>{{ __('Manage Addons') }} </span>
                </a>
                <ul class="dropdown-menu addon_menu">
                    @includeIf('admin.addons')
                </ul>
            </li>
        </ul>
        <div class="sidebar-footer">
            <div class="version-info">
                <span class="version-text">v{{ $setting->version ?? '1.0.0' }}</span>
            </div>
            <button class="logout-btn" title="{{ __('Logout') }}"
                onclick="event.preventDefault(); $('#admin-logout-form').trigger('submit');">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </div>

<style>
.logout-btn {
    background: #4787ed !important;
    color: white !important;
    border: none;
    padding: 12px 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 16px;
    box-shadow: 0 2px 8px rgba(71, 135, 237, 0.3);
}

.logout-btn:hover {
    background: #3b7dd8 !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(71, 135, 237, 0.4);
}

.logout-btn:active {
    transform: translateY(0);
    box-shadow: 0 2px 6px rgba(71, 135, 237, 0.3);
}

.sidebar-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem;
    border-top: 1px solid #e5e7eb;
    margin-top: auto;
}

.version-info {
    color: #6b7280;
    font-size: 0.875rem;
}

.admin_logo {
    max-width: 120px;
    max-height: 40px;
    height: auto;
    width: auto;
    object-fit: contain;
}

.admin_logo_sm {
    max-width: 32px;
    max-height: 32px;
    height: auto;
    width: auto;
    object-fit: contain;
    border-radius: 4px;
}

.brand-logo {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.5rem;
}

.brand-link-sm {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.5rem;
}
</style>
    </aside>
</div>
