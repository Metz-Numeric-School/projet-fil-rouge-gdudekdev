<?php

namespace Src\Entity;

class Rides
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
                  'title' => 'Départ du trajet',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => true,
                  'readonly' => false,
                  'required' => true,
                  'type'=>'datetime-local',
            ],
            'seats' => [
                  'title' => 'Nombre de places',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => true,
                  'readonly' => false,
                  'required' => true,
            ],
            'direction' => [
                  'title' => 'Sens de direction',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => false,
                  'readonly' => false,
            ],
            'recurrence_start' => [
                  'title' => 'Date début de la planification',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => false,
                  'readonly' => false,
                  'type'=>'datetime-local',
            ],
            'created_at' => [
                  'title' => 'Date de création',
                  'detail_show' => true,
                  'create_show' => false,
                  'crud_show' => false,
                  'readonly' => true,
            ],
            'recurrence_end' => [
                  'title' => 'Date de fin de la planification',
                  'detail_show' => false,
                  'create_show' => true,
                  'crud_show' => false,
                  'readonly' => false,
                  'type'=>'datetime-local',
            ],
      ];

      private $id = 0;
      private $departure_time = "";
      private $seats = "";
      private $direction = 0;
      private $recurrence_start = "";
      private $created_at = null;
      private $recurrence_end = "";
      private $routes_id = 0;
      private $rides_recurrence_type_id = 0;
      private $vehicules_id = 0;



      public function __construct($data = null)
      {
            if (!is_null($data)) {
                  $this->hydrate($data);
            }

      }
      private function hydrate($data)
      {
            $this->id = $data['rides_id'];
            $this->departure_time = $data['rides_departure_time'];
            $this->seats = $data['rides_seats'];
            $this->direction = $data['rides_direction'];
            $this->recurrence_start = $data['rides_recurrence_start'];
            $this->created_at = $data['rides_created_at'];
            $this->recurrence_end = $data['rides_recurrence_end'];
            $this->routes_id = $data['routes_id'];
            $this->rides_recurrence_type_id = $data['rides_recurrence_type_id'];
            $this->vehicules_id = $data['vehicules_id'];
      }

      public function id()
      {
            return htmlspecialchars( $this->id);
      }
      public function setId(int $value)
      {
            if (is_numeric($value) && $value !== 0) {
                  $this->id = $value;
            }
      }
      public function departure_time()
      {
            return htmlspecialchars( $this->departure_time);
      }
      public function setDeparture_time(string $value)
      {
            $this->departure_time = $value;
      }
      public function seats()
      {
            return htmlspecialchars( $this->seats);
      }
      public function setSeats(string $value)
      {
            $this->seats = $value;
      }
      public function direction()
      {
            return htmlspecialchars( $this->direction ?? "");
      }
      public function setDirection(string $value)
      {
            $this->direction = $value;
      }
      public function recurrence_start()
      {
            return htmlspecialchars( $this->recurrence_start ?? "");
      }
      public function setRecurrence_start(string $value)
      {
            $this->recurrence_start = $value;
      }
      public function created_at()
      {
            return $this->created_at === null ? null : htmlspecialchars($this->created_at ?? "");
      }
      public function setCreated_at(string $value)
      {
            $this->created_at = $value;
      }
      public function recurrence_end()
      {
            return htmlspecialchars( $this->recurrence_end);
      }
      public function setRecurrence_end(string $value)
      {
            $this->recurrence_end = $value;
      }
      public function vehicules_id()
      {
            return htmlspecialchars( $this->vehicules_id);
      }
      public function setVehicules_id(int $value)
      {
            if (is_numeric($value) && $value !== 0) {
                  $this->vehicules_id = $value;
            }
      }
      public function rides_recurrence_type_id()
      {
            return htmlspecialchars( $this->rides_recurrence_type_id);
      }
      public function setrides_Recurrence_type_id(int $value)
      {
            if (is_numeric($value) && $value !== 0) {
                  $this->rides_recurrence_type_id = $value;
            }
      }
      public function routes_id()
      {
            return htmlspecialchars( $this->routes_id);
      }
      public function setRoutes_id(int $value)
      {
            if (is_numeric($value) && $value !== 0) {
                  $this->routes_id = $value;
            }
      }





}