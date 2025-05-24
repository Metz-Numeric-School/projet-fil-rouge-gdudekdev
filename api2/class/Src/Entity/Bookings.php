<?php

namespace Src\Entity;

class Bookings
{
      public static $array_accepted_key = [
            'id' => [
                  'title' => 'Identifiant de la réservation',
                  'readonly' => true,
                  'crud_show' => true,
                  'detail_show' => false,
                  'create_show' => false,
                  'type' => "number",
            ],
            'created_at' => [
                  'title' => 'Date de création de la réservation',
                  'detail_show' => true,
                  'create_show' => false,
                  'crud_show' => true,
                  'readonly' => false,
            ],
            'status' => [
                  'title' => 'Statut actuel de la réservation',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => false,
                  'readonly' => true,
                  'required' => false,
            ],

      ];

      private $id = 0;
      // pending, accepted, refused
      private $status = "pending";
      private $created_at = "";
      private $instances_sender_id = "";
      private $instances_receiver_id = "";


      public function __construct($data = null)
      {
            if (!is_null($data)) {
                  $this->hydrate($data);
            }
      }
      private function hydrate($data)
      {
            $this->id = $data['bookings_id'];
            $this->status = $data['bookings_status'];
            $this->created_at = $data['bookings_created_at'];
            $this->instances_sender_id = $data['instances_sender_id'];
            $this->instances_receiver_id = $data['instances_receiver_id'];
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
      
      public function status()
      {
            return htmlspecialchars($this->status);
      }
      public function setStatus(string $value)
      {
            $this->status = $value;
      }
      public function created_at()
      {
            return htmlspecialchars($this->created_at);
      }
      public function setCreated_at(string $value)
      {
            $this->created_at = $value;
      }
      public function instances_sender_id()
      {
            return htmlspecialchars($this->instances_sender_id);
      }
      public function setInstances_sender_id(int $value)
      {
            if (is_numeric($value) && $value !== 0) {
                  $this->instances_sender_id = $value;
            }
      }
      public function instances_receiver_id()
      {
            return htmlspecialchars($this->instances_receiver_id);
      }
      public function setInstances_receiver_id(int $value)
      {
            if (is_numeric($value) && $value !== 0) {
                  $this->instances_receiver_id = $value;
            }
      }
}