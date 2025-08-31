@extends('frontend.student-dashboard.layouts.master')

@section('dashboard-contents')



    <div class="dashboard__content-wrap" style="background: transparent; padding: 0;">
        <div class="dashboard__content">
            <div class="dashboard-header" style="margin-bottom: 2rem;">
                <h1 style="color: #1f2937; font-size: 2rem; font-weight: 700; margin: 0;">{{ __('Dashboard') }}</h1>
            </div>
            
            <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                <div class="stat-card" style="background: white; border-radius: 16px; padding: 1.5rem; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); border: 1px solid #e5e7eb; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 30px rgba(0, 0, 0, 0.12)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0, 0, 0, 0.08)';">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border-radius: 12px; padding: 0.75rem; display: flex; align-items: center; justify-content: center;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                                <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            </svg>
                        </div>
                        <div>
                            <div style="font-size: 2rem; font-weight: 700; color: #1f2937; margin-bottom: 0.25rem;">{{ $totalEnrolledCourses }}</div>
                            <div style="color: #6b7280; font-weight: 500; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">{{ __('ENROLLED COURSES') }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="stat-card" style="background: white; border-radius: 16px; padding: 1.5rem; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); border: 1px solid #e5e7eb; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 30px rgba(0, 0, 0, 0.12)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0, 0, 0, 0.08)';">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 12px; padding: 0.75rem; display: flex; align-items: center; justify-content: center;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                                <path d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div>
                            <div style="font-size: 2rem; font-weight: 700; color: #1f2937; margin-bottom: 0.25rem;">{{ $totalQuizAttempts }}</div>
                            <div style="color: #6b7280; font-weight: 500; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">{{ __('QUIZ ATTEMPTS') }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="stat-card" style="background: white; border-radius: 16px; padding: 1.5rem; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); border: 1px solid #e5e7eb; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 30px rgba(0, 0, 0, 0.12)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0, 0, 0, 0.08)';">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 12px; padding: 0.75rem; display: flex; align-items: center; justify-content: center;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        </div>
                        <div>
                            <div style="font-size: 2rem; font-weight: 700; color: #1f2937; margin-bottom: 0.25rem;">{{ $totalReviews }}</div>
                            <div style="color: #6b7280; font-weight: 500; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">{{ __('YOUR TOTAL REVIEWS') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard__content-wrap" style="background: #ffffff; border-radius: 12px; padding: 2rem; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
        <div class="dashboard__content-title" style="margin-bottom: 2rem;">
            <h4 class="title" style="color: #1f2937; font-size: 1.8rem; font-weight: 700; margin: 0;">{{ __('Recent Learning Activity') }}</h4>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="dashboard__content-table" style="background: #ffffff; border-radius: 12px; padding: 2rem; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                    @if($recentLearningActivity && count($recentLearningActivity) > 0)
                        <div class="learning-activity-list">
                            @foreach($recentLearningActivity as $course)
                                <div class="activity-item" style="display: flex; align-items: center; padding: 1.5rem; border: 1px solid #e5e7eb; border-radius: 12px; margin-bottom: 1rem; background: #f8fafc; transition: all 0.3s ease;" onmouseover="this.style.background='#f1f5f9'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)';" onmouseout="this.style.background='#f8fafc'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                    <div class="course-thumbnail" style="flex-shrink: 0; margin-right: 1.5rem;">
                                        <img src="{{ asset($course->thumbnail) }}" alt="{{ $course->title }}" style="width: 80px; height: 60px; object-fit: cover; border-radius: 8px; border: 2px solid #e5e7eb;">
                                    </div>
                                    <div class="course-info" style="flex-grow: 1;">
                                        <h6 style="color: #1f2937; font-weight: 600; margin-bottom: 0.5rem; font-size: 1.1rem;">{{ $course->title }}</h6>
                                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.75rem;">
                                            <span style="color: #6b7280; font-size: 0.875rem; display: flex; align-items: center; gap: 0.25rem;">
                                                <i class="fas fa-user" style="color: #9ca3af;"></i>
                                                {{ $course->instructor->name ?? 'Instructor' }}
                                            </span>
                                            <span style="color: #6b7280; font-size: 0.875rem; display: flex; align-items: center; gap: 0.25rem;">
                                                <i class="fas fa-clock" style="color: #9ca3af;"></i>
                                                {{ $course->last_accessed->diffForHumans() }}
                                            </span>
                                        </div>
                                        <div class="progress-info" style="display: flex; align-items: center; gap: 1rem;">
                                            <div class="progress-bar-container" style="flex-grow: 1; background: #e5e7eb; border-radius: 10px; height: 8px; overflow: hidden;">
                                                <div class="progress-bar" style="background: linear-gradient(135deg, #10b981, #059669); height: 100%; border-radius: 10px; transition: width 0.3s ease;" data-width="{{ $course->progress_percent }}"></div>
                                                <script>document.currentScript.previousElementSibling.style.width = document.currentScript.previousElementSibling.getAttribute('data-width') + '%';</script>
                                            </div>
                                            <span style="color: #059669; font-weight: 600; font-size: 0.875rem;">{{ $course->progress_percent }}%</span>
                                        </div>
                                        <div style="color: #6b7280; font-size: 0.8rem; margin-top: 0.5rem;">
                                            {{ $course->completed_lectures }}/{{ $course->total_lectures }} {{ __('lessons completed') }}
                                        </div>
                                    </div>
                                    <div class="course-actions" style="flex-shrink: 0;">
                                        <a href="{{ route('student.learning.index', $course->slug) }}" style="background: linear-gradient(135deg, #0066cc, #004499); color: white; padding: 0.75rem 1.25rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.875rem; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(0, 102, 204, 0.3)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                            <i class="fas fa-play"></i>
                                            {{ __('Continue') }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            <div style="text-align: center; margin-top: 1.5rem;">
                                <a href="{{ route('student.enrolled-courses') }}" style="color: #0066cc; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.3s ease;" onmouseover="this.style.color='#004499';" onmouseout="this.style.color='#0066cc';">
                                    {{ __('View All Enrolled Courses') }}
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="empty-state" style="text-align: center; padding: 3rem 1rem; color: #6b7280;">
                            <i class="fas fa-graduation-cap" style="font-size: 4rem; color: #d1d5db; margin-bottom: 1rem;"></i>
                            <h5 style="color: #6b7280; margin-bottom: 0.5rem;">{{ __('No Learning Activity Yet') }}</h5>
                            <p style="margin-bottom: 1.5rem;">{{ __('Start learning to see your progress here.') }}</p>
                            <a href="{{ route('courses') }}" style="background: #0066cc; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; transition: all 0.3s ease;" onmouseover="this.style.background='#0052a3';" onmouseout="this.style.background='#0066cc';">
                                <i class="fas fa-search" style="margin-right: 0.5rem;"></i>
                                {{ __('Browse Courses') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
