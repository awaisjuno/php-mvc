<?php

namespace System;

$config = require __DIR__ . '/../config/config.php';

require  BASE_PATH . '/config/autoload.php';
require  BASE_PATH . '/config/route.php';
    
class Request {
    private $config;
    private $routes;
    private $basePath;
    private $baseUrl;

    public function __construct($config, $routes, $basePath, $baseUrl) {
        $this->config = $config;
        $this->routes = $routes;
        $this->basePath = $basePath;
        $this->baseUrl = $baseUrl;
    }

    public function matchRoute($route) {
        foreach ($this->routes as $pattern => $info) {
            $pattern = str_replace('{', '(?P<', $pattern);
            $pattern = str_replace('}', '>[^/]+)', $pattern);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $route, $matches)) {
                return [
                    'handler' => $info['handler'],
                    'params' => array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY),
                    'middleware' => $info['middleware'] ?? []
                ];
            }
        }

        return false;
    }

    public function handleMiddleware($middlewares, $request, $next) {
        $middlewareClass = 'Middleware\\' . ucfirst($middlewares);
        $classFile = $this->basePath . 'app/Middleware/' . ucfirst($middlewares) . '.php';

        if (file_exists($classFile)) {
            require_once $classFile;
        }

        if (!class_exists($middlewareClass)) {
            throw new Exception("Middleware class '$middlewareClass' not found.");
        }

        $middlewareInstance = new $middlewareClass();

        if (method_exists($middlewareInstance, 'handle')) {
            return $middlewareInstance->handle($request, $next);
        } else {
            throw new Exception("Middleware class '$middlewareClass' must have a 'handle' method.");
        }
    }

    public function handleRequest($requestUri) {
        $requestUri = trim($requestUri, '/');
        $route = str_replace(trim(parse_url($this->baseUrl, PHP_URL_PATH), '/'), '', $requestUri);
        $route = trim($route, '/');

        $route_match = $this->matchRoute($route);

        if ($route_match) {
            $route_value = $route_match['handler'];
            $params = $route_match['params'];
            $middlewares = $route_match['middleware'];

            list($controller_name, $action_name) = explode('/', $route_value);
            $controller_name = ucfirst(trim($controller_name));
            $action_name = strtolower(trim($action_name));

            $controller_file = $this->basePath . 'app/Controller/' . $controller_name . '.php';
            $controller_file = str_replace('\\', '/', $controller_file);

            if (file_exists($controller_file)) {
                require_once $controller_file;

                $controller_class = 'Controller\\' . $controller_name;

                if (class_exists($controller_class)) {
                    $controller = new $controller_class();

                    if (method_exists($controller, $action_name)) {
                        $next = function($request) use ($controller, $action_name, $params) {
                            call_user_func_array([$controller, $action_name], $params);
                        };

                        if(!$middlewares == '') {
                            $response = $this->handleMiddleware($middlewares, $_REQUEST, $next);
                        } else {
                            call_user_func_array([$controller, $action_name], $params);
                        }

                    } else {
                        echo "Action '$action_name' not found in controller '$controller_class'.<br>";
                    }

                } else {
                    echo "Controller class '$controller_class' not found.<br>";
                }

            } else {
                echo "Controller file '$controller_file' not found.<br>";
            }

        } else {
            echo "No route available.<br>";
        }
    }
}