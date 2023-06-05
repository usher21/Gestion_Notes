<?php

namespace Router;

class Route
{
    private string $path;
    private string $action;
    private array $params;
    
    public function __construct(string $path, string $action)
    {
        $this->path = trim($path, '/');
        $this->action = $action;
    }

    public function resolve(string $url)
    {
        $requestPath = trim($url, '/');
        $requestParts = explode('/', $requestPath);
        $pathParts = explode('/', $this->path);

        if (count($requestParts) != count($pathParts)) {
            return false;
        }

        $path = preg_replace("#\{([\w]+)\}#", "([^/]+)", $this->path);

        if (preg_match("#^$path$#", $requestPath, $matches)) {
            $this->params = $matches;
            return true;
        }

        return false;
    }

    public function execute()
    {
        $actions = explode('@', $this->action);
        $controller = new $actions[0]();
        $method = $actions[1];
        
        if (isset($this->params) && isset($this->params['1'])) {
            $controller->$method($this->params[1]);
        } else {
            $controller->$method();
        }
    }
}
