<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$query = App\Models\Course::query();
$query->where(['is_approved' => 'approved', 'status' => 'active']);
$query->whereHas('category', function($q) {
    $q->where('status', 1);
});
$query->with(['instructor:id,name', 'enrollments', 'category.translation']);
$courses = $query->get();

echo "Found " . $courses->count() . " courses:\n";
foreach($courses as $course) {
    echo "- {$course->title} (Category: {$course->category->translation->name})\n";
}

echo "\nTotal courses in database: " . App\Models\Course::count() . "\n";
echo "Active courses: " . App\Models\Course::where('status', 'active')->count() . "\n";
echo "Approved courses: " . App\Models\Course::where('is_approved', 'approved')->count() . "\n";