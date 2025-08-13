@extends('frontend.instructor-dashboard.layouts.master')

@section('dashboard-contents')
    <div class="dashboard__content-wrap dashboard__content-wrap-two mb-60">
        <div class="dashboard__content-title">
            <h4 class="title">{{ __('Dashboard') }}</h4>
        </div>

        <div class="dashboard__stats-grid">
            <div class="dashboard__stat-card dashboard__stat-card--primary">
                <div class="dashboard__stat-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 14l9-5-9-5-9 5 9 5z" fill="currentColor"/>
                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" fill="currentColor"/>
                    </svg>
                </div>
                <div class="dashboard__stat-content">
                    <span class="dashboard__stat-number">{{ $totalCourses }}</span>
                    <p class="dashboard__stat-label">{{ __('Total Courses') }}</p>
                </div>
            </div>
            <div class="dashboard__stat-card dashboard__stat-card--warning">
                <div class="dashboard__stat-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="dashboard__stat-content">
                    <span class="dashboard__stat-number">{{ $totalPendingCourses }}</span>
                    <p class="dashboard__stat-label">{{ __('Pending Courses') }}</p>
                </div>
            </div>
            <div class="dashboard__stat-card dashboard__stat-card--success">
                <div class="dashboard__stat-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="dashboard__stat-content">
                    <span class="dashboard__stat-number">{{ $totalOrders }}</span>
                    <p class="dashboard__stat-label">{{ __('Total Orders') }}</p>
                </div>
            </div>
            <div class="dashboard__stat-card dashboard__stat-card--info">
                <div class="dashboard__stat-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="dashboard__stat-content">
                    <span class="dashboard__stat-number">{{ $totalPendingOrders }}</span>
                    <p class="dashboard__stat-label">{{ __('Pending Orders') }}</p>
                </div>
            </div>
            <div class="dashboard__stat-card dashboard__stat-card--primary">
                <div class="dashboard__stat-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="dashboard__stat-content">
                    <span class="dashboard__stat-number">{{ currency(userAuth()->wallet_balance) }}</span>
                    <p class="dashboard__stat-label">{{ __('Current Balance') }}</p>
                </div>
            </div>
            <div class="dashboard__stat-card dashboard__stat-card--success">
                <div class="dashboard__stat-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="dashboard__stat-content">
                    <span class="dashboard__stat-number">{{ currency($totalWithdraw) }}</span>
                    <p class="dashboard__stat-label">{{ __('Total Payout') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
