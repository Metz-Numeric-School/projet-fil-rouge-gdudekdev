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
      /**
       * Retourne un tableau avec l'ensemble des champs permettant d'hydrater l'objet et leur valeur actuelle
       */
      public function getData(){
            return ['id'=>$this->id(),'name'=>$this->name(),'username'=>$this->username(),'password'=>$this->password(),'created_at'=>$this->created_at];
      }
      /**
       * @param $data: tableau associatif contenant au minimum les champs de l'utilisateur (issu d'un formulaire du CRUD à priori)
       * 
       * Renvoie un tableau associatif à l'image de l'utilisateur dans la base de données, permet des instanciations de User->hydrate($dat) plus facile 
       */
      public static function setData(array $data){
            return ['id'=>$data['id'],'name'=>$data['name'],'username'=>$data['username'],'password'=>$data['password'],'created_at'=>$data['created_at']];
      }

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
