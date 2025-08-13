<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Course;
use Modules\Course\app\Models\CourseCategory;
use Modules\Course\app\Models\CourseLanguage;
use Modules\Course\app\Models\CourseLevel;

echo "=== DEBUGGING COURSES PAGE DATA ===\n\n";

// Test categories
$categories = CourseCategory::active()->whereNull('parent_id')->with(['translation'])->get();
echo "Categories found: " . $categories->count() . "\n";
foreach($categories as $category) {
    echo "- {$category->translation->name} (ID: {$category->id})\n";
}

// Test languages
$languages = CourseLanguage::where('status', 1)->get();
echo "\nLanguages found: " . $languages->count() . "\n";

// Test levels
$levels = CourseLevel::where('status', 1)->with('translation')->get();
echo "Levels found: " . $levels->count() . "\n";

// Test initial courses query (exactly as in controller)
$query = Course::query();
$query->where(['is_approved' => 'approved', 'status' => 'active']);
$query->whereHas('category', function($q) {
    $q->where('status', 1);
});
$query->with(['instructor:id,name', 'enrollments', 'category.translation']);
$query->orderBy('created_at', 'desc');
$initialCourses = $query->paginate(9);

echo "\nInitial courses found: " . $initialCourses->count() . "\n";
echo "Total courses: " . $initialCourses->total() . "\n";

foreach($initialCourses as $course) {
    echo "- {$course->title}\n";
    echo "  Category: {$course->category->translation->name}\n";
    echo "  Instructor: {$course->instructor->name}\n";
    echo "  Thumbnail: {$course->thumbnail}\n";
    echo "  Slug: {$course->slug}\n";
    echo "  Price: {$course->price}\n";
    echo "  Status: {$course->status}\n";
    echo "  Approved: {$course->is_approved}\n\n";
}