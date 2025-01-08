<?php

define('ROOT_DIR', __DIR__ . '/../../');

require_once ROOT_DIR . 'vendor/autoload.php';

$commands = require_once ROOT_DIR . 'app/cli_register.php';

if ($argc < 2) {
    echo "Usage: php cli.php [command] [arguments]\n";
    exit;
}

$command = $argv[1];
$arguments = array_slice($argv, 2);

if (isset($commands[$command])) {
    $commandClass = $commands[$command];

    $commandInstance = new $commandClass(...$arguments);

    $commandInstance->execute();
} else {
    echo "Error: Command '$command' not recognized.\n";
    echo "Available commands:\n";
    foreach ($commands as $key => $value) {
        echo " - $key\n";
    }
}