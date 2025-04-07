<?php


class User
{
      private $id = 0;
      private $name = '';
      private $username = '';
      private $password = '';
      private $created_at = '';

      /**
       * $data = [
       *    'id' = 0;
       *    'name' = '';
       *    'username' = '';
       *    'password' = '';
       *    'created_at' ='';
       * ]
       */
      public function __construct($data = null)
      {
            if ($data) {
                  $this->hydrate($data);
            }
      }

      private function hydrate($data)
      {
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->username = $data['username'];
            $this->password = $data['password'];
            $this->created_at = $data['created_at'];
      }


      // TODO ajout d'un manager pour faire les différnetes requeetes nécessaire pour la base de donneé : read / create / delete

      
      public function id(){
            return htmlspecialchars($this->id);
      }
      public function setId(int $value){
            $value>0 ? $this->id = $value : $this->id = 0;
      }
      public function name(){
            return htmlspecialchars($this->name);
      }
      public function setName(string $value){
            $value ? $this->name = $value : $this->name = 0;
      }
      public function password(){
            return htmlspecialchars($this->password);
      }
      public function setPassword(string $value){
            $value ? $this->password = $value : $this->password = 0;
      }
      public function username(){
            return htmlspecialchars($this->username);
      }
      public function setUsername(string $value){
            $value ? $this->username = $value : $this->username = 0;
      }
      public function created_at(){
            return htmlspecialchars($this->created_at);
      }
      public function setCreated_at(string $value){
            $value ? $this->created_at = $value : $this->created_at = 0;
      }
}
