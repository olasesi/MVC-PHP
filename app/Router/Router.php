<?php
namespace Ahmed\App\Router;

class Router
{
    protected $routes = [];

    public function get($uri, $action)
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function dispatch($uri, $method)
    {
        if (array_key_exists($method, $this->routes) && array_key_exists($uri, $this->routes[$method])) {
            $action = $this->routes[$method][$uri];

            // Check if $action is a callable (e.g., closure or array)
            if (is_callable($action)) {
                return call_user_func($action);
            } elseif (is_array($action) && count($action) == 2 && is_string($action[0]) && is_string($action[1])) {
                // Handle array format [ControllerClass::class, 'method']
                [$controllerClass, $method] = $action;

               
                if (class_exists($controllerClass)) {
                    $controllerInstance = new $controllerClass();
                    return $controllerInstance->$method();
                } else {
                    // Handle case where the controller class does not exist
                    return 'Controller class not found';
                }
            } else {
                // Handle other cases (e.g., invalid format)
                return 'Invalid route action format';
            }
        } else {
            // Handle 404
            return '404 Not Found';
        }
    }
}