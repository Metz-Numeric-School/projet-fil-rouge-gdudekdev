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
            ],
            'direction' => [
                  'title' => 'Sens de direction',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => false,
                  'readonly' => false,
            ],
            'created_at' => [
                  'title' => 'Date de création',
                  'detail_show' => true,
                  'create_show' => false,
                  'crud_show' => false,
                  'readonly' => true,
            ],
      ];

      private $id = 0;
      private $departure_time = "";
      private $seats= "";
      private $direction = 0;
      private $position = "passenger";
      private $planifications_start = "";
      private $planifications_end = "";
      private $created_at = null;
      private $routes_id = 0;
      private $planifications_id = 0;
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
            $this->position = $data['rides_position'];
            $this->planifications_start = $data['planifications_start'];
            $this->planifications_end = $data['planifications_end'];
            $this->created_at = $data['rides_created_at'];
            $this->routes_id = $data['routes_id'];
            $this->planifications_id = $data['planifications_id'];
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
            return htmlspecialchars( $this->direction ?? 0);
      }
      public function setDirection(string $value)
      {
            $this->direction = $value;
      }
      public function position()
      {
            return htmlspecialchars( $this->position);
      }
      public function setPosition(string $value)
      {
            $this->position = $value ==='driver' ? $value :'passenger';
      }
      public function planifications_start()
      {
            return htmlspecialchars( $this->planifications_start ?? "");
      }
      public function setPlanifications_start(string $value)
      {
            $this->planifications_start = $value;
      }
      public function created_at()
      {
            return $this->created_at === null ? null : htmlspecialchars($this->created_at ?? "");
      }
      public function setCreated_at(string $value)
      {
            $this->created_at = $value;
      }
      public function planifications_end()
      {
            return htmlspecialchars( $this->planifications_end);
      }
      public function setPlanifications_end(string $value)
      {
            $this->planifications_end = $value;
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
      public function planifications_id()
      {
            return htmlspecialchars( $this->planifications_id);
      }
      public function setPlanifications_id(int $value)
      {
            if (is_numeric($value) && $value !== 0) {
                  $this->planifications_id = $value;
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