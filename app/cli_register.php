<?php

$commands = [
    //builtin commands
    'create:migration' => 'System\Cli\CreateMigration',
    'create:controller' => 'System\Cli\CreateController',
    'run:migration'    => 'System\Cli\RunMigration',

    //custom Commands
];

return $commands;