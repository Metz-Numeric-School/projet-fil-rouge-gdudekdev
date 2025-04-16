<?php

namespace Api\Class;

use Config\Config;

class Router
{
    private $availableRoutes = [];
    private $currentRoute;
    private static $instance = null;

    private function __construct()
    {
        foreach (Config::ROUTE_CONFIG as $path => $params) {
            $this->addRoute($path, $params['method'],$params['controller']);
        }
    }
    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new self;
        }
        return self::$instance;
    }
    public function addCurrentRoute($path,$params)
    {
        $this->currentRoute = $path;
        $this->handleCurrentRoute($params);
    }
    private function addRoute($path, $method,$controller)
    {
        $this->availableRoutes[] = [
            'path' => $path,
            'method' => $method,
            'controller' => $controller,
        ];
    }
    private function handleCurrentRoute(array $params){
        foreach($this->availableRoutes as $route){
            if($route['path'] === $this->currentRoute){
                $obj = new $route['controller']($params);
                $obj->{$route['method']}();
            }
        }
    }
}
