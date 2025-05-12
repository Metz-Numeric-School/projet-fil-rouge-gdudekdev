<?php

namespace Src\Entity;
use Core\Abstract\Entity;
class Vehicules extends Entity
{
      public static $array_accepted_key = [
            'id' => [
                  'title' => 'Identifiant du véhicule',
                  'readonly' => true,
                  'crud_show' => false,
                  'detail_show' => false,
                  'create_show' => false,
                  'type' => "number",
            ],
            'license_plate' => [
                  'title' => 'Plaque d\'immatriculation',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => true,
                  'readonly' => false,
                  'required' => false,
            ],
      ];

      private $id = 0;
      private $license_plate = "";
      private $car_models_id = 0;
      private $car_colors_id = 0;
      private $car_engines_id = 0;
      private $accounts_id = 0;



      public function __construct($data = null)
      {
            if (!is_null($data)) {
                  $this->hydrate($data);
            }

      }
      private function hydrate($data)
      {
            // TODO utiliser les setters et getters pour l'hydration de toutes les entités 
            $this->setId($data['vehicules_id']) ;
            $this->setLicense_plate($data['vehicules_license_plate']) ;
            $this->setCar_models_id($data['car_models_id']) ;
            $this->setCar_colors_id($data['car_colors_id']) ;
            $this->setCar_engines_id($data['car_engines_id']) ;
            $this->setAccounts_id($data['accounts_id']) ;
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
      public function license_plate()
      {
            return htmlspecialchars( $this->license_plate);
      }
      public function setLicense_plate(string $value)
      {
            $this->license_plate = $value;
      }
      public function car_models_id()
      {
            return htmlspecialchars( $this->car_models_id);
      }
      public function setCar_models_id(int $value)
      {
            if (is_numeric($value) && $value !== 0) {
                  $this->car_models_id = $value;
            }
      }
      public function car_colors_id()
      {
            return htmlspecialchars( $this->car_colors_id);
      }
      public function setCar_colors_id(int $value)
      {
            if (is_numeric($value) && $value !== 0) {
                  $this->car_colors_id = $value;
            }
      }
      public function car_engines_id()
      {
            return htmlspecialchars( $this->car_engines_id);
      }
      public function setCar_engines_id(int $value)
      {
            if (is_numeric($value) && $value !== 0) {
                  $this->car_engines_id = $value;
            }
      }
      public function accounts_id()
      {
            return htmlspecialchars( $this->accounts_id);
      }
      public function setAccounts_id(int $value)
      {
            if (is_numeric($value) && $value !== 0) {
                  $this->accounts_id = $value;
            }
      }





}