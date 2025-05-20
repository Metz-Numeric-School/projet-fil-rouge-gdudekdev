<?php

namespace Src\Entity;

class Roles
{
      public static $array_accepted_key = [
            'id' => [
                  'title' => 'Identifiant du role',
                  'readonly' => true,
                  'crud_show' => false,
                  'detail_show' => false,
                  'create_show' => false,
                  'type' => "number",
            ],
            'name' => [
                  'title' => 'Nom du role',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => true,
                  'readonly' => false,
                  'required' => true,
            ],
      ];
      private $id = 0;
      private $name = "";


      public function __construct($data = null)
      {
            if (!is_null($data)) {
                  $this->hydrate($data);
            }

      }
      private function hydrate($data)
      {
            $this->id = $data['roles_id'];
            $this->name = $data['roles_name'];

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
}