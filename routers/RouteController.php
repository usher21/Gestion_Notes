<?php

class RouteController
{
    private $controllers = [];
    
    public function __construct(private string $name, private array $methods = [])
    {
    }

    public function controller(string $controllerName)
    {
        $this->controllers[$controllerName];
    }
}
