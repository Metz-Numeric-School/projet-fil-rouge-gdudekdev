<?php

namespace Src\Entity;

class RidesInstance
{
      public static $array_accepted_key = [
            'id' => [
                  'title' => 'Identifiant du trajet',
                  'readonly' => true,
                  'crud_show' => false,
                  'detail_show' => false,
                  'create_show' => false,
                  'type' => "number",
            ],
            'departure_time' => [
                  'title' => 'Date de départ du trajet',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => true,
                  'readonly' => false,
                  'required' => true,
                  'type' => 'datetime-local',
            ],
            'departure' => [
                  'title' => 'Adresse de départ',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => false,
                  'readonly' => false,
            ],
            'destination' => [
                  'title' => 'Adresse d\'arrivée',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => false,
                  'readonly' => false,
            ],
            'driver_id' => [
                  'title' => 'Identifiant du conducteur',
                  'detail_show' => false,
                  'create_show' => false,
                  'crud_show' => false,
                  'readonly' => true,
            ],
            // TODO mettre un status sur les comptes au moment de leur suppression pour pouvoir conserver les informations sous 30 jours
            'status' => [
                  'title' => 'Status du trajet',
                  'detail_show' => true,
                  'create_show' => false,
                  'crud_show' => true,
                  'readonly' => true,
            ],
            'rides_id' => [
                  'title' => 'Identifiant du modèle de trajet associé',
                  'detail_show' => false,
                  'create_show' => false,
                  'crud_show' => false,
                  'readonly' => true,
            ],
      ];

      private $id = 0;
      private $departure_time = "";
      private $departure = "";
      private $destination = "";
      private $driver_id = 0;
      private $status = "pending";
      private $rides_id = 0;


      public function __construct($data = null)
      {
            if (!is_null($data)) {
                  $this->hydrate($data);
            }
      }
      private function hydrate($data)
      {
            $this->id = $data['rides_instance_id'];
            $this->departure_time = $data['rides_instance_departure_time'];
            $this->departure = $data['rides_instance_departure'];
            $this->destination = $data['rides_instance_destination'];
            $this->driver_id = $data['rides_instance_driver_id'];
            $this->status = $data['rides_instance_status'];
            $this->rides_id = $data['rides_id'];
      }

      public function id()
      {
            return htmlspecialchars($this->id);
      }
      public function setId(int $value)
      {
            if (is_numeric($value) && $value !== 0) {
                  $this->id = $value;
            }
      }
      public function departure_time()
      {
            return htmlspecialchars($this->departure_time);
      }
      public function setDeparture_time(string $value)
      {
            $this->departure_time = $value;
      }
      public function departure()
      {
            return htmlspecialchars($this->departure);
      }
      public function setDeparture(string $value)
      {
            $this->departure = $value;
      }
      public function destination()
      {
            return htmlspecialchars($this->destination ?? 0);
      }
      public function setDestination(string $value)
      {
            $this->destination = $value;
      }

      public function driver_id()
      {
            return htmlspecialchars($this->driver_id);
      }
      public function setDriver_id(int $value)
      {
            if (is_numeric($value) && $value !== 0) {
                  $this->driver_id = $value;
            }
      }
      public function rides_id()
      {
            return htmlspecialchars($this->rides_id);
      }
      public function setRides_id(int $value)
      {
            if (is_numeric($value) && $value !== 0) {
                  $this->rides_id = $value;
            }
      }

}