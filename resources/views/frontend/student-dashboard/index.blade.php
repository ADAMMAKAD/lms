@extends('frontend.student-dashboard.layouts.master')

@section('dashboard-contents')



    <div class="dashboard__content-wrap" style="background: transparent; padding: 0;">
        <div class="dashboard__content">
            <div class="dashboard-header" style="margin-bottom: 2rem;">
                <h1 style="color: #1f2937; font-size: 2rem; font-weight: 700; margin: 0;">{{ __('Dashboard') }}</h1>
            </div>
            
            <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
                <div class="stat-card" style="background: white; border-radius: 8px; padding: 1.25rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08); border: 1px solid #e5e7eb; transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.12)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0, 0, 0, 0.08)';">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="background: #0056d3; border-radius: 8px; padding: 0.625rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-graduation-cap" style="color: white; font-size: 1.125rem;"></i>
                        </div>
                        <div>
                            <div style="font-size: 1.75rem; font-weight: 700; color: #1f2937; margin-bottom: 0.125rem;">{{ $totalEnrolledCourses }}</div>
                            <div style="color: #6b7280; font-weight: 500; font-size: 0.8rem;">{{ __('Enrolled Courses') }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="stat-card" style="background: white; border-radius: 8px; padding: 1.25rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08); border: 1px solid #e5e7eb; transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.12)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0, 0, 0, 0.08)';">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="background: #10b981; border-radius: 8px; padding: 0.625rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-clipboard-check" style="color: white; font-size: 1.125rem;"></i>
                        </div>
                        <div>
                            <div style="font-size: 1.75rem; font-weight: 700; color: #1f2937; margin-bottom: 0.125rem;">{{ $totalQuizAttempts }}</div>
                            <div style="color: #6b7280; font-weight: 500; font-size: 0.8rem;">{{ __('Quiz Attempts') }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="stat-card" style="background: white; border-radius: 8px; padding: 1.25rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08); border: 1px solid #e5e7eb; transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.12)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0, 0, 0, 0.08)';">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="background: #f59e0b; border-radius: 8px; padding: 0.625rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-star" style="color: white; font-size: 1.125rem;"></i>
                        </div>
                        <div>
                            <div style="font-size: 1.75rem; font-weight: 700; color: #1f2937; margin-bottom: 0.125rem;">{{ $totalReviews }}</div>
                            <div style="color: #6b7280; font-weight: 500; font-size: 0.8rem;">{{ __('Reviews Given') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard__content-wrap" style="background: #ffffff; border-radius: 12px; padding: 2rem; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
        <div class="dashboard__content-title" style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
            <h4 class="title" style="color: #1f2937; font-size: 1.8rem; font-weight: 700; margin: 0;">{{ __('Available Courses') }}</h4>
            <a href="{{ route('student.enrolled-courses') }}" style="background: #282f76; color: white; padding: 0.75rem 1.25rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.875rem; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.3s ease;" onmouseover="this.style.background='#1e40af';" onmouseout="this.style.background='#282f76';">
                <i class="fas fa-list"></i>
                {{ __('View All Courses') }}
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="courses-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.25rem;">
                    @forelse($availableCourses as $course)
                        <div class="course-card" style="background: white; border-radius: 8px; overflow: hidden; border: 1px solid #e5e7eb; transition: all 0.2s ease; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.12)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0, 0, 0, 0.08)';">
                            <div class="course-thumbnail" style="height: 140px; background: linear-gradient(135deg, #0056d3 0%, #004bb5 100%); position: relative; overflow: hidden;">
                                @if($course->thumbnail)
                                    <img src="{{ asset($course->thumbnail) }}" alt="{{ $course->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: white;">
                                        <i class="fas fa-graduation-cap" style="font-size: 2.5rem; opacity: 0.8;"></i>
                                    </div>
                                @endif
                                
                                <!-- Course Level Badge -->
                                <div style="position: absolute; top: 0.5rem; left: 0.5rem; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(8px); border-radius: 12px; padding: 0.25rem 0.5rem; font-size: 0.7rem; font-weight: 600; color: #0056d3; border: 1px solid rgba(255, 255, 255, 0.3);">
                                    {{ $course->category->translation->name ?? 'General' }}
                                </div>
                            </div>
                            
                            <div class="course-content" style="padding: 1rem;">
                                <h6 style="color: #1f2937; font-weight: 600; font-size: 0.9rem; margin-bottom: 0.5rem; line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 2.6rem;">
                                    {{ $course->title }}
                                </h6>
                                
                                <div class="instructor-info" style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.75rem;">
                                    <div class="instructor-avatar" style="width: 24px; height: 24px; border-radius: 50%; overflow: hidden; border: 1px solid #e5e7eb;">
                                        <img src="{{ $course->instructor->image ? asset('uploads/users/' . $course->instructor->image) : asset('frontend/assets/images/default-avatar.png') }}" alt="{{ $course->instructor->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                    <div style="color: #6b7280; font-size: 0.75rem; font-weight: 500;">{{ $course->instructor->name }}</div>
                                </div>
                                
                                <div class="course-meta" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.75rem; font-size: 0.75rem; color: #6b7280;">
                                    <div style="display: flex; align-items: center; gap: 0.25rem;">
                                        <i class="fas fa-play-circle" style="color: #0056d3; font-size: 0.7rem;"></i>
                                        <span>{{ $course->chapterItems()->count() }} {{ __('Lessons') }}</span>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 0.25rem;">
                                        <i class="fas fa-star" style="color: #fbbf24; font-size: 0.7rem;"></i>
                                        <span>{{ number_format($course->reviews()->avg('rating') ?? 0, 1) }}</span>
                                    </div>
                                </div>
                                
                                <div class="course-footer" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                                    @if($course->price > 0)
                                        <div style="color: #0056d3; font-weight: 700; font-size: 0.9rem;">
                                            @if($course->discount > 0)
                                                <span style="text-decoration: line-through; color: #9ca3af; font-size: 0.75rem; margin-right: 0.25rem;">${{ number_format($course->price, 2) }}</span>
                                                ${{ number_format($course->price - $course->discount, 2) }}
                                            @else
                                                ${{ number_format($course->price, 2) }}
                                            @endif
                                        </div>
                                    @else
                                        <div style="color: #0056d3; font-weight: 700; font-size: 0.9rem;">{{ __('Free') }}</div>
                                    @endif
                                </div>
                                
                                <div class="course-actions">
                                     <a href="{{ route('student.learning.index', $course->slug) }}" style="width: 100%; background: #0056d3; color: white; padding: 0.625rem 0.75rem; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 0.8rem; text-align: center; transition: all 0.2s ease; display: block;" onmouseover="this.style.background='#004bb5';" onmouseout="this.style.background='#0056d3';">
                                          {{ __('Enroll Now') }}
                                      </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state" style="grid-column: 1 / -1; text-align: center; padding: 3rem 1rem; color: #6b7280;">
                            <i class="fas fa-graduation-cap" style="font-size: 4rem; color: #d1d5db; margin-bottom: 1rem;"></i>
                            <h5 style="color: #6b7280; margin-bottom: 0.5rem;">{{ __('No Courses Available') }}</h5>
                            <p style="margin-bottom: 1.5rem;">{{ __('Check back later for new courses.') }}</p>
                        </div>
                    @endforelse
                </div>
                
                @if($availableCourses->count() >= 6)
                    <div style="text-align: center; margin-top: 2rem;">
                        <a href="{{ route('courses') }}" style="background: #282f76; color: white; padding: 1rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.3s ease;" onmouseover="this.style.background='#1e40af';" onmouseout="this.style.background='#282f76';">
                            <i class="fas fa-search"></i>
                            {{ __('Browse All Courses') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Chat Box Widget -->
    <div class="dashboard__content-wrap" style="background: #ffffff; border-radius: 12px; padding: 2rem; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); margin-top: 2rem;">
        <div class="chat-widget-header" style="margin-bottom: 2rem; display: flex; justify-content: between; align-items: center;">
            <h4 class="title" style="color: #1f2937; font-size: 1.8rem; font-weight: 700; margin: 0; display: flex; align-items: center; gap: 0.75rem;">
                <div style="background: linear-gradient(135deg, #282f76, #1e40af); border-radius: 12px; padding: 0.75rem; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-comments" style="color: white; font-size: 1.2rem;"></i>
                </div>
                {{ __('Chat Box') }}
            </h4>
        </div>

        <div class="row">
            <!-- Communication Section -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="communication-section" style="background: #f8fafc; border-radius: 12px; padding: 1.5rem; border: 1px solid #e5e7eb; height: 100%;">
                    <div class="section-header" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem;">
                        <div style="background: linear-gradient(135deg, #10b981, #059669); border-radius: 8px; padding: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-users" style="color: white; font-size: 1rem;"></i>
                        </div>
                        <h5 style="color: #1f2937; font-weight: 600; margin: 0; font-size: 1.1rem;">{{ __('Communicate with Students') }}</h5>
                    </div>

                    <!-- Recent Messages Preview -->
                    <div class="recent-messages" style="margin-bottom: 1.5rem;">
                        <div class="message-item" style="background: white; border-radius: 8px; padding: 1rem; margin-bottom: 0.75rem; border: 1px solid #e5e7eb; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 2px 8px rgba(0, 0, 0, 0.1)';" onmouseout="this.style.boxShadow='none';">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                                <div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #f59e0b, #d97706); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user" style="color: white; font-size: 0.875rem;"></i>
                                </div>
                                <div style="flex: 1;">
                                    <div style="font-weight: 600; color: #1f2937; font-size: 0.875rem;">{{ __('Study Group Chat') }}</div>
                                    <div style="color: #6b7280; font-size: 0.75rem;">{{ __('3 new messages') }}</div>
                                </div>
                                <div style="color: #6b7280; font-size: 0.75rem;">{{ __('2 min ago') }}</div>
                            </div>
                            <div style="color: #4b5563; font-size: 0.875rem; line-height: 1.4;">{{ __('Hey everyone! Anyone up for a study session this evening?') }}</div>
                        </div>

                        <div class="message-item" style="background: white; border-radius: 8px; padding: 1rem; margin-bottom: 0.75rem; border: 1px solid #e5e7eb; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 2px 8px rgba(0, 0, 0, 0.1)';" onmouseout="this.style.boxShadow='none';">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                                <div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #8b5cf6, #7c3aed); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user" style="color: white; font-size: 0.875rem;"></i>
                                </div>
                                <div style="flex: 1;">
                                    <div style="font-weight: 600; color: #1f2937; font-size: 0.875rem;">{{ __('Sarah Johnson') }}</div>
                                    <div style="color: #6b7280; font-size: 0.75rem;">{{ __('Online') }}</div>
                                </div>
                                <div style="color: #6b7280; font-size: 0.75rem;">{{ __('5 min ago') }}</div>
                            </div>
                            <div style="color: #4b5563; font-size: 0.875rem; line-height: 1.4;">{{ __('Thanks for sharing those notes! Really helpful.') }}</div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="quick-actions" style="display: flex; gap: 0.75rem;">
                        <a href="{{ route('student.chat') }}" style="flex: 1; background: linear-gradient(135deg, #282f76, #1e40af); color: white; padding: 0.75rem 1rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.875rem; text-align: center; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 0.5rem;" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(40, 47, 118, 0.3)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                            <i class="fas fa-comment-dots"></i>
                            {{ __('Open Chat') }}
                        </a>
                        <button onclick="startNewChat()" style="background: #f8fafc; color: #282f76; padding: 0.75rem 1rem; border-radius: 8px; border: 1px solid #e5e7eb; font-weight: 600; font-size: 0.875rem; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 0.5rem;" onmouseover="this.style.background='#e5e7eb';" onmouseout="this.style.background='#f8fafc';">
                            <i class="fas fa-plus"></i>
                            {{ __('New Chat') }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Meeting Scheduling Section -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="meeting-section" style="background: #f8fafc; border-radius: 12px; padding: 1.5rem; border: 1px solid #e5e7eb; height: 100%;">
                    <div class="section-header" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem;">
                        <div style="background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 8px; padding: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-calendar-alt" style="color: white; font-size: 1rem;"></i>
                        </div>
                        <h5 style="color: #1f2937; font-weight: 600; margin: 0; font-size: 1.1rem;">{{ __('Schedule Meeting') }}</h5>
                    </div>

                    <!-- Upcoming Meetings -->
                    <div class="upcoming-meetings" style="margin-bottom: 1.5rem;">
                        <div class="meeting-item" style="background: white; border-radius: 8px; padding: 1rem; margin-bottom: 0.75rem; border: 1px solid #e5e7eb; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 2px 8px rgba(0, 0, 0, 0.1)';" onmouseout="this.style.boxShadow='none';">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                                <div style="background: linear-gradient(135deg, #10b981, #059669); border-radius: 8px; padding: 0.5rem; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-video" style="color: white; font-size: 0.875rem;"></i>
                                </div>
                                <div style="flex: 1;">
                                    <div style="font-weight: 600; color: #1f2937; font-size: 0.875rem;">{{ __('Study Group Session') }}</div>
                                    <div style="color: #6b7280; font-size: 0.75rem;">{{ __('Today at 3:00 PM') }}</div>
                                </div>
                                <div style="background: #dcfce7; color: #166534; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem; font-weight: 600;">
                                    {{ __('Soon') }}
                                </div>
                            </div>
                            <div style="color: #4b5563; font-size: 0.875rem; line-height: 1.4;">{{ __('Weekly study session with classmates') }}</div>
                        </div>

                        <div class="meeting-item" style="background: white; border-radius: 8px; padding: 1rem; margin-bottom: 0.75rem; border: 1px solid #e5e7eb; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 2px 8px rgba(0, 0, 0, 0.1)';" onmouseout="this.style.boxShadow='none';">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                                <div style="background: linear-gradient(135deg, #8b5cf6, #7c3aed); border-radius: 8px; padding: 0.5rem; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-users" style="color: white; font-size: 0.875rem;"></i>
                                </div>
                                <div style="flex: 1;">
                                    <div style="font-weight: 600; color: #1f2937; font-size: 0.875rem;">{{ __('Project Discussion') }}</div>
                                    <div style="color: #6b7280; font-size: 0.75rem;">{{ __('Tomorrow at 10:00 AM') }}</div>
                                </div>
                                <div style="background: #fef3c7; color: #92400e; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem; font-weight: 600;">
                                    {{ __('Tomorrow') }}
                                </div>
                            </div>
                            <div style="color: #4b5563; font-size: 0.875rem; line-height: 1.4;">{{ __('Team meeting for final project') }}</div>
                        </div>
                    </div>

                    <!-- Meeting Actions -->
                    <div class="meeting-actions" style="display: flex; gap: 0.75rem;">
                        <a href="{{ route('student.meetings') }}" style="flex: 1; background: linear-gradient(135deg, #f59e0b, #d97706); color: white; padding: 0.75rem 1rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.875rem; text-align: center; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 0.5rem;" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(245, 158, 11, 0.3)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                            <i class="fas fa-calendar-check"></i>
                            {{ __('View All') }}
                        </a>
                        <button onclick="scheduleNewMeeting()" style="background: #f8fafc; color: #f59e0b; padding: 0.75rem 1rem; border-radius: 8px; border: 1px solid #e5e7eb; font-weight: 600; font-size: 0.875rem; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 0.5rem;" onmouseover="this.style.background='#e5e7eb';" onmouseout="this.style.background='#f8fafc';">
                            <i class="fas fa-plus"></i>
                            {{ __('Schedule') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats Row -->
        <div class="chat-stats" style="background: linear-gradient(135deg, #f8fafc, #e5e7eb); border-radius: 12px; padding: 1.5rem; margin-top: 1rem;">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div style="color: #282f76; font-size: 1.5rem; font-weight: 700; margin-bottom: 0.25rem;">12</div>
                    <div style="color: #6b7280; font-size: 0.875rem; font-weight: 500;">{{ __('Active Chats') }}</div>
                </div>
                <div class="col-md-4 text-center">
                    <div style="color: #10b981; font-size: 1.5rem; font-weight: 700; margin-bottom: 0.25rem;">3</div>
                    <div style="color: #6b7280; font-size: 0.875rem; font-weight: 500;">{{ __('Upcoming Meetings') }}</div>
                </div>
                <div class="col-md-4 text-center">
                    <div style="color: #f59e0b; font-size: 1.5rem; font-weight: 700; margin-bottom: 0.25rem;">8</div>
                    <div style="color: #6b7280; font-size: 0.875rem; font-weight: 500;">{{ __('Study Groups') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Chat Widget Functionality -->
    <script>
        function startNewChat() {
            // Show a modal or redirect to create new chat
            alert('{{ __("Starting new chat...") }}');
            // In a real implementation, this would open a modal to select students
            window.location.href = '{{ route("student.chat") }}';
        }

        function scheduleNewMeeting() {
            // Show a modal or redirect to schedule meeting
            alert('{{ __("Opening meeting scheduler...") }}');
            // In a real implementation, this would open a meeting scheduling modal
            window.location.href = '{{ route("student.meetings") }}';
        }

        // Add some interactive animations
        document.addEventListener('DOMContentLoaded', function() {
            // Add pulse animation to new message indicators
            const newMessageIndicators = document.querySelectorAll('.message-item');
            newMessageIndicators.forEach(indicator => {
                indicator.addEventListener('click', function() {
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 150);
                });
            });
        });
    </script>
@endsection
