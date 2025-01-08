<?php

// Define the root directory constant
define('ROOT_DIR', dirname(__DIR__));

//require_once '/system/helper.php';
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/core/Route.php';

use Core\Route;

define('BASE_PATH', __DIR__ . '/');

require_once 'config/route.php';

Route::dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

// Start the application
//$app = new App();