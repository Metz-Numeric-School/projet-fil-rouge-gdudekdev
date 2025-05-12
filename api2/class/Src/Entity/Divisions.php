<?php

namespace Src\Entity;
use Core\Abstract\Entity;
class Divisions extends Entity
{
      public static $array_accepted_key = [
            'id' => [
                  'title' => 'Identifiant de la division',
                  'readonly' => true,
                  'crud_show' => false,
                  'detail_show' => false,
                  'create_show' => false,
                  'type' => "number",
            ],
            'name' => [
                  'title' => 'Nom de la division',
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