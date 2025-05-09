<?php

namespace Src\Entity;

class Car_colors
{
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