<?php

namespace Src\Entity;

use Core\Abstract\Entity;
class Car_brands extends Entity
{
      public static $array_accepted_key = [
            'id' => [
                  'title' => 'Identifiant de la marque',
                  'readonly' => true,
                  'crud_show' => false,
                  'detail_show' => false,
                  'create_show' => false,
                  'type' => "number",
            ],
            'name' => [
                  'title' => 'Nom de la marque',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => true,
                  'readonly' => false,
                  'required' => true,
            ],
            'logo' => [
                  'title' => 'Logo de la marque',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => false,
                  'readonly' => false,
                  'required' => false,
            ],
            
      ];
      private $id = 0;
      private $name = "";
      private $logo = "";


      public function __construct($data = null)
      {
            if (!is_null($data)) {
                  $this->hydrate($data);
            }

      }
      private function hydrate($data)
      {
            $this->id = $data['car_brands_id'];
            $this->name = $data['car_brands_name'];
            $this->logo = $data['car_brands_logo'];
            
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
      public function logo()
      {
            return htmlspecialchars( $this->logo);
      }
      public function setLogo(string $value)
      {
            $this->logo = $value;
      }
}