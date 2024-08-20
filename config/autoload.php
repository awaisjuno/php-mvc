<?php

spl_autoload_register(function ($class) {

    $prefixes = [
        'Lib\\' => __DIR__ . '/../system/lib/',
        'Driver' => __DIR__ . '/../system/driver',
        'System\\' => __DIR__ . '/../system/',
        'Controller\\' => __DIR__ . '/../app/Controller/',
        'Model\\' => __DIR__ . '/../app/Model/'
    ];

    // Loop through prefixes
    foreach ($prefixes as $prefix => $base_dir) {
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) === 0) {
            $relative_class = substr($class, $len);
            $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

            if (file_exists($file)) {
                require_once $file;
                return;
            }
        }
    }
});