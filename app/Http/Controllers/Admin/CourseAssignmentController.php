<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseAssignment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CourseAssignmentController extends Controller
{
    /**
     * Display a listing of course assignments.
     */
    public function index(Request $request): View
    {
        checkAdminHasPermissionAndThrowException('course.management');
        $query = CourseAssignment::with(['user', 'course']);
        
        // Filter by student
        if ($request->filled('student_id')) {
            $query->where('user_id', $request->student_id);
        }
        
        // Filter by course
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $assignments = $query->orderBy('created_at', 'desc')->paginate(15);
        $students = User::where('role', 'student')->get();
        $courses = Course::where('status', 'active')->get();
        
        return view('admin.course-assignments.index', compact('assignments', 'students', 'courses'));
    }
    
    /**
     * Show the form for creating a new assignment.
     */
    public function create(): View
    {
        checkAdminHasPermissionAndThrowException('course.management');
        $students = User::where('role', 'student')->get();
        $courses = Course::where('status', 'active')->get();
        
        return view('admin.course-assignments.create', compact('students', 'courses'));
    }
    
    /**
     * Store a newly created assignment.
     */
    public function store(Request $request)
    {
        checkAdminHasPermissionAndThrowException('course.management');
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'notes' => 'nullable|string|max:500'
        ]);
        
        // Check if assignment already exists
        $existingAssignment = CourseAssignment::where('user_id', $request->user_id)
            ->where('course_id', $request->course_id)
            ->first();
            
        if ($existingAssignment) {
            return response()->json([
                'status' => 'error',
                'message' => 'This course is already assigned to the selected student.'
            ]);
        }
        
        CourseAssignment::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'assigned_by' => Auth::guard('admin')->id(),
            'status' => 'assigned',
            'assigned_at' => now(),
            'notes' => $request->notes
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Course assigned successfully!',
            'redirect' => route('admin.course-assignments.index')
        ]);
    }
    
    /**
     * Update assignment status.
     */
    public function updateStatus(Request $request, CourseAssignment $assignment)
    {
        checkAdminHasPermissionAndThrowException('course.management');
        $request->validate([
            'status' => 'required|in:assigned,in_progress,completed,revoked'
        ]);
        
        $assignment->status = $request->status;
        
        if ($request->status === 'completed') {
            $assignment->completed_at = now();
        } elseif ($request->status === 'in_progress') {
            $assignment->completed_at = null;
        }
        
        $assignment->save();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Assignment status updated successfully!'
        ]);
    }
    
    /**
     * Remove the specified assignment.
     */
    public function destroy(CourseAssignment $assignment)
    {
        checkAdminHasPermissionAndThrowException('course.management');
        $assignment->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Assignment removed successfully!'
        ]);
    }
    
    /**
     * Get student's course assignments for AJAX.
     */
    public function getStudentAssignments($studentId)
    {
        checkAdminHasPermissionAndThrowException('course.management');
        $assignments = CourseAssignment::with(['course:id,title', 'user:id,name'])
            ->where('user_id', $studentId)
            ->get();
            
        return response()->json($assignments);
    }
}
