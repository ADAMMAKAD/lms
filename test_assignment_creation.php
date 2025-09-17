<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Models\Course;
use App\Models\Admin;
use App\Models\CourseAssignment;

echo "=== Course Assignment Creation Test ===\n";

try {
    // Get available data
    $users = User::take(3)->get(['id', 'name', 'email']);
    $courses = Course::take(3)->get(['id', 'title']);
    $admin = Admin::first();

    echo "Available Users:\n";
    foreach ($users as $user) {
        echo "- ID: {$user->id}, Name: {$user->name}, Email: {$user->email}\n";
    }

    echo "\nAvailable Courses:\n";
    foreach ($courses as $course) {
        echo "- ID: {$course->id}, Title: {$course->title}\n";
    }

    echo "\nAdmin: ID: {$admin->id}, Name: {$admin->name}\n";

    // Find a user-course combination that doesn't exist
    $testUser = null;
    $testCourse = null;

    foreach ($users as $user) {
        foreach ($courses as $course) {
            $existing = CourseAssignment::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->first();
            
            if (!$existing) {
                $testUser = $user;
                $testCourse = $course;
                break 2;
            }
        }
    }

    if ($testUser && $testCourse) {
        echo "\nTesting assignment creation:\n";
        echo "User: {$testUser->name} (ID: {$testUser->id})\n";
        echo "Course: {$testCourse->title} (ID: {$testCourse->id})\n";

        $assignment = CourseAssignment::create([
            'user_id' => $testUser->id,
            'course_id' => $testCourse->id,
            'assigned_by' => $admin->id,
            'status' => 'assigned',
            'assigned_at' => now(),
            'notes' => 'Test assignment from script'
        ]);

        echo "✅ Assignment created successfully! ID: {$assignment->id}\n";

        // Test the getStudentAssignments functionality
        echo "\nTesting getStudentAssignments functionality:\n";
        $assignments = CourseAssignment::with(['course:id,title', 'user:id,name'])
            ->where('user_id', $testUser->id)
            ->get();

        echo "Found {$assignments->count()} assignments for {$testUser->name}:\n";
        foreach ($assignments as $assignment) {
            echo "- Course: {$assignment->course->title}, Status: {$assignment->status}\n";
        }

    } else {
        echo "\n⚠️  All user-course combinations already have assignments.\n";
        echo "Existing assignments:\n";
        $existing = CourseAssignment::with(['course:id,title', 'user:id,name'])->get();
        foreach ($existing as $assignment) {
            echo "- {$assignment->user->name} -> {$assignment->course->title} ({$assignment->status})\n";
        }
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\n=== Test Complete ===\n";