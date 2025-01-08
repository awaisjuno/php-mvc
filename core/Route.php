<?php

namespace Core;

class Route
{
    private static $routes = [];

    public static function get($route, $action)
    {
        self::$routes['GET'][$route] = [
            'action' => $action,
            'middleware' => null,
        ];
        return new static;
    }

    public static function post($route, $action)
    {
        self::$routes['POST'][$route] = [
            'action' => $action,
            'middleware' => null,
        ];
        return new static;
    }

    public function middleware($middleware)
    {
        $method = array_key_last(self::$routes);
        $lastRouteKey = array_key_last(self::$routes[$method]);
        self::$routes[$method][$lastRouteKey]['middleware'] = $middleware;
    }

    public static function dispatch($method, $uri)
    {
        $uri = parse_url($uri, PHP_URL_PATH); // Strip query parameters
        $baseDir = '/colabphp';
        $uri = str_replace($baseDir, '', $uri);

        if (isset(self::$routes[$method])) {
            foreach (self::$routes[$method] as $route => $config) {
                $pattern = "@^" . preg_replace('/\{[^\/]+\}/', '([^\/]+)', $route) . "$@";
                if (preg_match($pattern, $uri, $matches)) {
                    array_shift($matches); // Remove full match
                    [$controllerName, $actionName] = $config['action'];

                    $controllerName = ucfirst(trim($controllerName));
                    $actionName = strtolower(trim($actionName));

                    $controllerFile = __DIR__ . '/../app/Controller/' . $controllerName . '.php';

                    if (file_exists($controllerFile)) {
                        require_once $controllerFile;

                        $controllerClass = 'Controller\\' . $controllerName;

                        if (class_exists($controllerClass)) {
                            $controller = new $controllerClass();

                            if (method_exists($controller, $actionName)) {
                                return call_user_func_array([$controller, $actionName], $matches);
                            } else {
                                throw new \Exception("Method $actionName not found in $controllerClass");
                            }
                        } else {
                            throw new \Exception("Controller class $controllerClass not found");
                        }
                    } else {
                        throw new \Exception("Controller file $controllerFile not found");
                    }
                }
            }
        }

        echo "404 Not Found - No route matched.<br>";
    }
}
?>