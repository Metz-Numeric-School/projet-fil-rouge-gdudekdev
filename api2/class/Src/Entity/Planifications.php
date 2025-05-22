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
            'pattern_type' => [
                  'title' => 'Type de pattern de la planification',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => true,
                  'readonly' => false,
                  'required' => true,
            ],
            'days_of_week' => [
                  'title' => 'Jours prévus dans la planification',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => true,
                  'readonly' => false,
                  'required' => true,
            ],
            'interval_weeks' => [
                  'title' => 'Intervalle de semaine pour la planification',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => true,
                  'readonly' => false,
                  'required' => true,
            ],
      ];
      private $id = 0;
      private $pattern_type = "none";
      private $days_of_week = [];
      private $interval_weeks = 1;

      public function __construct($data = null)
      {
            if (!is_null($data)) {
                  $this->hydrate($data);
            }

      }
      private function hydrate($data)
      {
            $this->id = $data['planifications_id'];
            $this->pattern_type = $data['planifications_pattern_type'];
            $this->days_of_week = $data['planifications_days_of_week'];
            $this->interval_weeks = $data['planifications_interval_weeks'];

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
      public function pattern_type()
      {
            return htmlspecialchars($this->pattern_type);
      }
      public function setPattern_type(string $value)
      {
            $this->pattern_type = $value;
      }
      public function days_of_week()
      {
            return htmlspecialchars($this->days_of_week);
      }
      public function setDays_of_week(string $value)
      {
            $this->days_of_week = $value;
      }
      public function interval_weeks()
      {
            return htmlspecialchars($this->interval_weeks);
      }
      public function setInterval_weeks(string $value)
      {
            $this->interval_weeks = $value;
      }
}