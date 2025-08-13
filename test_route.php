<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Testing Route Resolution ===\n\n";

// Test if the route exists and what controller it points to
$router = app('router');
$routes = $router->getRoutes();

foreach ($routes as $route) {
    if ($route->uri() === 'courses') {
        echo "Found /courses route:\n";
        echo "- URI: {$route->uri()}\n";
        echo "- Methods: " . implode(', ', $route->methods()) . "\n";
        echo "- Action: {$route->getActionName()}\n";
        echo "- Controller: " . get_class($route->getController()) . "\n";
        break;
    }
}

// Test direct controller instantiation
echo "\n=== Testing Controller Directly ===\n";
$controller = new App\Http\Controllers\Frontend\CoursePageController();

try {
    $result = $controller->index();
    echo "Controller method executed successfully\n";
    echo "View name: {$result->name()}\n";
    $data = $result->getData();
    echo "Data keys: " . implode(', ', array_keys($data)) . "\n";
    
    if (isset($data['initialCourses'])) {
        echo "Initial courses count: {$data['initialCourses']->count()}\n";
        echo "Initial courses total: {$data['initialCourses']->total()}\n";
    }
    
    if (isset($data['categories'])) {
        echo "Categories count: {$data['categories']->count()}\n";
    }
    
} catch (Exception $e) {
    echo "Error executing controller: {$e->getMessage()}\n";
    echo "File: {$e->getFile()}:{$e->getLine()}\n";
}