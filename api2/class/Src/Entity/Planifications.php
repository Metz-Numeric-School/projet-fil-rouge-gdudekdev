<?php

namespace Src\Entity;

class Planifications
{
      public static $array_accepted_key = [
            'id' => [
                  'title' => 'Identifiant de la planification',
                  'readonly' => true,
                  'crud_show' => false,
                  'detail_show' => false,
                  'create_show' => false,
                  'type' => "number",
            ],
            'name' => [
                  'title' => 'Nom de la planification',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => true,
                  'readonly' => false,
                  'required' => true,
            ],
            'map' => [
                  'title' => 'Type de mappage de la planification',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => true,
                  'readonly' => false,
                  'required' => true,
            ],
      ];
      private $id = 0;
      private $name = "";
      private $map = [];

      public function __construct($data = null)
      {
            if (!is_null($data)) {
                  $this->hydrate($data);
            }

      }
      private function hydrate($data)
      {
            $this->id = $data['planifications_id'];
            $this->name = $data['planifications_name'];
            $this->map = $data['planifications_map'];

      }
      public function id()
      {
            return htmlspecialchars($this->id);
      }
      public function setId(int $value)
      {
            if (is_numeric($value) && $value !== 0) {
                  $this->id = $value;
            }
      }
      public function name()
      {
            return htmlspecialchars($this->name);
      }
      public function setName(string $value)
      {
            $this->name = $value;
      }
      public function map()
      {
            return htmlspecialchars($this->map);
      }
      public function setMap(string $value)
      {
            $this->map = $value;
      }
}