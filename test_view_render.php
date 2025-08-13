<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Testing View Rendering ===\n\n";

// Get the same data as the controller
$categories = Modules\Course\app\Models\CourseCategory::where('status', 1)->whereNull('parent_id')->with(['translation'])->get();
$languages = Modules\Course\app\Models\CourseLanguage::where('status', 1)->get();
$levels = Modules\Course\app\Models\CourseLevel::where('status', 1)->with('translation')->get();

$query = App\Models\Course::query();
$query->where(['is_approved' => 'approved', 'status' => 'active']);
$query->whereHas('category', function($q) {
    $q->where('status', 1);
});
$query->with(['instructor:id,name', 'enrollments', 'category.translation']);
$query->orderBy('created_at', 'desc');
$initialCourses = $query->paginate(9);

echo "Data prepared:\n";
echo "- Categories: {$categories->count()}\n";
echo "- Languages: {$languages->count()}\n";
echo "- Levels: {$levels->count()}\n";
echo "- Initial Courses: {$initialCourses->count()}\n\n";

try {
    // Try to render the view
    $view = view('frontend.pages.course', compact('categories', 'languages', 'levels', 'initialCourses'));
    $html = $view->render();
    
    echo "View rendered successfully!\n";
    echo "HTML length: " . strlen($html) . " characters\n\n";
    
    // Check for our debug message
    if (strpos($html, 'DEBUG TEST') !== false) {
        echo "✓ Found DEBUG TEST message in rendered HTML\n";
        
        // Extract the debug message
        preg_match('/DEBUG TEST: Courses count = (\d+)/', $html, $matches);
        if ($matches) {
            echo "  Debug shows courses count: {$matches[1]}\n";
        }
    } else {
        echo "✗ DEBUG TEST message NOT found in rendered HTML\n";
    }
    
    // Check for course cards
    if (strpos($html, 'courses__item') !== false) {
        echo "✓ Found course item elements\n";
    } else {
        echo "✗ No course item elements found\n";
    }
    
    // Check for "No Course Found"
    if (strpos($html, 'No Course Found') !== false) {
        echo "✗ Found 'No Course Found' message\n";
    } else {
        echo "✓ No 'No Course Found' message\n";
    }
    
    // Save a portion of the HTML for inspection
    $start = strpos($html, 'all-courses-area');
    if ($start !== false) {
        $section = substr($html, $start, 3000);
        file_put_contents('debug_rendered_html.txt', $section);
        echo "\nSaved HTML section to debug_rendered_html.txt\n";
    }
    
} catch (Exception $e) {
    echo "Error rendering view: {$e->getMessage()}\n";
    echo "File: {$e->getFile()}:{$e->getLine()}\n";
    echo "Stack trace:\n{$e->getTraceAsString()}\n";
}