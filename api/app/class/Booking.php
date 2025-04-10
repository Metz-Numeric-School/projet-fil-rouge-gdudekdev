<?php

namespace App\Class;

class Booking
{
    private $bookings_id = 0;
    private $bookings_passenger = 0;
    private $bookings_status = '';
    private $bookings_created_at = null;
    private $rides_id = 0;
    private $accounts_id = 0;

    public function __construct($data = null)
    {
        if ($data) {
            $this->hydrate($data);
        }
    }

    private function hydrate($data)
    {
        $this->setBookings_id($data['bookings_id']);
        $this->setBookings_passenger($data['bookings_passenger']);
        $this->setBookings_status($data['bookings_status']);
        $this->setBookings_created_at($data['bookings_created_at']);
        $this->setRides_id($data['rides_id']);
        $this->setAccounts_id($data['accounts_id']);
    }

    public function bookings_id()
    {
        return htmlspecialchars($this->bookings_id);
    }

    public function setBookings_id($bookings_id)
    {
        $this->bookings_id = $bookings_id;
    }

    public function bookings_passenger()
    {
        return htmlspecialchars($this->bookings_passenger);
    }

    public function setBookings_passenger($bookings_passenger)
    {
        $this->bookings_passenger = $bookings_passenger;
    }

    public function bookings_status()
    {
        return htmlspecialchars($this->bookings_status);
    }

    public function setBookings_status($bookings_status)
    {
        $this->bookings_status = $bookings_status;
    }

    public function bookings_created_at()
    {
        return htmlspecialchars($this->bookings_created_at);
    }

    public function setBookings_created_at($bookings_created_at)
    {
        $this->bookings_created_at = $bookings_created_at;
    }

    public function rides_id()
    {
        return htmlspecialchars($this->rides_id);
    }

    public function setRides_id($rides_id)
    {
        $this->rides_id = $rides_id;
    }

    public function accounts_id()
    {
        return htmlspecialchars($this->accounts_id);
    }

    public function setAccounts_id($accounts_id)
    {
        $this->accounts_id = $accounts_id;
    }

    public function getData()
    {
        return [
            'bookings_id' => $this->bookings_id,
            'bookings_passenger' => $this->bookings_passenger,
            'bookings_status' => $this->bookings_status,
            'bookings_created_at' => $this->bookings_created_at,
            'rides_id' => $this->rides_id,
            'accounts_id' => $this->accounts_id,
        ];
    }
}
