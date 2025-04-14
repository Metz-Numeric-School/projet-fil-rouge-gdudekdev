<?php

namespace App\Class;

class Ride
{
    private $rides_id = 0;
    private $rides_driver = 0;
    private $rides_departure = '';
    private $rides_destination = '';
    private $rides_departure_time = null;
    private $rides_available_seats = 0;
    private $rides_created_at = null;
    private $accounts_id = 0;

    public function __construct($data = null)
    {
        if ($data) {
            $this->hydrate($data);
        }
    }

    private function hydrate($data)
    {
        $this->setRides_id($data['rides_id']);
        $this->setRides_driver($data['rides_driver']);
        $this->setRides_departure($data['rides_departure']);
        $this->setRides_destination($data['rides_destination']);
        $this->setRides_departure_time($data['rides_departure_time']);
        $this->setRides_available_seats($data['rides_available_seats']);
        $this->setRides_created_at($data['rides_created_at']);
        $this->setAccounts_id($data['accounts_id']);
    }

    public function rides_id()
    {
        return is_null($this->rides_id) ? '' : htmlspecialchars($this->rides_id);
    }

    public function setRides_id($rides_id)
    {
        $this->rides_id = $rides_id;
    }

    public function rides_driver()
    {
        return is_null($this->rides_driver) ? '' : htmlspecialchars($this->rides_driver);
    }

    public function setRides_driver($rides_driver)
    {
        $this->rides_driver = $rides_driver;
    }

    public function rides_departure()
    {
        return is_null($this->rides_departure) ? '' : htmlspecialchars($this->rides_departure);
    }

    public function setRides_departure($rides_departure)
    {
        $this->rides_departure = $rides_departure;
    }

    public function rides_destination()
    {
        return is_null($this->rides_destination) ? '' : htmlspecialchars($this->rides_destination);
    }

    public function setRides_destination($rides_destination)
    {
        $this->rides_destination = $rides_destination;
    }

    public function rides_departure_time()
    {
        return is_null($this->rides_departure_time) ? '' : htmlspecialchars($this->rides_departure_time);
    }

    public function setRides_departure_time($rides_departure_time)
    {
        $this->rides_departure_time = $rides_departure_time;
    }

    public function rides_available_seats()
    {
        return is_null($this->rides_available_seats) ? '' : htmlspecialchars($this->rides_available_seats);
    }

    public function setRides_available_seats($rides_available_seats)
    {
        $this->rides_available_seats = $rides_available_seats;
    }

    public function rides_created_at()
    {
        return is_null($this->rides_created_at) ? '' : htmlspecialchars($this->rides_created_at);
    }

    public function setRides_created_at($rides_created_at)
    {
        $this->rides_created_at = $rides_created_at;
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
            'rides_id' => $this->rides_id,
            'rides_driver' => $this->rides_driver,
            'rides_departure' => $this->rides_departure,
            'rides_destination' => $this->rides_destination,
            'rides_departure_time' => $this->rides_departure_time,
            'rides_available_seats' => $this->rides_available_seats,
            'rides_created_at' => $this->rides_created_at,
            'accounts_id' => $this->accounts_id,
        ];
    }
}
