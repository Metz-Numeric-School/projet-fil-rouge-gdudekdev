<?php 
namespace App\Controller;

use App\class\User;
use Core\Class\Database;

class UserManager{

      private static $instance = null;

      public static function getInstance(){
            if(is_null(self::$instance)){
                  self::$instance = new self;
            }
            return self::$instance;
      }
      // TODO regarder l'histoire du clonage, __clone , __set, __get

      public function getById($value){
            return Database::getInstance()->getOneFrom("users","id",$value);
      }
      
      /**
       * @param value : identifiant de l'utilisateur dans la BDD
       */
      public function delete(int $value){
            Database::getInstance()->delete('users',$value);
      }
      public function save(User $user){
            if($user['id'] == 0){
                  $this->add($user);
            }else{
                  $this->update($user);
            }
      }
      private function update(User $user){
            $object =[
                  'id'=>$user->id(),
                  'name'=>$user->name(),
                  'username'=>$user->username(),
                  'password'=>$user->password(),
                  'created_at'=>$user->id(),
            ];
            Database::getInstance()->update('users',$object);
      }
      private function add(User $user){
            $value = $user->getData();
            Database::getInstance()->add('users',$value);
      }

      public function new($data=null){
            return new User($data);
      }
}