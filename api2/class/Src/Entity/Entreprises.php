<?php

namespace Src\Entity;

class Entreprises
{
      public static $array_accepted_key = [
            'id' => [
                  'title' => 'Identifiant de l\'entreprise',
                  'readonly' => true,
                  'crud_show' => true,
                  'detail_show' => false,
                  'create_show' => false,
                  'type' => "number",
            ],
            'name' => [
                  'title' => 'Nom de l\'entreprise',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => true,
                  'readonly' => false,
                  'required' => true,
            ],
            'location' => [
                  'title' => 'Adresse de l\'entreprise',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => false,
                  'readonly' => false,
                  'required' => false,
            ],
            
      ];

      private $id = 0;
      private $name = "";
      private $location = "";


      public function __construct($data = null)
      {
            if (!is_null($data)) {
                  $this->hydrate($data);
            }

      }
      private function hydrate($data)
      {
            $this->id = $data['entreprises_id'];
            $this->name = $data['entreprises_name'];
            $this->location = $data['entreprises_location'];
            
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
      public function name()
      {
            return htmlspecialchars( $this->name);
      }
      public function setName(string $value)
      {
            $this->name = $value;
      }
      public function location()
      {
            return htmlspecialchars( $this->location);
      }
      public function setLocation(string $value)
      {
            $this->location = $value;
      }
}