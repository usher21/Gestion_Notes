<?php

namespace Router;

use Router\Route;

class Router
{
    private $routes = [];

    public function get($path, $action)
    {
        $this->routes['GET'][] = new Route($path, $action);
    }

    public function handleRequest($requestPath)
    {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->resolve($requestPath)) {
                $route->execute();
                return;
            }
        }
        
        http_response_code(404);
        echo "Page not found";
    }
}
