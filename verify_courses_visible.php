<?php

// Final verification script to check if courses are now visible
echo "=== Final Course Visibility Verification ===\n\n";

// Test the courses page HTML output
$url = 'http://127.0.0.1:8000/courses';
$html = file_get_contents($url);

if ($html === false) {
    echo "❌ Failed to fetch courses page\n";
    exit(1);
}

echo "✓ Successfully fetched courses page\n";
echo "HTML length: " . strlen($html) . " characters\n\n";

// Check for course cards
$courseCardCount = substr_count($html, 'class="course-card');
echo "Course cards found: $courseCardCount\n";

// Check for course titles
$testCourseFound = strpos($html, 'test') !== false;
echo "Test course title found: " . ($testCourseFound ? '✓ Yes' : '❌ No') . "\n";

// Check for "No Course Found" message
$noCourseMessage = strpos($html, 'No Course Found') !== false;
echo "'No Course Found' message: " . ($noCourseMessage ? '❌ Present' : '✓ Not present') . "\n";

// Check for course thumbnails
$thumbnailCount = substr_count($html, 'course-thumbnail');
echo "Course thumbnails found: $thumbnailCount\n";

// Check for course pricing
$pricingCount = substr_count($html, 'course-price');
echo "Course pricing elements found: $pricingCount\n";

// Check for visibility issues
$hiddenElements = substr_count($html, 'visibility: hidden');
echo "Hidden elements: $hiddenElements\n";

// Test AJAX endpoint one more time
echo "\n=== AJAX Endpoint Test ===\n";
$ajaxUrl = 'http://127.0.0.1:8000/fetch-courses?page=1';
$ajaxResponse = file_get_contents($ajaxUrl);

if ($ajaxResponse) {
    $data = json_decode($ajaxResponse, true);
    if ($data) {
        echo "✓ AJAX endpoint working\n";
        echo "Items returned: " . $data['itemCount'] . "\n";
        echo "Current page: " . $data['currentPage'] . "\n";
        echo "Last page: " . $data['lastPage'] . "\n";
        
        // Check if items contain course data
        if (!empty($data['items']) && strlen($data['items']) > 100) {
            echo "✓ AJAX returning course data\n";
        } else {
            echo "❌ AJAX not returning course data\n";
        }
    } else {
        echo "❌ AJAX response not valid JSON\n";
    }
} else {
    echo "❌ AJAX endpoint failed\n";
}

echo "\n=== Summary ===\n";
if ($courseCardCount > 0 || $thumbnailCount > 0) {
    echo "🎉 SUCCESS: Courses appear to be visible on the page!\n";
} else {
    echo "❌ ISSUE: Courses still not visible on the page\n";
}

?>