<?php

return [
    '/' => ['handler' => 'Pages/home'],
    'user' => ['handler' => 'User/show'],
    'insert' => ['handler' => 'User/insert'],
    'website' => ['handler' => 'Pages/index'],
    'home/{id}/{name}' => ['handler' => 'Pages/home', 'middleware' => 'Authenticate']
];


?>