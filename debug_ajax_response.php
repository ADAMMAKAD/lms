<?php

// Debug what the AJAX endpoint is actually returning
echo "=== Debugging AJAX Response Content ===\n\n";

$url = 'http://127.0.0.1:8000/fetch-courses?page=1';
$response = file_get_contents($url);

if ($response === false) {
    echo "❌ Failed to fetch AJAX response\n";
    exit(1);
}

$data = json_decode($response, true);

if (!$data) {
    echo "❌ Invalid JSON response\n";
    exit(1);
}

echo "✓ AJAX Response Keys: " . implode(', ', array_keys($data)) . "\n";
echo "✓ Item Count: " . $data['itemCount'] . "\n";
echo "✓ Current Page: " . $data['currentPage'] . "\n";
echo "✓ Last Page: " . $data['lastPage'] . "\n\n";

echo "=== Items Content Analysis ===\n";
echo "Items length: " . strlen($data['items']) . " characters\n";

// Check if items contain HTML
if (strpos($data['items'], '<') !== false) {
    echo "✓ Items contain HTML\n";
} else {
    echo "❌ Items do not contain HTML\n";
}

// Check for course-card class
if (strpos($data['items'], 'course-card') !== false) {
    echo "✓ Items contain course-card elements\n";
} else {
    echo "❌ Items do not contain course-card elements\n";
}

// Check for specific course content
if (strpos($data['items'], 'test') !== false) {
    echo "✓ Items contain 'test' course\n";
} else {
    echo "❌ Items do not contain 'test' course\n";
}

echo "\n=== First 500 characters of items ===\n";
echo substr($data['items'], 0, 500) . "\n";

echo "\n=== Last 500 characters of items ===\n";
echo substr($data['items'], -500) . "\n";

// Check for any error messages in items
if (strpos($data['items'], 'error') !== false || strpos($data['items'], 'Error') !== false) {
    echo "\n❌ Error found in items content\n";
}

// Check for empty or whitespace-only content
if (trim($data['items']) === '') {
    echo "\n❌ Items content is empty or whitespace only\n";
} else {
    echo "\n✓ Items content is not empty\n";
}

?>