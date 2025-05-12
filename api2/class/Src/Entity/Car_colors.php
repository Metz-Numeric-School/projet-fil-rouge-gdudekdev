<?php

namespace Src\Entity;
use Core\Abstract\Entity;
class Car_colors extends Entity
{
      public static $array_accepted_key = [
            'id' => [
                  'title' => 'Identifiant de la couleur',
                  'readonly' => true,
                  'crud_show' => false,
                  'detail_show' => false,
                  'create_show' => false,
                  'type' => "number",
            ],
            'name' => [
                  'title' => 'Nom de la couleur',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => true,
                  'readonly' => false,
                  'required' => true,
            ],
            'hexa' => [
                  'title' => 'Hexa de la couleur',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => true,
                  'readonly' => false,
                  'required' => false,
            ],
            
      ];
      private $id = 0;
      private $name = "";
      private $hexa = "";


      public function __construct($data = null)
      {
            if (!is_null($data)) {
                  $this->hydrate($data);
            }

      }
      private function hydrate($data)
      {
            $this->id = $data['car_colors_id'];
            $this->name = $data['car_colors_name'];
            $this->hexa = $data['car_colors_hexa'];
            
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
      public function hexa()
      {
            return htmlspecialchars( $this->hexa);
      }
      public function setHexa(string $value)
      {
            $this->hexa = $value;
      }
}