<?php

namespace App\Class;

class Car_model
{
    private $car_models_id = 0;
    private $car_models_name = '';
    private $car_brands_id = 0;

    public function __construct($data = null)
    {
        if ($data) {
            $this->hydrate($data);
        }
    }

    private function hydrate($data)
    {
        $this->setCar_models_id($data['car_models_id']);
        $this->setCar_models_name($data['car_models_name']);
        $this->setCar_brands_id($data['car_brands_id']);
    }

    public function car_models_id()
    {
        return htmlspecialchars($this->car_models_id);
    }

    public function setCar_models_id($car_models_id)
    {
        $this->car_models_id = $car_models_id;
    }

    public function car_models_name()
    {
        return htmlspecialchars($this->car_models_name);
    }

    public function setCar_models_name($car_models_name)
    {
        $this->car_models_name = $car_models_name;
    }

    public function car_brands_id()
    {
        return htmlspecialchars($this->car_brands_id);
    }

    public function setCar_brands_id($car_brands_id)
    {
        $this->car_brands_id = $car_brands_id;
    }

    public function getData()
    {
        return [
            'car_models_id' => $this->car_models_id,
            'car_models_name' => $this->car_models_name,
            'car_brands_id' => $this->car_brands_id,
        ];
    }
}
