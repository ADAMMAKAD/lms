<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Blog\app\Models\Blog;
use Modules\ContactMessage\app\Models\ContactMessage;
use Modules\Language\app\Models\Language;


class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        // remove intended url from session
        $request->session()->forget('url');

        // Earnings calculations removed for free learning system
        $totalEarnings = 0;
        $thisYearsEarnings = 0;
        $thisMonthsEarnings = 0;
        $todaysEarnings = 0;

        // Get chart data for educational metrics
        $chartData = $this->getChartData($request);

        $data = [];
        $data['monthly_data'] = json_encode($chartData['monthly_data']);
        $data['user_registration_data'] = json_encode($chartData['user_registration_data']);
        $data['course_creation_data'] = json_encode($chartData['course_creation_data']);
        $data['oldestYear'] = $chartData['oldestYear'];
        $data['latestYear'] = $chartData['latestYear'];
        // Order statistics removed for free learning system
        $data['total_course'] = Course::count();
        $data['total_pending_course'] = User::where('role', 'instructor')->count();
        $data['total_users'] = User::where('role', 'user')->count();
        $data['users_online'] = User::where('updated_at', '>=', Carbon::now()->subMinutes(15))->count();
        $data['total_earning'] = $totalEarnings;
        $data['this_months_earning'] = $thisMonthsEarnings;
        $data['todays_earning'] = $todaysEarnings;
        $data['this_years_earning'] = $thisYearsEarnings;
        $data['recent_courses'] = Course::orderBy('created_at', 'desc')->limit(5)->get();
        $data['pending_courses'] = Course::where('is_approved', 'pending')->orderBy('created_at', 'desc')->count();
        $data['recent_blogs'] = Blog::orderBy('created_at', 'desc')->limit(5)->get();
        $data['pending_blogs'] = Blog::where('status', 0)->orderBy('created_at', 'desc')->count();
        $data['recent_contacts'] = ContactMessage::orderBy('created_at', 'desc')->limit(5)->get();

        // AI-based analytics data
        $data['analytics'] = $this->getAdvancedAnalytics();
        $data['learning_analytics'] = $this->getLearningAnalytics();

        return view('admin.dashboard', compact('data'));
    }

    public function setLanguage()
    {
        Cache::forget('getSocialLinks');
        
        $lang = Language::whereCode(request('code'))->first();

        if (session()->has('lang')) {
            session()->forget('lang');
            session()->forget('text_direction');
        }
        if ($lang) {
            session()->put('lang', $lang->code);
            session()->put('text_direction', $lang->direction);

            $notification = __('Language Changed Successfully');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];

            return redirect()->back()->with($notification);
        }

        session()->put('lang', config('app.locale'));

        $notification = __('Language Changed Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    private function getChartData(Request $request)
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $selectYear = $request->get('year', $currentYear);
        $selectMonth = $request->get('month', $currentMonth);

        // Get oldest and latest years from courses and users
        $oldestCourse = Course::orderBy('created_at', 'asc')->first();
        $oldestUser = User::orderBy('created_at', 'asc')->first();
        $oldestYear = $oldestCourse ? Carbon::parse($oldestCourse->created_at)->year : $currentYear;
        if ($oldestUser) {
            $oldestYear = min($oldestYear, Carbon::parse($oldestUser->created_at)->year);
        }
        $latestYear = $currentYear;

        // Monthly course enrollments (using course creation as proxy for free system)
        $monthlyData = [];
        for ($day = 1; $day <= Carbon::createFromDate($selectYear, $selectMonth)->daysInMonth; $day++) {
            $date = Carbon::createFromDate($selectYear, $selectMonth, $day)->format('Y-m-d');
            $count = Course::whereDate('created_at', $date)->count();
            $monthlyData[] = $count;
        }

        // User registration data for the year
        $userRegistrationData = [];
        for ($month = 1; $month <= 12; $month++) {
            $count = User::whereYear('created_at', $selectYear)
                        ->whereMonth('created_at', $month)
                        ->count();
            $userRegistrationData[] = $count;
        }

        // Course creation data for the year
        $courseCreationData = [];
        for ($month = 1; $month <= 12; $month++) {
            $count = Course::whereYear('created_at', $selectYear)
                          ->whereMonth('created_at', $month)
                          ->count();
            $courseCreationData[] = $count;
        }

        return [
            'monthly_data' => $monthlyData,
            'user_registration_data' => $userRegistrationData,
            'course_creation_data' => $courseCreationData,
            'oldestYear' => $oldestYear,
            'latestYear' => $latestYear,
        ];
    }

    private function getAdvancedAnalytics()
    {
        $totalUsers = User::count();
        $activeUsers = User::where('updated_at', '>=', Carbon::now()->subDays(30))->count();
        $newUsersThisMonth = User::whereMonth('created_at', Carbon::now()->month)
                                ->whereYear('created_at', Carbon::now()->year)
                                ->count();
        
        $totalCourses = Course::count();
        $activeCourses = Course::where('status', 'active')->count();
        $popularCourses = Course::withCount('progresses')
                               ->orderBy('progresses_count', 'desc')
                               ->limit(5)
                               ->get();

        return [
            'user_engagement' => $totalUsers > 0 ? round(($activeUsers / $totalUsers) * 100, 1) : 0,
            'growth_rate' => $newUsersThisMonth,
            'course_completion_rate' => 85.2, // Simulated AI prediction
            'avg_session_duration' => '24m 15s', // Simulated data
            'popular_courses' => $popularCourses,
            'learning_paths_completed' => 142, // Simulated data
            'certificates_issued' => 89, // Simulated data
        ];
    }





    private function getLearningAnalytics()
    {
        // Simulated learning analytics data
        $weeklyProgress = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $weeklyProgress[] = [
                'date' => $date->format('M d'),
                'completed_lessons' => rand(15, 45),
                'active_learners' => rand(25, 65)
            ];
        }

        return [
            'weekly_progress' => $weeklyProgress,
            'avg_completion_time' => '3.2 hours',
            'most_challenging_topics' => ['Advanced JavaScript', 'Database Design', 'API Development'],
            'learning_streaks' => [
                'longest_streak' => 21,
                'current_active_streaks' => 34
            ],
            'skill_distribution' => [
                'Beginner' => 45,
                'Intermediate' => 35,
                'Advanced' => 20
            ]
        ];
    }




}
