<?php

namespace App\Class;

class Car_brand
{
    private $car_brands_id = 0;
    private $car_brands_name = '';
    private $car_brands_logo = '';

    public function __construct($data = null)
    {
        if ($data) {
            $this->hydrate($data);
        }
    }

    private function hydrate($data)
    {
        $this->setCar_brands_id($data['car_brands_id']);
        $this->setCar_brands_name($data['car_brands_name']);
        $this->setCar_brands_logo($data['car_brands_logo']);
    }

    public function car_brands_id()
    {
        return is_null($this->car_brands_id) ? '' : htmlspecialchars($this->car_brands_id);
    }

    public function setCar_brands_id($car_brands_id)
    {
        $this->car_brands_id = $car_brands_id;
    }

    public function car_brands_name()
    {
        return is_null($this->car_brands_name) ? '' : htmlspecialchars($this->car_brands_name);
    }

    public function setCar_brands_name($car_brands_name)
    {
        $this->car_brands_name = $car_brands_name;
    }

    public function car_brands_logo()
    {
        return is_null($this->car_brands_logo) ? '' : htmlspecialchars($this->car_brands_logo);
    }

    public function setCar_brands_logo($car_brands_logo)
    {
        $this->car_brands_logo = $car_brands_logo;
    }

    public function getData()
    {
        return [
            'car_brands_id' => $this->car_brands_id,
            'car_brands_name' => $this->car_brands_name,
            'car_brands_logo' => $this->car_brands_logo,
        ];
    }
}
