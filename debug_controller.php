<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Debugging CoursePageController Logic ===\n\n";

// Test the exact same query as in CoursePageController
$query = App\Models\Course::query();
$query->where(['is_approved' => 'approved', 'status' => 'active']);
$query->whereHas('category', function($q) {
    $q->where('status', 1);
});
$query->with(['instructor:id,name', 'enrollments', 'category.translation']);

// Add pagination like in controller
$initialCourses = $query->paginate(12);

echo "Initial Courses Query Results:\n";
echo "Total items: " . $initialCourses->total() . "\n";
echo "Per page: " . $initialCourses->perPage() . "\n";
echo "Current page: " . $initialCourses->currentPage() . "\n";
echo "Items on current page: " . $initialCourses->count() . "\n\n";

echo "Course Details:\n";
foreach($initialCourses as $course) {
    echo "- ID: {$course->id}\n";
    echo "  Title: {$course->title}\n";
    echo "  Status: {$course->status}\n";
    echo "  Approved: {$course->is_approved}\n";
    echo "  Category: {$course->category->translation->name}\n";
    echo "  Instructor: {$course->instructor->name}\n";
    echo "  Thumbnail: {$course->thumbnail}\n";
    echo "  Price: {$course->price}\n";
    echo "  Slug: {$course->slug}\n";
    echo "\n";
}

// Test categories
echo "=== Categories ===\n";
$categories = App\Models\Category::where('status', 1)
    ->whereHas('courses', function($q) {
        $q->where(['is_approved' => 'approved', 'status' => 'active']);
    })
    ->with('translation')
    ->get();

echo "Found " . $categories->count() . " categories:\n";
foreach($categories as $category) {
    echo "- {$category->translation->name} (ID: {$category->id})\n";
}

// Test languages
echo "\n=== Languages ===\n";
$languages = App\Models\Language::where('status', 1)
    ->whereHas('courses', function($q) {
        $q->where(['is_approved' => 'approved', 'status' => 'active']);
    })
    ->get();

echo "Found " . $languages->count() . " languages\n";

// Test levels
echo "\n=== Levels ===\n";
$levels = App\Models\Level::where('status', 1)
    ->whereHas('courses', function($q) {
        $q->where(['is_approved' => 'approved', 'status' => 'active']);
    })
    ->get();

echo "Found " . $levels->count() . " levels\n";