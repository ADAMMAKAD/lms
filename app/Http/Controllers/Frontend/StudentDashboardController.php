<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseChapterItem;
use App\Models\CourseProgress;
use App\Models\CourseReview;
use App\Models\QuizResult;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\CertificateBuilder\app\Models\CertificateBuilder;
use Modules\CertificateBuilder\app\Models\CertificateBuilderItem;

// use Modules\Order\app\Models\Order; // Order functionality removed

class StudentDashboardController extends Controller {
    public function index(): View {
        // Since system is free, count all available courses
        $totalEnrolledCourses = Course::where('status', 'active')->count();
        $totalQuizAttempts = QuizResult::where('user_id', userAuth()->id)->count();
        $totalReviews = CourseReview::where('user_id', userAuth()->id)->count();
        
        // Get enrolled courses from session for Recent Learning Activity
        $enrolledCourseIds = session('enrollments', []);
        $recentLearningActivity = [];
        
        if (!empty($enrolledCourseIds)) {
            $recentLearningActivity = Course::select('id', 'title', 'slug', 'thumbnail', 'instructor_id')
                ->with(['instructor:id,name,image'])
                ->whereIn('id', $enrolledCourseIds)
                ->where('status', 'active')
                ->orderByDesc('id')
                ->limit(5)
                ->get()
                ->map(function($course) {
                    // Add progress information
                    $totalLectures = CourseChapterItem::whereHas('chapter', function ($q) use ($course) {
                        $q->where('course_id', $course->id);
                    })->count();
                    
                    $completedLectures = CourseProgress::where('user_id', userAuth()->id)
                        ->where('course_id', $course->id)
                        ->where('watched', 1)
                        ->count();
                    
                    $progressPercent = $totalLectures > 0 ? ($completedLectures / $totalLectures) * 100 : 0;
                    
                    $course->progress_percent = round($progressPercent, 2);
                    $course->completed_lectures = $completedLectures;
                    $course->total_lectures = $totalLectures;
                    $course->last_accessed = now(); // Simulated last access time
                    
                    return $course;
                });
        }
        
        return view('frontend.student-dashboard.index', compact(
            'totalEnrolledCourses',
            'totalQuizAttempts',
            'totalReviews',
            'recentLearningActivity'
        ));
    }

    function enrolledCourses() {
        // Since system is free, show all available courses
        $courses = Course::select('id', 'instructor_id', 'category_id', 'title', 'slug', 'thumbnail', 'price', 'discount')
            ->with([
                'instructor:id,name,image',
                'category.translation'
            ])
            ->where('status', 'active')
            ->orderByDesc('id')
            ->paginate(10);
        
        // Transform to match enrollment structure
        $enrolls = $courses->getCollection()->map(function($course) {
            return (object)['course' => $course];
        });
        $courses->setCollection($enrolls);
        $enrolls = $courses;
        return view('frontend.student-dashboard.enrolled-courses.index', compact('enrolls'));
    }

    function courseHistory() {
        // Get courses that user has started (has progress) or completed
        $courseIds = CourseProgress::where('user_id', userAuth()->id)
            ->distinct()
            ->pluck('course_id');
        
        $courses = Course::select('id', 'instructor_id', 'category_id', 'title', 'slug', 'thumbnail', 'price', 'discount')
            ->with([
                'instructor:id,name,image',
                'category.translation'
            ])
            ->whereIn('id', $courseIds)
            ->where('status', 'active')
            ->orderByDesc('id')
            ->paginate(10);
        
        // Add progress information for each course
        $coursesWithProgress = $courses->getCollection()->map(function($course) {
            $totalLectures = CourseChapterItem::whereHas('chapter', function ($q) use ($course) {
                $q->where('course_id', $course->id);
            })->count();
            
            $completedLectures = CourseProgress::where('user_id', userAuth()->id)
                ->where('course_id', $course->id)
                ->where('watched', 1)
                ->count();
            
            $progressPercent = $totalLectures > 0 ? ($completedLectures / $totalLectures) * 100 : 0;
            
            $course->progress_percent = round($progressPercent, 2);
            $course->status = $progressPercent == 100 ? 'completed' : 'in_progress';
            $course->completed_lectures = $completedLectures;
            $course->total_lectures = $totalLectures;
            
            return $course;
        });
        
        $courses->setCollection($coursesWithProgress);
        
        return view('frontend.student-dashboard.course-history.index', compact('courses'));
    }

    function quizAttempts() {
        Session::forget('course_slug');
        $quizAttempts = QuizResult::with(['quiz'])->where('user_id', userAuth()->id)->orderByDesc('id')->paginate(10);

        return view('frontend.student-dashboard.quiz-attempts.index', compact('quizAttempts'));
    }

    function downloadCertificate(string $id) {
        try {
            // Increase execution time limit for PDF generation
            set_time_limit(300); // 5 minutes
            ini_set('memory_limit', '512M');
            
            $certificate = CertificateBuilder::first();
            $certificateItems = CertificateBuilderItem::all();
            $course = Course::withTrashed()->find($id);

            $courseLectureCount = CourseChapterItem::whereHas('chapter', function ($q) use ($course) {
                $q->where('course_id', $course->id);
            })->count();

            $courseLectureCompletedByUser = CourseProgress::where('user_id', userAuth()->id)
                ->where('course_id', $course->id)->where('watched', 1)->latest();

            $completed_date = formatDate($courseLectureCompletedByUser->first()?->created_at);

            $courseLectureCompletedByUser = CourseProgress::where('user_id', userAuth()->id)
                ->where('course_id', $course->id)->where('watched', 1)->count();

            $courseCompletedPercent = $courseLectureCount > 0 ? ($courseLectureCompletedByUser / $courseLectureCount) * 100 : 0;

            if ($courseCompletedPercent != 100) {
                return redirect()->back()->with('error', 'You must complete 100% of the course to download the certificate.');
            }

            $html = view('frontend.student-dashboard.certificate.index', compact('certificateItems', 'certificate'))->render();

            $html = str_replace('[student_name]', userAuth()->name, $html);
            $html = str_replace('[platform_name]', Cache::get('setting')->app_name, $html);
            $html = str_replace('[course]', $course->title, $html);
            $html = str_replace('[date]', formatDate($completed_date), $html);
            $html = str_replace('[instructor_name]', $course->instructor->name, $html);

            // Initialize Dompdf with optimized options
            $options = new \Dompdf\Options();
            $options->set('enable_remote', false); // Disable remote resources for faster rendering
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', false);
            $options->set('defaultFont', 'Arial');
            
            $dompdf = new Dompdf($options);

            // Load HTML content
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');

            $dompdf->render();
            
            // Generate filename with course and student info
            $filename = 'certificate_' . str_replace(' ', '_', $course->title) . '_' . str_replace(' ', '_', userAuth()->name) . '.pdf';
            
            $dompdf->stream($filename);
            return;
            
        } catch (\Exception $e) {
            Log::error('Certificate generation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to generate certificate. Please try again later.');
        }
    }

    /**
     * Enroll user in a course (simplified for free system)
     */
    public function enrollCourse(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'course_id' => 'required|integer|exists:courses,id'
        ]);

        $courseId = $request->course_id;
        
        // Get the course to generate learning URL
        $course = Course::find($courseId);
        
        if (!$course || $course->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Course not found or not available'
            ], 404);
        }

        // Add course to session enrollments (simplified enrollment)
        $enrollments = session('enrollments', []);
        if (!in_array($courseId, $enrollments)) {
            $enrollments[] = $courseId;
            session(['enrollments' => $enrollments]);
        }

        // Generate learning URL
        $learningUrl = route('student.learning.index', ['slug' => $course->slug]);

        return response()->json([
            'success' => true,
            'message' => 'Successfully enrolled in course!',
            'learning_url' => $learningUrl
        ]);
    }
}
