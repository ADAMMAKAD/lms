@extends('frontend.student-dashboard.layouts.master')

@section('dashboard-contents')
    @if (instructorStatus() == 'pending')
        <div class="alert alert-primary d-flex align-items-center" role="alert">
            <svg 0 16 xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 16" role="img" aria-label="Warning:">
                <path 0 1 2 8
                    d="M8.982 1.566a1.13 1.13 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 .954.462.9.995l-.35 3.507a.552.552 1-1.1 0L7.1 5.995A.905.905 5zm.002 6a1 0-2z" />
                </path>
            </svg>
            <div>
                {{ __('We received your request to become instructor') }}. {{ __('Please wait for admin approval') }}!
            </div>
        </div>
    @elseif (instructorStatus() == 'rejected')
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg 0 16 xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 16" role="img"
                aria-label="Warning:">
                <path 0 1 2 8
                    d="M8.982 1.566a1.13 1.13 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 .954.462.9.995l-.35 3.507a.552.552 1-1.1 0L7.1 5.995A.905.905 5zm.002 6a1 0-2z" />
                </path>
            </svg>
            <div>
                {{ __('Your request to become instructor has been rejected. Please resubmit your request with valid information') }}
                <a href="{{ route('become-instructor') }}">{{ __('here') }}</a>
            </div>
        </div>
    @endif


    <div class="dashboard__stats-section">
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
                    <span class="dashboard__stat-number">{{ $totalEnrolledCourses }}</span>
                    <p class="dashboard__stat-label">{{ __('ENROLLED COURSES') }}</p>
                </div>
            </div>

            <div class="dashboard__stat-card dashboard__stat-card--success">
                <div class="dashboard__stat-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="dashboard__stat-content">
                    <span class="dashboard__stat-number">{{ $totalQuizAttempts }}</span>
                    <p class="dashboard__stat-label">{{ __('QUIZ ATTEMPTS') }}</p>
                </div>
            </div>

            <div class="dashboard__stat-card dashboard__stat-card--warning">
                <div class="dashboard__stat-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" fill="currentColor"/>
                    </svg>
                </div>
                <div class="dashboard__stat-content">
                    <span class="dashboard__stat-number">{{ $totalReviews }}</span>
                    <p class="dashboard__stat-label">{{ __('YOUR TOTAL REVIEWS') }}</p>
                </div>
            </div>

        </div>
    </div>

    <div class="dashboard__content-wrap" style="background: #ffffff; border-radius: 12px; padding: 2rem; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
        <div class="dashboard__content-title" style="margin-bottom: 2rem;">
            <h4 class="title" style="color: #1f2937; font-size: 1.8rem; font-weight: 700; margin: 0;">{{ __('Order History') }}</h4>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="dashboard__content-table" style="background: #ffffff; border-radius: 12px; padding: 2rem; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                    @forelse ($orders as $index => $order)
                        <div class="order-card" style="background: #ffffff; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; position: relative; overflow: hidden;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(0, 102, 204, 0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0, 0, 0, 0.1)';">
                            <div class="order-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid #e5e7eb;">
                                <div class="order-id" style="display: flex; align-items: center;">
                                    <i class="fas fa-receipt" style="color: #0066cc; margin-right: 0.5rem; font-size: 1.2rem;"></i>
                                    <span style="font-weight: 700; color: #0066cc; font-size: 1.1rem;">#{{ $order->invoice_id }}</span>
                                </div>
                                <div class="order-amount" style="background: #0066cc; color: white; padding: 0.5rem 1rem; border-radius: 8px; font-weight: 600; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                                    <i class="fas fa-dollar-sign" style="margin-right: 0.3rem;"></i>
                                    {{ $order->paid_amount }} {{ $order->payable_currency }}
                                </div>
                            </div>
                            <div class="order-details" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 1rem;">
                                <div class="detail-item" style="display: flex; align-items: center; padding: 0.75rem; background: #f8fafc; border-radius: 8px; border: 1px solid #e5e7eb;">
                                    <i class="fas fa-credit-card" style="color: #0066cc; margin-right: 0.75rem; font-size: 1rem;"></i>
                                    <div>
                                        <div style="font-size: 0.8rem; color: #6B7280; font-weight: 500; margin-bottom: 0.2rem;">{{ __('Gateway') }}</div>
                                        <div style="font-weight: 600; color: #0066cc;">{{ $order->payment_method }}</div>
                                    </div>
                                </div>
                                <div class="detail-item" style="display: flex; align-items: center; padding: 0.75rem; background: #f8fafc; border-radius: 8px; border: 1px solid #e5e7eb;">
                                    <i class="fas fa-clipboard-check" style="color: #0066cc; margin-right: 0.75rem; font-size: 1rem;"></i>
                                    <div>
                                        <div style="font-size: 0.8rem; color: #6B7280; font-weight: 500; margin-bottom: 0.2rem;">{{ __('Status') }}</div>
                                        @if ($order->status == 'completed')
                                            <span style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white; padding: 0.3rem 0.8rem; border-radius: 8px; font-size: 0.8rem; font-weight: 600; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.3);">{{ __('Completed') }}</span>
                                        @elseif($order->status == 'processing')
                                            <span style="background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%); color: white; padding: 0.3rem 0.8rem; border-radius: 8px; font-size: 0.8rem; font-weight: 600; box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);">{{ __('Processing') }}</span>
                                        @elseif($order->status == 'declined')
                                            <span style="background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%); color: white; padding: 0.3rem 0.8rem; border-radius: 8px; font-size: 0.8rem; font-weight: 600; box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3);">{{ __('Declined') }}</span>
                                        @else
                                            <span style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); color: white; padding: 0.3rem 0.8rem; border-radius: 8px; font-size: 0.8rem; font-weight: 600; box-shadow: 0 2px 4px rgba(245, 158, 11, 0.3);">{{ __('Pending') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="detail-item" style="display: flex; align-items: center; padding: 0.75rem; background: #f8fafc; border-radius: 8px; border: 1px solid #e5e7eb;">
                                    <i class="fas fa-money-check-alt" style="color: #0066cc; margin-right: 0.75rem; font-size: 1rem;"></i>
                                    <div>
                                        <div style="font-size: 0.8rem; color: #6B7280; font-weight: 500; margin-bottom: 0.2rem;">{{ __('Payment Status') }}</div>
                                        @if ($order->payment_status == 'paid')
                                            <span style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white; padding: 0.3rem 0.8rem; border-radius: 8px; font-size: 0.8rem; font-weight: 600; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.3);">{{ __('Paid') }}</span>
                                        @elseif ($order->payment_status == 'cancelled')
                                            <span style="background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%); color: white; padding: 0.3rem 0.8rem; border-radius: 8px; font-size: 0.8rem; font-weight: 600; box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3);">{{ __('Cancelled') }}</span>
                                        @else
                                            <span style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); color: white; padding: 0.3rem 0.8rem; border-radius: 8px; font-size: 0.8rem; font-weight: 600; box-shadow: 0 2px 4px rgba(245, 158, 11, 0.3);">{{ __('Pending') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="order-actions" style="display: flex; justify-content: flex-end; gap: 0.5rem; padding-top: 1rem; border-top: 1px solid #e5e7eb;">
                                <a href="{{ route('student.order.show', $order->id) }}" style="background: #0066cc; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: flex; align-items: center; transition: all 0.3s ease; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); border: none;" onmouseover="this.style.background='#0052a3'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(0, 102, 204, 0.3)';" onmouseout="this.style.background='#0066cc'; this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0, 0, 0, 0.1)';">
                                    <i class="fas fa-eye" style="margin-right: 0.5rem;"></i>
                                    {{ __('View Details') }}
                                </a>
                                @if ($order->status == 'pending')
                                    <a target="_blank" href="{{ route('payment', ['invoice_id' => $order->invoice_id]) }}" style="background: #10b981; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: flex; align-items: center; transition: all 0.3s ease; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); border: none;" onmouseover="this.style.background='#059669'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(16, 185, 129, 0.3)';" onmouseout="this.style.background='#10b981'; this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0, 0, 0, 0.1)';">
                                        <i class="fas fa-credit-card" style="margin-right: 0.5rem;"></i>
                                        {{ __('Pay Now') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="empty-state" style="text-align: center; padding: 3rem; background: #f8fafc; border-radius: 12px; border: 2px dashed #e5e7eb;">
                            <i class="fas fa-shopping-cart" style="font-size: 3rem; color: #9CA3AF; margin-bottom: 1rem;"></i>
                            <h5 style="color: #6B7280; font-weight: 600; margin-bottom: 0.5rem;">{{ __('No Orders Found') }}</h5>
                            <p style="color: #9CA3AF; margin: 0;">{{ __('You haven\'t placed any orders yet.') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
