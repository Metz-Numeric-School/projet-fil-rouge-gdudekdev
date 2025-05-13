<?php

namespace Src\Entity;
use Core\Abstract\Entity;
class Routes extends Entity
{
       public static $array_accepted_key = [
            'id' => [
                  'title' => 'Identifiant de la preférence',
                  'readonly' => true,
                  'crud_show' => false,
                  'detail_show' => false,
                  'create_show' => false,
                  'type' => "number",
            ],
            'departure' => [
                  'title' => 'Adresse de départ',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => true,
                  'readonly' => false,
                  'required' => true,
            ],
            'destination' => [
                  'title' => 'Adresse d\'arrivée',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => true,
                  'readonly' => false,
                  'required' => true,
            ]
      ];
      private $id = 0;
      private $departure = "";
      private $destination = "";
      private $accounts_id;

      public function __construct($data = null)
      {
            if (!is_null($data)) {
                  $this->hydrate($data);
            }

      }
      private function hydrate($data)
      {
            $this->id = $data['routes_id'];
            $this->departure = $data['routes_departure'];
            $this->destination = $data['routes_destination'];
            $this->accounts_id = $data['accounts_id'];
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
      public function departure()
      {
            return htmlspecialchars( $this->departure);
      }
      public function setDeparture(string $value)
      {
            $this->departure = $value;
      }
      public function destination()
      {
            return htmlspecialchars( $this->destination);
      }
      public function setDestination(string $value)
      {
            $this->destination = $value;
      }
      public function accounts_id()
      {
            return htmlspecialchars( $this->accounts_id);
      }
      public function setAccounts_id(int $value)
      {
            if (is_numeric($value) && $value !== 0) {
                  $this->accounts_id = $value;
            }


      }
}

