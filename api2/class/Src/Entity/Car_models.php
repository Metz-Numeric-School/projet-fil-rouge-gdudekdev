<?php

namespace Src\Entity;

class Car_models
{
      private $id = 0;
      private $name = "";
      private $car_brands_id = 0;


      public function __construct($data = null)
      {
            if (!is_null($data)) {
                  $this->hydrate($data);
            }

      }
      private function hydrate($data)
      {
            $this->id = $data['car_models_id'];
            $this->name = $data['car_models_name'];
            $this->car_brands_id = $data['car_brands_id'];
            
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
      public function car_brands_id()
      {
            return htmlspecialchars( $this->car_brands_id);
      }
      public function setCar_brands_id(string $value)
      {
            if (is_numeric($value) && $value !== 0) {
                  $this->car_brands_id = $value;
            }
      }
}