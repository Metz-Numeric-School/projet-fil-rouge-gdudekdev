<?php

namespace Core\Controller;

use Config\Config;

class Router
{
    private $availableRoutes = [];
    private $currentRoute;

    public function __construct()
    {
        foreach (Config::ROUTE_CONFIG as $path => $params) {
            $this->addRoute($path, \Core\Controller\RouteManager::class, $params['method']);
        }
    }
    public function addCurrentRoute($path,$params)
    {
        $this->currentRoute = $path;
        $this->handleCurrentRoute($params);
    }
    private function addRoute($path, $controller, $method)
    {
        $this->availableRoutes[] = [
            'path' => $path,
            'controller' => $controller,
            'method' => $method,
        ];
    }
    private function handleCurrentRoute(array $params){
        foreach($this->availableRoutes as $route){
            if($route['path'] === $this->currentRoute){
                $route['controller']::getInstance()->{$route['method']}($params);
            }
        }
    }
    public function getRoutes()
    {
        return $this->availableRoutes;
    }
}
