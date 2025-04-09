<?php

namespace App\class;
class User
{
      private $id = 0;
      private $name = '';
      private $email = '';
      private $password = '';
      private $created_at = '';
      private $birthday = '';
      private $phone = '';
      private $plannings_id = '';
      private $routes_id = '';
      private $preferences_id = '';
      private $companies_id = '';

      public function __construct($data = null)
      {
            if ($data) {
                  $this->hydrate($data);
            }
      }

      private function hydrate($data)
      {
            $this->setId($data['users_id']);
            $this->setName($data['users_name']);
            $this->setEmail($data['users_email']);
            $this->setPassword($data['users_password']);
            $this->setCreated_at($data['users_created_at']);
            $this->setBirthday($data['users_birthday']);
            $this->setPhone($data['users_phone']);
            $this->setPlannings_id($data['plannings_id']);
            $this->setRoutes_id($data['routes_id']);
            $this->setPreferences_id($data['preferences_id']);
            $this->setCompanies_id($data['companies_id']);
      }
      /**
       * Retourne un tableau avec l'ensemble des champs permettant d'hydrater l'objet et leur valeur actuelle
       */
      public function getData(){
            return ['users_id'=>$this->id(),'users_name'=>$this->name(),'users_email'=>$this->email(),'users_password'=>$this->password(),'users_created_at'=>$this->created_at(),'users_birthday'=>$this->birthday(),'users_phone'=>$this->phone(),'plannings_id'=>$this->plannings_id(),'routes_id'=>$this->routes_id(),'preferences_id'=>$this->preferences_id(),'companies_id'=>$this->companies_id(),];
      }
      public function id(){
            return htmlspecialchars($this->id);
      }
      public function setId($value){
            $value>0 ? $this->id = $value : $this->id = 0;
      }
      public function name(){
            return htmlspecialchars($this->name);
      }
      public function setName($value){
            $value ? $this->name = $value : $this->name = 0;
      }
      public function password(){
            return htmlspecialchars($this->password);
      }
      public function setPassword($value){
            $value ? $this->password = $value : $this->password = 0;
      }
      public function email(){
            return htmlspecialchars($this->email);
      }
      public function setEmail($value){
            $value ? $this->email = $value : $this->email = 0;
      }
      public function created_at(){
            return htmlspecialchars($this->created_at);
      }
      public function setCreated_at($value){
            $value ? $this->created_at = $value : $this->created_at = 0;
      }
      public function birthday(){
            return htmlspecialchars($this->birthday);
      }
      public function setBirthday($value){
            $value ? $this->birthday = $value : $this->birthday = 0;
      }
      public function phone(){
            return htmlspecialchars($this->phone);
      }
      public function setPhone($value){
            $value ? $this->phone = $value : $this->phone = 0;
      }
      public function plannings_id(){
            return htmlspecialchars($this->plannings_id);
      }
      public function setPlannings_id($value){
            $value ? $this->plannings_id = $value : $this->plannings_id = 0;
      }
      public function routes_id(){
            return htmlspecialchars($this->routes_id);
      }
      public function setRoutes_id($value){
            $value ? $this->routes_id = $value : $this->routes_id = 0;
      }
      public function preferences_id(){
            return htmlspecialchars($this->preferences_id);
      }
      public function setPreferences_id($value){
            $value ? $this->preferences_id = $value : $this->preferences_id = 0;
      }
      public function companies_id(){
            return htmlspecialchars($this->companies_id);
      }
      public function setCompanies_id($value){
            $value ? $this->companies_id = $value : $this->companies_id = 0;
      }
}
