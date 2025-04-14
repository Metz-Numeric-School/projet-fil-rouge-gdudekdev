<?php

namespace App\Class;

class Vehicule
{
    private $vehicules_id = 0;
    private $vehicules_license_plate = '';
    private $car_brands_id = 0;
    private $car_colors_id = 0;
    private $car_engine_id = 0;
    private $accounts_id = 0;

    public function __construct($data = null)
    {
        if ($data) {
            $this->hydrate($data);
        }
    }

    private function hydrate($data)
    {
        $this->setVehicules_id($data['vehicules_id']);
        $this->setVehicules_license_plate($data['vehicules_license_plate']);
        $this->setCar_brands_id($data['car_brands_id']);
        $this->setCar_colors_id($data['car_colors_id']);
        $this->setCar_engine_id($data['car_engine_id']);
        $this->setAccounts_id($data['accounts_id']);
    }

    public function vehicules_id()
    {
        return is_null($this->vehicules_id) ? '' : htmlspecialchars($this->vehicules_id);
    }

    public function setVehicules_id($vehicules_id)
    {
        $this->vehicules_id = $vehicules_id;
    }

    public function vehicules_license_plate()
    {
        return is_null($this->vehicules_license_plate) ? '' : htmlspecialchars($this->vehicules_license_plate);
    }

    public function setVehicules_license_plate($vehicules_license_plate)
    {
        $this->vehicules_license_plate = $vehicules_license_plate;
    }

    public function car_brands_id()
    {
        return is_null($this->car_brands_id) ? '' : htmlspecialchars($this->car_brands_id);
    }

    public function setCar_brands_id($car_brands_id)
    {
        $this->car_brands_id = $car_brands_id;
    }

    public function car_colors_id()
    {
        return is_null($this->car_colors_id) ? '' : htmlspecialchars($this->car_colors_id);
    }

    public function setCar_colors_id($car_colors_id)
    {
        $this->car_colors_id = $car_colors_id;
    }

    public function car_engine_id()
    {
        return is_null($this->car_engine_id) ? '' : htmlspecialchars($this->car_engine_id);
    }

    public function setCar_engine_id($car_engine_id)
    {
        $this->car_engine_id = $car_engine_id;
    }

    public function accounts_id()
    {
        return is_null($this->accounts_id) ? '' : htmlspecialchars($this->accounts_id);
    }

    public function setAccounts_id($accounts_id)
    {
        $this->accounts_id = $accounts_id;
    }

    public function getData()
    {
        return [
            'vehicules_id' => $this->vehicules_id,
            'vehicules_license_plate' => $this->vehicules_license_plate,
            'car_brands_id' => $this->car_brands_id,
            'car_colors_id' => $this->car_colors_id,
            'car_engine_id' => $this->car_engine_id,
            'accounts_id' => $this->accounts_id,
        ];
    }
}
