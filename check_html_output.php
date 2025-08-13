<?php

// Simple script to check what HTML is being generated
$url = 'http://127.0.0.1:8000/courses';

echo "=== Fetching HTML from {$url} ===\n\n";

$context = stream_context_create([
    'http' => [
        'timeout' => 10,
        'user_agent' => 'Mozilla/5.0 (compatible; Debug Script)'
    ]
]);

$html = file_get_contents($url, false, $context);

if ($html === false) {
    echo "ERROR: Could not fetch the page\n";
    exit(1);
}

echo "HTML Length: " . strlen($html) . " characters\n\n";

// Look for debug messages we added
if (strpos($html, 'Debug: Initial courses count') !== false) {
    echo "✓ Found debug message in HTML\n";
    
    // Extract the debug info
    preg_match('/Debug: Initial courses count: (\d+)/', $html, $matches);
    if ($matches) {
        echo "  Courses count from HTML: {$matches[1]}\n";
    }
} else {
    echo "✗ Debug message NOT found in HTML\n";
}

// Look for course cards
if (strpos($html, 'course-card') !== false) {
    echo "✓ Found course-card elements in HTML\n";
} else {
    echo "✗ No course-card elements found in HTML\n";
}

// Look for "No Course Found" message
if (strpos($html, 'No Course Found') !== false) {
    echo "✗ Found 'No Course Found' message\n";
} else {
    echo "✓ No 'No Course Found' message\n";
}

// Look for course titles
if (strpos($html, 'test') !== false) {
    echo "✓ Found course title 'test' in HTML\n";
} else {
    echo "✗ Course title 'test' NOT found in HTML\n";
}

// Check for CSS that might hide content
if (strpos($html, 'display: none') !== false) {
    echo "⚠ Found 'display: none' in HTML - content might be hidden\n";
}

if (strpos($html, 'visibility: hidden') !== false) {
    echo "⚠ Found 'visibility: hidden' in HTML - content might be hidden\n";
}

// Extract a portion around where courses should be
echo "\n=== HTML Section Around Courses ===\n";
$start = strpos($html, 'all-courses');
if ($start !== false) {
    $section = substr($html, $start, 2000);
    echo $section . "\n";
} else {
    echo "Could not find 'all-courses' section\n";
}