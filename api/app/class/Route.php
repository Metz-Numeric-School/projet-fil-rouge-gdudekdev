<?php

namespace App\Class;

class Route
{
    private $routes_id = 0;
    private $routes_departure = '';
    private $routes_destination = '';

    public function __construct($data = null)
    {
        if ($data) {
            $this->hydrate($data);
        }
    }

    private function hydrate($data)
    {
        $this->setRoutes_id($data['routes_id']);
        $this->setRoutes_departure($data['routes_departure']);
        $this->setRoutes_destination($data['routes_destination']);
    }

    public function routes_id()
    {
        return htmlspecialchars($this->routes_id);
    }

    public function setRoutes_id($routes_id)
    {
        $this->routes_id = $routes_id;
    }

    public function routes_departure()
    {
        return htmlspecialchars($this->routes_departure);
    }

    public function setRoutes_departure($routes_departure)
    {
        $this->routes_departure = $routes_departure;
    }

    public function routes_destination()
    {
        return htmlspecialchars($this->routes_destination);
    }

    public function setRoutes_destination($routes_destination)
    {
        $this->routes_destination = $routes_destination;
    }

    public function getData()
    {
        return [
            'routes_id' => $this->routes_id,
            'routes_departure' => $this->routes_departure,
            'routes_destination' => $this->routes_destination,
        ];
    }
}
