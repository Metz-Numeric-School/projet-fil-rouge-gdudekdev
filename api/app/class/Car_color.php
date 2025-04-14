<?php

namespace App\Class;

class Car_color
{
    private $car_colors_id = 0;
    private $car_colors_name = '';
    private $car_colors_hexa = '';

    public function __construct($data = null)
    {
        if ($data) {
            $this->hydrate($data);
        }
    }

    private function hydrate($data)
    {
        $this->setCar_colors_id($data['car_colors_id']);
        $this->setCar_colors_name($data['car_colors_name']);
        $this->setCar_colors_hexa($data['car_colors_hexa']);
    }

    public function car_colors_id()
    {
        return is_null($this->car_colors_id) ? '' : htmlspecialchars($this->car_colors_id);
    }

    public function setCar_colors_id($car_colors_id)
    {
        $this->car_colors_id = $car_colors_id;
    }

    public function car_colors_name()
    {
        return is_null($this->car_colors_name) ? '' : htmlspecialchars($this->car_colors_name);
    }

    public function setCar_colors_name($car_colors_name)
    {
        $this->car_colors_name = $car_colors_name;
    }

    public function car_colors_hexa()
    {
        return is_null($this->car_colors_hexa) ? '' : htmlspecialchars($this->car_colors_hexa);
    }

    public function setCar_colors_hexa($car_colors_hexa)
    {
        $this->car_colors_hexa = $car_colors_hexa;
    }

    public function getData()
    {
        return [
            'car_colors_id' => $this->car_colors_id,
            'car_colors_name' => $this->car_colors_name,
            'car_colors_hexa' => $this->car_colors_hexa,
        ];
    }
}
