<?php

namespace Src\Entity;

class Car_brands
{
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