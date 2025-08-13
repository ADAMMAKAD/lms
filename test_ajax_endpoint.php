<?php

echo "=== Testing AJAX Endpoint ===\n\n";

// Test the fetch-courses endpoint
$url = 'http://127.0.0.1:8000/fetch-courses?page=1';

echo "Fetching from: {$url}\n\n";

$context = stream_context_create([
    'http' => [
        'timeout' => 10,
        'user_agent' => 'Mozilla/5.0 (compatible; Debug Script)',
        'header' => [
            'Accept: application/json',
            'X-Requested-With: XMLHttpRequest'
        ]
    ]
]);

$response = file_get_contents($url, false, $context);

if ($response === false) {
    echo "ERROR: Could not fetch the AJAX endpoint\n";
    $error = error_get_last();
    if ($error) {
        echo "Error details: {$error['message']}\n";
    }
    exit(1);
}

echo "Response received:\n";
echo "Length: " . strlen($response) . " characters\n\n";

// Try to decode JSON
$data = json_decode($response, true);

if ($data === null) {
    echo "ERROR: Response is not valid JSON\n";
    echo "Raw response (first 500 chars):\n";
    echo substr($response, 0, 500) . "\n";
} else {
    echo "JSON decoded successfully:\n";
    echo "Keys: " . implode(', ', array_keys($data)) . "\n";
    
    if (isset($data['items'])) {
        echo "Items length: " . strlen($data['items']) . " characters\n";
        
        // Check if items contain course cards
        if (strpos($data['items'], 'courses__item') !== false) {
            echo "✓ Found course items in AJAX response\n";
        } else {
            echo "✗ No course items found in AJAX response\n";
        }
        
        if (strpos($data['items'], 'No Course Found') !== false) {
            echo "✗ Found 'No Course Found' message in AJAX response\n";
        } else {
            echo "✓ No 'No Course Found' message in AJAX response\n";
        }
    }
    
    if (isset($data['itemCount'])) {
        echo "Item count: {$data['itemCount']}\n";
    }
    
    if (isset($data['lastPage'])) {
        echo "Last page: {$data['lastPage']}\n";
    }
    
    if (isset($data['currentPage'])) {
        echo "Current page: {$data['currentPage']}\n";
    }
}