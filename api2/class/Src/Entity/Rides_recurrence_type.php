<?php

namespace Src\Entity;
use Core\Abstract\Entity;
class Rides_recurrence_type extends Entity
{
      public static $array_accepted_key = [
            'id' => [
                  'title' => 'Identifiant de la recurrence',
                  'readonly' => true,
                  'crud_show' => false,
                  'detail_show' => false,
                  'create_show' => false,
                  'type' => "number",
            ],
            'name' => [
                  'title' => 'Nom de la recurrence',
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
            $this->id = $data['rides_recurrence_type_id'];
            $this->name = $data['rides_recurrence_type_name'];

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