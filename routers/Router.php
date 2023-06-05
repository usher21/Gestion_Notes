<?php

namespace Router;

use Controller\Session;
use Router\Route;

class Router
{
    private $routes = [];
    private $controllers = [];

    public function get($path, $action)
    {
        $this->routes['GET'][] = new Route($path, $action);
    }

    public function post($path, $action)
    {
        $this->routes['POST'][] = new Route($path, $action);
    }

    public function controller(string $controllerName)
    {
        $this->controllers[$controllerName];
    }

    public function handleRequest($requestPath)
    {
        if ($requestPath === '/') {
            Session::init();
            $requestPath = Session::isLogged() ? ROOT_PATH['level']['list'] : ROOT_PATH['login']['view'];
        }

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
