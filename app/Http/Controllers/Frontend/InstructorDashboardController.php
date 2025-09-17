<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseChapterItem;
use App\Models\CourseProgress;
use App\Models\CourseReview;
use App\Models\QuizResult;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Carbon\Carbon;

class InstructorDashboardController extends Controller
{
    public function index(): View
    {
        $instructor = Auth::user();
        
        // Get instructor's courses
        $instructorCourses = Course::where('instructor_id', $instructor->id)
            ->where('status', 'active')
            ->get();
        
        $courseIds = $instructorCourses->pluck('id');
        
        // Calculate statistics
        $totalCourses = $instructorCourses->count();
        $totalStudents = $this->getTotalStudents($courseIds);
        $totalReviews = CourseReview::whereIn('course_id', $courseIds)->count();
        $averageRating = CourseReview::whereIn('course_id', $courseIds)->avg('rating') ?? 0;
        
        // Get recent student activity
        $recentActivity = $this->getRecentStudentActivity($courseIds);
        
        // Get analytics data
        $analyticsData = $this->getAnalyticsData($courseIds);
        
        // Get AI insights
        $aiInsights = $this->getAIInsights($courseIds, $totalStudents);
        
        return view('frontend.instructor-dashboard.index', compact(
            'totalCourses',
            'totalStudents', 
            'totalReviews',
            'averageRating',
            'recentActivity',
            'analyticsData',
            'aiInsights',
            'instructorCourses'
        ));
    }
    
    public function chat(): View
    {
        $instructor = Auth::user();
        
        // Get students from instructor's courses
        $courseIds = Course::where('instructor_id', $instructor->id)->pluck('id');
        
        // Get students who are enrolled in instructor's courses (from session)
        $enrolledStudents = collect();
        
        // Since we're using session-based enrollment, we need to get this differently
        // For now, we'll get all students as potential chat contacts
        $students = User::where('role', 'student')
            ->where('status', 'active')
            ->orderBy('name')
            ->get();
        
        return view('frontend.instructor-dashboard.chat', compact('students'));
    }
    
    public function meetings(): View
    {
        $instructor = Auth::user();
        $courseIds = Course::where('instructor_id', $instructor->id)->pluck('id');
        
        // Get real upcoming meetings from course live classes
        $upcomingMeetings = collect();
        
        // Check if CourseLiveClass model exists and get real meetings
        if (class_exists('\App\Models\CourseLiveClass')) {
            $upcomingMeetings = \App\Models\CourseLiveClass::whereHas('lesson', function($query) use ($courseIds) {
                    $query->whereHas('chapter', function($subQuery) use ($courseIds) {
                        $subQuery->whereIn('course_id', $courseIds);
                    });
                })
                ->where('start_time', '>=', Carbon::now())
                ->with(['lesson.chapter.course'])
                ->orderBy('start_time', 'asc')
                ->get()
                ->map(function($meeting) {
                    $course = $meeting->lesson->chapter->course;
                    return (object)[
                        'id' => $meeting->id,
                        'title' => 'Live Class - ' . $meeting->lesson->title,
                        'description' => 'Live class session for ' . $course->title,
                        'date' => Carbon::parse($meeting->start_time),
                        'time' => Carbon::parse($meeting->start_time)->format('H:i'),
                        'duration' => '60 minutes',
                        'attendees' => CourseProgress::where('course_id', $course->id)
                            ->distinct('user_id')
                            ->count(),
                        'meeting_url' => $meeting->join_url ?? '#',
                        'type' => 'video_call'
                    ];
                });
        }
        
        // If no real meetings found, show empty collection
        if ($upcomingMeetings->isEmpty()) {
            $upcomingMeetings = collect();
        }
        
        return view('frontend.instructor-dashboard.meetings', compact('upcomingMeetings'));
    }
    
    public function analytics(): View
    {
        $instructor = Auth::user();
        $courseIds = Course::where('instructor_id', $instructor->id)->pluck('id');
        
        // Get detailed analytics
        $analytics = $this->getDetailedAnalytics($courseIds);
        
        return view('frontend.instructor-dashboard.analytics', compact('analytics'));
    }
    
    public function aiSummary(): View
    {
        $instructor = Auth::user();
        $courseIds = Course::where('instructor_id', $instructor->id)->pluck('id');
        
        // Get AI-powered insights and summaries
        $aiSummary = $this->generateAISummary($courseIds);
        
        return view('frontend.instructor-dashboard.ai-summary', compact('aiSummary'));
    }
    
    private function getTotalStudents($courseIds)
    {
        // Get real count of students who have enrolled in instructor's courses
        return CourseProgress::whereIn('course_id', $courseIds)
            ->distinct('user_id')
            ->count();
    }
    
    private function getRecentStudentActivity($courseIds)
    {
        // Get recent student activity for instructor's courses
        $activities = CourseProgress::whereIn('course_id', $courseIds)
            ->with(['user', 'course', 'lesson'])
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function($progress) {
                $activityType = 'Started';
                if ($progress->watched) {
                    $activityType = 'Completed';
                } elseif ($progress->current_duration > 0) {
                    $activityType = 'Watching';
                }
                
                // Determine activity type for status badge
                $type = 'active'; // default
                if ($progress->watched) {
                    $type = 'completion';
                } elseif ($progress->created_at->diffInHours() <= 24) {
                    $type = 'enrollment';
                }
                
                return [
                    'student_name' => $progress->user->name,
                    'student_avatar' => $progress->user->image ? asset('uploads/users/' . $progress->user->image) : asset('frontend/assets/images/default-avatar.png'),
                    'avatar' => $progress->user->image ? asset('uploads/users/' . $progress->user->image) : asset('frontend/assets/images/default-avatar.png'),
                    'action' => $activityType,
                    'course_title' => $progress->course->title,
                    'lesson_title' => $progress->lesson->title ?? 'Course Content',
                    'time' => $progress->updated_at->diffForHumans(),
                    'type' => $type,
                    'progress_percentage' => $progress->lesson && $progress->lesson->duration > 0 
                        ? round(($progress->current_duration / $progress->lesson->duration) * 100, 1)
                        : ($progress->watched ? 100 : 0)
                ];
            });

        return $activities;
    }
    
    private function getAnalyticsData($courseIds)
    {
        // Real monthly enrollment data based on course progress creation
        $monthlyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $startOfMonth = $date->startOfMonth()->copy();
            $endOfMonth = $date->endOfMonth()->copy();
            
            // Count new enrollments (first progress entry for each user-course combination)
            $enrollments = CourseProgress::whereIn('course_id', $courseIds)
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->distinct('user_id', 'course_id')
                ->count();
            
            // Count completions (users who completed all lessons in a course)
            $completions = 0;
            foreach ($courseIds as $courseId) {
                $course = Course::find($courseId);
                if ($course) {
                    $totalLessons = $course->chapterItems()->count();
                    if ($totalLessons > 0) {
                        $usersWithProgress = CourseProgress::where('course_id', $courseId)
                            ->whereBetween('updated_at', [$startOfMonth, $endOfMonth])
                            ->where('watched', 1)
                            ->groupBy('user_id')
                            ->havingRaw('COUNT(*) >= ?', [$totalLessons])
                            ->count();
                        $completions += $usersWithProgress;
                    }
                }
            }
            
            $monthlyData[] = [
                'month' => $date->format('M Y'),
                'enrollments' => $enrollments,
                'completions' => $completions
            ];
        }
        
        // Real course performance data
        $coursePerformance = Course::whereIn('id', $courseIds)
            ->withCount(['reviews'])
            ->with(['reviews' => function($query) {
                $query->select('course_id', DB::raw('AVG(rating) as avg_rating'))
                    ->groupBy('course_id');
            }])
            ->get()
            ->map(function($course) {
                $totalLessons = $course->chapterItems()->count();
                $completionRate = 0;
                
                if ($totalLessons > 0) {
                    // Calculate real completion rate
                    $enrolledUsers = CourseProgress::where('course_id', $course->id)
                        ->distinct('user_id')
                        ->count();
                    
                    if ($enrolledUsers > 0) {
                        $completedUsers = CourseProgress::where('course_id', $course->id)
                            ->where('watched', 1)
                            ->groupBy('user_id')
                            ->havingRaw('COUNT(*) >= ?', [$totalLessons])
                            ->count();
                        
                        $completionRate = round(($completedUsers / $enrolledUsers) * 100, 1);
                    }
                }
                
                return [
                    'title' => $course->title,
                    'reviews_count' => $course->reviews_count,
                    'avg_rating' => $course->reviews->first()->avg_rating ?? 0,
                    'completion_rate' => $completionRate
                ];
            });
        
        return [
            'monthly_data' => $monthlyData,
            'course_performance' => $coursePerformance
        ];
    }
    
    private function getDetailedAnalytics($courseIds)
    {
        $analytics = $this->getAnalyticsData($courseIds);
        
        // Add required metrics for the analytics view
        $analytics['total_students'] = $this->getTotalStudents($courseIds);
        $analytics['total_courses'] = Course::whereIn('id', $courseIds)->count();
        
        // Calculate real engagement percentage based on active students
        $totalStudents = $analytics['total_students'];
        $activeStudents = CourseProgress::whereIn('course_id', $courseIds)
            ->where('updated_at', '>=', Carbon::now()->subDays(30))
            ->distinct('user_id')
            ->count();
        $analytics['avg_engagement'] = $totalStudents > 0 ? round(($activeStudents / $totalStudents) * 100, 1) : 0;
        
        $analytics['avg_rating'] = CourseReview::whereIn('course_id', $courseIds)->avg('rating') ?? 0;
        
        // Real student engagement metrics
        $analytics['student_engagement'] = [
            'daily_active' => CourseProgress::whereIn('course_id', $courseIds)
                ->where('updated_at', '>=', Carbon::now()->subDay())
                ->distinct('user_id')
                ->count(),
            'weekly_active' => CourseProgress::whereIn('course_id', $courseIds)
                ->where('updated_at', '>=', Carbon::now()->subWeek())
                ->distinct('user_id')
                ->count(),
            'monthly_active' => CourseProgress::whereIn('course_id', $courseIds)
                ->where('updated_at', '>=', Carbon::now()->subMonth())
                ->distinct('user_id')
                ->count()
        ];
        
        $analytics['quiz_performance'] = QuizResult::whereHas('quiz', function($query) use ($courseIds) {
            $query->whereIn('course_id', $courseIds);
        })->selectRaw('AVG(user_grade) as avg_score, COUNT(*) as total_attempts')
        ->first();
        
        // Real top courses data
        $analytics['top_courses'] = Course::whereIn('id', $courseIds)
            ->withCount(['reviews'])
            ->with(['reviews' => function($query) {
                $query->select('course_id', DB::raw('AVG(rating) as avg_rating'))
                    ->groupBy('course_id');
            }])
            ->limit(5)
            ->get()
            ->map(function($course) {
                // Real student count for this course
                $studentCount = CourseProgress::where('course_id', $course->id)
                    ->distinct('user_id')
                    ->count();
                
                // Real completion rate calculation
                $totalLessons = $course->chapterItems()->count();
                $completionRate = 0;
                if ($totalLessons > 0 && $studentCount > 0) {
                    $completedUsers = CourseProgress::where('course_id', $course->id)
                        ->where('watched', 1)
                        ->groupBy('user_id')
                        ->havingRaw('COUNT(*) >= ?', [$totalLessons])
                        ->count();
                    $completionRate = round(($completedUsers / $studentCount) * 100, 1);
                }
                
                return [
                    'title' => $course->title,
                    'students' => $studentCount,
                    'rating' => $course->reviews->first()->avg_rating ?? 0,
                    'completion_rate' => $completionRate
                ];
            });
        
        // Add recent activity data
        $analytics['recent_activity'] = $this->getRecentStudentActivity($courseIds)->take(5);
        
        return $analytics;
    }
    
    private function getAIInsights($courseIds, $totalStudents)
    {
        $insights = [];
        
        // Calculate real completion rates
        $courses = Course::whereIn('id', $courseIds)->get();
        $totalCompletionRate = 0;
        $courseCount = 0;
        
        foreach ($courses as $course) {
            $totalLessons = $course->chapterItems()->count();
            if ($totalLessons > 0) {
                $enrolledUsers = CourseProgress::where('course_id', $course->id)
                    ->distinct('user_id')
                    ->count();
                
                if ($enrolledUsers > 0) {
                    $completedUsers = CourseProgress::where('course_id', $course->id)
                        ->where('watched', 1)
                        ->groupBy('user_id')
                        ->havingRaw('COUNT(*) >= ?', [$totalLessons])
                        ->count();
                    
                    $completionRate = ($completedUsers / $enrolledUsers) * 100;
                    $totalCompletionRate += $completionRate;
                    $courseCount++;
                }
            }
        }
        
        $avgCompletionRate = $courseCount > 0 ? $totalCompletionRate / $courseCount : 0;
        
        // Get average rating
        $avgRating = CourseReview::whereIn('course_id', $courseIds)->avg('rating') ?? 0;
        
        // Generate insights based on real data
        if ($avgCompletionRate < 50) {
            $insights[] = [
                'type' => 'engagement',
                'title' => 'Low Completion Rate Alert',
                'description' => sprintf('Your average course completion rate is %.1f%%. Consider reviewing course structure and content difficulty.', $avgCompletionRate),
                'confidence' => 90,
                'action' => 'Review and optimize course content'
            ];
        } elseif ($avgCompletionRate > 80) {
            $insights[] = [
                'type' => 'engagement',
                'title' => 'Excellent Engagement',
                'description' => sprintf('Your courses have a high completion rate of %.1f%%. Students are highly engaged with your content.', $avgCompletionRate),
                'confidence' => 95,
                'action' => 'Maintain current quality standards'
            ];
        }
        
        if ($avgRating < 3) {
            $insights[] = [
                'type' => 'content',
                'title' => 'Content Quality Improvement Needed',
                'description' => sprintf('Your average rating is %.1f/5. Consider gathering detailed feedback to improve course quality.', $avgRating),
                'confidence' => 88,
                'action' => 'Collect and analyze student feedback'
            ];
        } elseif ($avgRating > 4.5) {
            $insights[] = [
                'type' => 'content',
                'title' => 'Outstanding Content Quality',
                'description' => sprintf('Your courses have an excellent rating of %.1f/5. Students highly value your content.', $avgRating),
                'confidence' => 95,
                'action' => 'Continue delivering high-quality content'
            ];
        }
        
        if ($totalStudents < 10) {
            $insights[] = [
                'type' => 'growth',
                'title' => 'Student Acquisition Opportunity',
                'description' => sprintf('You currently have %d students. Consider marketing strategies to expand your reach.', $totalStudents),
                'confidence' => 85,
                'action' => 'Implement marketing and promotion strategies'
            ];
        } elseif ($totalStudents > 100) {
            $insights[] = [
                'type' => 'growth',
                'title' => 'Strong Student Base',
                'description' => sprintf('You have %d students across your courses. Focus on maintaining quality and engagement.', $totalStudents),
                'confidence' => 90,
                'action' => 'Scale content delivery and support systems'
            ];
        }
        
        // If no specific insights, provide general guidance
        if (empty($insights)) {
            $insights[] = [
                'type' => 'general',
                'title' => 'Course Performance Analysis',
                'description' => sprintf('Your courses show steady performance with %.1f%% completion rate and %.1f/5 rating.', $avgCompletionRate, $avgRating),
                'confidence' => 75,
                'action' => 'Continue monitoring and optimizing based on student feedback'
            ];
        }
        
        return $insights;
    }
    
    private function generateAISummary($courseIds)
    {
        $courses = Course::whereIn('id', $courseIds)->with(['reviews'])->get();
        
        // Calculate real metrics
        $totalStudents = CourseProgress::whereIn('course_id', $courseIds)
            ->distinct('user_id')
            ->count();
        
        $overallCompletionRate = 0;
        $overallSatisfactionScore = 0;
        
        if ($courses->count() > 0) {
            $completionRates = [];
            $satisfactionScores = [];
            
            foreach ($courses as $course) {
                $totalLessons = $course->chapterItems()->count();
                if ($totalLessons > 0) {
                    $enrolledUsers = CourseProgress::where('course_id', $course->id)
                        ->distinct('user_id')
                        ->count();
                    
                    if ($enrolledUsers > 0) {
                        $completedUsers = CourseProgress::where('course_id', $course->id)
                            ->where('watched', 1)
                            ->groupBy('user_id')
                            ->havingRaw('COUNT(*) >= ?', [$totalLessons])
                            ->count();
                        
                        $completionRates[] = ($completedUsers / $enrolledUsers) * 100;
                    }
                }
                
                $avgRating = $course->reviews->avg('rating');
                if ($avgRating) {
                    $satisfactionScores[] = $avgRating;
                }
            }
            
            $overallCompletionRate = count($completionRates) > 0 ? round(array_sum($completionRates) / count($completionRates), 1) : 0;
            $overallSatisfactionScore = count($satisfactionScores) > 0 ? round(array_sum($satisfactionScores) / count($satisfactionScores), 1) : 0;
        }
        
        $summary = [
            'overview' => [
                'total_courses' => $courses->count(),
                'active_students' => $totalStudents,
                'completion_rate' => $overallCompletionRate,
                'satisfaction_score' => $overallSatisfactionScore
            ],
            'course_analysis' => $courses->map(function($course) {
                $totalLessons = $course->chapterItems()->count();
                $enrolledUsers = CourseProgress::where('course_id', $course->id)
                    ->distinct('user_id')
                    ->count();
                
                $completionRate = 0;
                if ($totalLessons > 0 && $enrolledUsers > 0) {
                    $completedUsers = CourseProgress::where('course_id', $course->id)
                        ->where('watched', 1)
                        ->groupBy('user_id')
                        ->havingRaw('COUNT(*) >= ?', [$totalLessons])
                        ->count();
                    $completionRate = round(($completedUsers / $enrolledUsers) * 100, 1);
                }
                
                $avgRating = $course->reviews->avg('rating') ?? 0;
                $score = ($completionRate + ($avgRating * 20)) / 2; // Combined score
                
                return [
                    'course_title' => $course->title,
                    'score' => round($score, 1),
                    'score_class' => $score > 80 ? 'high' : ($score > 60 ? 'medium' : 'low'),
                    'completion_rate' => $completionRate,
                    'satisfaction' => round($avgRating * 20, 1), // Convert to percentage
                    'insights' => [
                        $enrolledUsers > 0 ? "Course has {$enrolledUsers} enrolled students" : 'No students enrolled yet',
                        $completionRate > 70 ? 'High completion rate indicates good content quality' : 'Consider improving course structure for better completion',
                        $avgRating > 4 ? 'Students are highly satisfied with the course' : 'Course could benefit from content improvements'
                    ],
                    'recommendations' => [
                        $completionRate < 50 ? 'Focus on improving course engagement and structure' : 'Maintain current course quality',
                        $avgRating < 4 ? 'Gather student feedback to identify improvement areas' : 'Continue delivering high-quality content',
                        $enrolledUsers < 10 ? 'Consider marketing strategies to increase enrollment' : 'Optimize course for current student base'
                    ]
                ];
            })->toArray(),
            'recommendations' => [
                [
                    'id' => 1,
                    'priority' => $overallCompletionRate < 60 ? 'high' : 'medium',
                    'title' => 'Improve Course Engagement',
                    'description' => $overallCompletionRate < 60 ? 'Focus on increasing completion rates across courses' : 'Maintain current engagement levels'
                ],
                [
                    'id' => 2,
                    'priority' => $overallSatisfactionScore < 4 ? 'high' : 'low',
                    'title' => 'Enhance Student Satisfaction',
                    'description' => $overallSatisfactionScore < 4 ? 'Address student feedback to improve course quality' : 'Continue delivering quality content'
                ],
                [
                    'id' => 3,
                    'priority' => $totalStudents < 20 ? 'high' : 'low',
                    'title' => 'Expand Student Base',
                    'description' => $totalStudents < 20 ? 'Focus on marketing and student acquisition' : 'Optimize for current student base'
                ]
            ],
            'sentiment_score' => round($overallSatisfactionScore * 20, 1),
            'sentiment_breakdown' => [
                'positive' => $overallSatisfactionScore > 4 ? 75 : ($overallSatisfactionScore > 3 ? 60 : 40),
                'neutral' => 20,
                'negative' => $overallSatisfactionScore < 3 ? 40 : ($overallSatisfactionScore < 4 ? 20 : 5)
            ],
            'recent_feedback' => CourseReview::whereIn('course_id', $courseIds)
                ->with(['course'])
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get()
                ->map(function($review) {
                    return [
                        'sentiment' => $review->rating >= 4 ? 'positive' : ($review->rating >= 3 ? 'neutral' : 'negative'),
                        'comment' => $review->review,
                        'course' => $review->course->title
                    ];
                })->toArray(),
            'trends' => [
                "Total of {$totalStudents} students across all courses",
                "Average completion rate: {$overallCompletionRate}%",
                "Average satisfaction score: {$overallSatisfactionScore}/5",
                "Active courses: {$courses->count()}"
            ],
            'alerts' => [
                $overallCompletionRate < 50 ? 'Low completion rates detected across courses' : null,
                $overallSatisfactionScore < 3 ? 'Student satisfaction below average' : null,
                $totalStudents < 10 ? 'Low student enrollment - consider marketing efforts' : null
            ]
        ];
        
        // Remove null alerts
        $summary['alerts'] = array_filter($summary['alerts']);
        
        return $summary;
    }
}