<?php

    // Load configuration
    $config = require __DIR__ . '/config/config.php';

    // Define constants
    define('BASE_URL', $config['base_url']);
    define('BASE_PATH', $config['base_path']);

    // Load autoload file
    require_once BASE_PATH . '/config/autoload.php';

    // Load routes
    $routes = require BASE_PATH . '/config/route.php';

    // Initialize RequestHandler
    $requestHandler = new \System\Request($config, $routes, BASE_PATH, BASE_URL);

    // Handle request
    $requestHandler->handleRequest(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

?>