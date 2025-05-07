<?php

namespace Src\Entity;

class Accounts
{
      public static $array_accepted_key = [
            'id' => [
                  'title' => 'Numéro d\'identifiant',
                  'readonly' => true,
                  'crud_show' => true,
                  'detail_show' => false,
                  'create_show' => false,
                  'type' => "number",
            ],
            'fullname' => [
                  'title' => 'Nom complet',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => true,
                  'readonly' => false,
                  'required' => true,
            ],
            'email' => [
                  'title' => 'Email',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => true,
                  'readonly' => false,
                  'required' => true,
            ],
            'birthday' => [
                  'title' => 'Date d\'anniversaire',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => false,
                  'readonly' => false,
            ],
            'phone' => [
                  'title' => 'Numéro de téléphone',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => false,
                  'readonly' => false,
            ],
            'created_at' => [
                  'title' => 'Date de création',
                  'detail_show' => true,
                  'create_show' => false,
                  'crud_show' => false,
                  'readonly' => true,
            ],
            'password' => [
                  'title' => 'Mot de passe',
                  'detail_show' => false,
                  'create_show' => true,
                  'crud_show' => false,
                  'readonly' => false,
                  'required' => true,
            ],
            'roles_id' => [
                  'title' => 'Roles',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => false,
                  'readonly' => false,
            ],
            'divisions_id' => [
                  'title' => 'Divisions',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => false,
                  'readonly' => false,
            ],
      ];

      private $id = 0;
      private $fullname = "";
      private $email = "";
      private $birthday = "";
      private $phone = "";
      private $created_at = null;
      private $password = "";
      private $roles_id = 0;
      private $divisions_id = 0;



      public function __construct($data = null)
      {
            if (!is_null($data)) {
                  $this->hydrate($data);
            }

      }
      private function hydrate($data)
      {
            $this->id = $data['accounts_id'];
            $this->fullname = $data['accounts_fullname'];
            $this->email = $data['accounts_email'];
            $this->birthday = $data['accounts_birthday'];
            $this->phone = $data['accounts_phone'];
            $this->created_at = $data['accounts_created_at'];
            $this->password = $data['accounts_password'];
            $this->roles_id = $data['roles_id'];
            $this->divisions_id = $data['divisions_id'];
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
      public function fullname()
      {
            return htmlspecialchars( $this->fullname);
      }
      public function setFullname(string $value)
      {
            $this->fullname = $value;
      }
      public function email()
      {
            return htmlspecialchars( $this->email);
      }
      public function setEmail(string $value)
      {
            $this->email = $value;
      }
      public function birthday()
      {
            return htmlspecialchars( $this->birthday);
      }
      public function setBirthday(string $value)
      {
            $this->birthday = $value;
      }
      public function phone()
      {
            return htmlspecialchars( $this->phone);
      }
      public function setPhone(string $value)
      {
            $this->phone = $value;
      }
      public function created_at()
      {
            return $this->created_at === null ? null : htmlspecialchars($this->created_at);
      }
      public function setCreated_at(string $value)
      {
            $this->created_at = $value;
      }
      public function password()
      {
            return htmlspecialchars( $this->password);
      }
      public function setPassword(string $value)
      {
            $this->password = $value;
      }
      public function roles_id()
      {
            return htmlspecialchars( $this->roles_id);
      }
      public function setRoles_id(int $value)
      {
            if (is_numeric($value) && $value !== 0) {
                  $this->roles_id = $value;
            }
      }
      public function divisions_id()
      {
            return htmlspecialchars( $this->divisions_id);
      }
      public function setDivisions_id(int $value)
      {
            if (is_numeric($value) && $value !== 0) {
                  $this->divisions_id = $value;
            }
      }





}