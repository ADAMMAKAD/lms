<div class="modern-sidebar">
    <div class="sidebar-header">
        <h3>{{ __('Welcome') }}, {{ userAuth()->name }}</h3>
    </div>
    <div class="sidebar-menu">
        <ul>
            <li>
                <a href="{{ route('student.dashboard') }}" class="sidebar-link {{ Route::is('student.dashboard') ? 'active' : '' }}">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2zm0 0V9a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                    </svg>
                    <span>{{ __('Dashboard') }}</span>
                </a>
            </li>



            <li>
                <a href="{{ route('student.enrolled-courses') }}" class="sidebar-link {{ Route::is('student.enrolled-courses') ? 'active' : '' }}">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                    <span>{{ __('Enrolled Courses') }}</span>
                </a>
            </li>
            <!-- <li>
                <a href="{{ route('student.wishlist') }}" class="sidebar-link {{ Route::is('student.wishlist') ? 'active' : '' }}">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    <span>{{ __('Wishlist') }}</span>
                </a>
            </li> -->
            <li>
                <a href="{{ route('student.reviews.index') }}" class="sidebar-link {{ Route::is('student.reviews.index') ? 'active' : '' }}">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                    <span>{{ __('Reviews') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('student.quiz-attempts') }}" class="sidebar-link {{ Route::is('student.quiz-attempts') ? 'active' : '' }}">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                    <span>{{ __('My Quiz Attempts') }}</span>
                </a>
            </li>
        </ul>
    </div>
    
    <div class="sidebar-section">
        <h4 class="sidebar-section-title">{{ __('User') }}</h4>
        <ul>
            <li>
                <a href="{{ route('student.setting.index') }}" class="sidebar-link">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>{{ __('Profile Settings') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); $('#logout-form').trigger('submit');" class="sidebar-link logout-link">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>{{ __('Logout') }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<style>
.modern-sidebar {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
    position: static !important;
    width: 100% !important;
    height: auto !important;
    transform: none !important;
    margin-left: 0 !important;
    z-index: auto !important;
}

.sidebar-header {
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #f3f4f6;
}

.sidebar-header h3 {
    color:rgb(0, 0, 0);
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
}

.sidebar-menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-menu li {
    margin-bottom: 0.5rem;
}

.sidebar-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    border-radius: 12px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.2s ease;
    color:rgb(0, 0, 0);
}

.sidebar-link:hover {
    background: #f8fafc;
    color:rgb(0, 1, 2);
    text-decoration: none;
}

.sidebar-link.active {
    background: #3b82f6;
    color: white;
    box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
}

.sidebar-link.active:hover {
    background: #3b82f6;
    color: white;
}

.sidebar-section {
    border-top: 1px solid #f3f4f6;
    margin-top: 1.5rem;
    padding-top: 1.5rem;
}

.sidebar-section-title {
    color: #6b7280;
    font-size: 0.875rem;
    font-weight: 600;
    margin: 0 0 1rem 0;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.sidebar-section ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-section li {
    margin-bottom: 0.5rem;
}

.logout-link {
    color: #ef4444 !important;
}

.logout-link:hover {
    background: #fef2f2 !important;
    color: #dc2626 !important;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .modern-sidebar {
        margin-bottom: 1rem;
    }
}

/* Ensure sidebar stays in grid layout */
.dashboard__sidebar-wrapper {
    position: static !important;
    width: 100% !important;
    height: auto !important;
}
</style>

{{-- start admin logout form --}}
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
{{-- end admin logout form --}}
