<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Testing View Rendering ===\n\n";

// Get courses exactly like the controller
$query = App\Models\Course::query();
$query->where(['is_approved' => 'approved', 'status' => 'active']);
$query->whereHas('category', function($q) {
    $q->where('status', 1);
});
$query->with(['instructor:id,name', 'enrollments', 'category.translation']);

$initialCourses = $query->paginate(12);

echo "Courses found: " . $initialCourses->count() . "\n";
echo "Total: " . $initialCourses->total() . "\n\n";

// Test if courses collection is empty
if($initialCourses->isEmpty()) {
    echo "ERROR: Courses collection is EMPTY!\n";
} else {
    echo "SUCCESS: Courses collection has data\n";
    
    echo "\nFirst course details:\n";
    $firstCourse = $initialCourses->first();
    echo "- Title: {$firstCourse->title}\n";
    echo "- Thumbnail: {$firstCourse->thumbnail}\n";
    echo "- Price: {$firstCourse->price}\n";
    echo "- Instructor: {$firstCourse->instructor->name}\n";
    
    // Check if thumbnail file exists
    $thumbnailPath = public_path($firstCourse->thumbnail);
    if(file_exists($thumbnailPath)) {
        echo "- Thumbnail file EXISTS\n";
    } else {
        echo "- Thumbnail file MISSING: {$thumbnailPath}\n";
    }
}

// Test the course-card partial rendering logic
echo "\n=== Testing Course Card Logic ===\n";
echo "Courses variable type: " . gettype($initialCourses) . "\n";
echo "Courses count: " . $initialCourses->count() . "\n";
echo "Is collection: " . ($initialCourses instanceof \Illuminate\Pagination\LengthAwarePaginator ? 'YES' : 'NO') . "\n";

// Test iteration
echo "\nTesting iteration:\n";
$count = 0;
foreach($initialCourses as $course) {
    $count++;
    echo "Course {$count}: {$course->title}\n";
}

if($count === 0) {
    echo "ERROR: No courses in iteration!\n";
} else {
    echo "SUCCESS: {$count} courses iterated\n";
}