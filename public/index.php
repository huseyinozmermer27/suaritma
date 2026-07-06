<?php

/**
 * Front Controller
 */

// Load Configuration
require_once '../config/config.php';

// Simple Autoloader
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Routing
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$parts = explode('/', $url);

// Home Route: / or empty
if (empty($parts[0])) {
    $controller = new \App\Controllers\HomeController();
    $controller->index();
}
// Chat Handler Route
elseif ($parts[0] === 'chat-handler') {
    require_once '../app/Core/includes/chat_handler.php';
    exit;
}
// Product Detail Route: /urun/[slug]
elseif ($parts[0] === 'urun' && isset($parts[1])) {
    $slug = $parts[1];
    $controller = new \App\Controllers\ProductController();
    $controller->show($slug);
} else {
    // 404
    http_response_code(404);
    echo "<h1>404 Sayfa Bulunamadı</h1>";
}

