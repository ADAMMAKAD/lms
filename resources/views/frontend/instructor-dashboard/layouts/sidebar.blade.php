<div class="instructor-sidebar">
    <div class="sidebar-header p-4 text-center" style="background: linear-gradient(135deg, #282f76,#282f76 100%);">
        <h5 class="text-white mb-0">{{ __('Instructor Panel') }}</h5>
    </div>
    
    <div class="sidebar-menu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('instructor.dashboard') ? 'active' : '' }}" 
                   href="{{ route('instructor.dashboard') }}">
                    <i class="fas fa-tachometer-alt me-3"></i>
                    <span>{{ __('Dashboard') }}</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('instructor.chat') ? 'active' : '' }}" 
                   href="{{ route('instructor.chat') }}">
                    <i class="fas fa-comments me-3"></i>
                    <span>{{ __('Chat with Students') }}</span>
                    <span class="badge bg-primary ms-auto">3</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('instructor.meetings') ? 'active' : '' }}" 
                   href="{{ route('instructor.meetings') }}">
                    <i class="fas fa-calendar-alt me-3"></i>
                    <span>{{ __('Schedule Meetings') }}</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('instructor.analytics') ? 'active' : '' }}" 
                   href="{{ route('instructor.analytics') }}">
                    <i class="fas fa-chart-line me-3"></i>
                    <span>{{ __('Analytics') }}</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('instructor.ai-summary') ? 'active' : '' }}" 
                   href="{{ route('instructor.ai-summary') }}">
                    <i class="fas fa-brain me-3"></i>
                    <span>{{ __('AI Summary') }}</span>
                    <span class="badge bg-success ms-auto">{{ __('New') }}</span>
                </a>
            </li>
            
            <li class="nav-item mt-3">
                <div class="nav-divider"></div>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('student.dashboard') }}">
                    <i class="fas fa-user-graduate me-3"></i>
                    <span>{{ __('Student View') }}</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-home me-3"></i>
                    <span>{{ __('Back to Home') }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<style>
    .instructor-sidebar .sidebar-menu {
        padding: 20px 0;
    }
    
    .instructor-sidebar .nav-link {
        padding: 15px 25px;
        color: #6c757d;
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        border: none;
        background: none;
    }
    
    .instructor-sidebar .nav-link:hover {
        background: rgba(103, 119, 239, 0.1);
        color: #282f76;
        transform: translateX(5px);
    }
    
    .instructor-sidebar .nav-link.active {
        background: linear-gradient(135deg, #282f76);
        color: white;
        border-left: 4px solid #282f76;
        box-shadow: 0 4px 15px rgba(103, 119, 239, 0.3);
    }
    
    .instructor-sidebar .nav-link.active:hover {
        transform: none;
    }
    
    .instructor-sidebar .nav-link i {
        width: 20px;
        text-align: center;
        font-size: 16px;
    }
    
    .instructor-sidebar .nav-link span {
        font-weight: 500;
        font-size: 14px;
    }
    
    .instructor-sidebar .badge {
        font-size: 11px;
        padding: 4px 8px;
        border-radius: 12px;
    }
    
    .nav-divider {
        height: 1px;
        background: #e9ecef;
        margin: 10px 25px;
    }
    
    .instructor-sidebar .nav-item:last-child .nav-link {
        margin-bottom: 0;
    }
</style>