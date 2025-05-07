<?php

namespace Src\Entity;

class Divisions
{
      private $id = 0;
      private $name = "";
      private $entreprises_id = 0;


      public function __construct($data = null)
      {
            if (!is_null($data)) {
                  $this->hydrate($data);
            }

      }
      private function hydrate($data)
      {
            $this->id = $data['divisions_id'];
            $this->name = $data['divisions_name'];
            $this->entreprises_id = $data['entreprises_id'];
            
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
      public function entreprises_id()
      {
            return htmlspecialchars( $this->entreprises_id);
      }
      public function setEntreprises_id(int $value)
      {
            if (is_numeric($value) && $value !== 0) {
                  $this->entreprises_id = $value;
            }
      }
}