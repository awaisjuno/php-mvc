<?php

use System\Loader;

/**
 * Global helper function to load views
 *
 * @param string $viewName
 * @param array $data
 * @return string
 */
function View($viewName, $data = [])
{
    $loader = new Loader();
    return $loader->view($viewName, $data);
}