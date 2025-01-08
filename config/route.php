<?php

use Core\Route;

Route::get('/home', ['Pages', 'home']);
Route::get('/about', ['HomeController', 'about']);
Route::get('/profile/{id}/{name}', ['User', 'show']);