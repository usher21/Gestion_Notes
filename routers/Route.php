<?php

namespace Router;

class Route
{
    private string $path;
    private string $action;
    
    public function __construct(string $path, string $action)
    {
        $this->path = trim($path, '/');
        $this->action = $action;
    }

    public function resolve(string $url)
    {
        $requestPath = trim($url, '/');
        $requestController = explode('/', $requestPath)[0];
        $requestFeature = explode('/', $requestPath)[1];

        $controller = explode('/', $this->path)[0];
        $feature = explode('/', $this->path)[1];
        
        if ($requestController === $controller && $requestFeature === $feature) {
            return true;
        }

        return false;
    }

    public function execute()
    {
        $params = explode('@', $this->action);
        $controller = new $params[0]();
        $method = $params[1];
        $controller->$method();
    }
}
