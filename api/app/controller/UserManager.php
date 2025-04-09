<?php 
namespace App\Controller;
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Class\User;
use Core\Class\Database;

class UserManager{
// TODO faire un abstract de User Manager extends 
      private static $instance = null;

      public static function getInstance(){
            if(is_null(self::$instance)){
                  self::$instance = new self;
            }
            return self::$instance;
      }
      // TODO regarder l'histoire du clonage, __clone , __set, __get

      public function getById($value){
            return Database::getInstance()->getOneFrom("users","users_id",$value);
      }
      
      /**
       * @param value : identifiant de l'utilisateur dans la BDD
       */
      public function delete(int $value){
            Database::getInstance()->delete('users',$value);
      }
      public function save(array $data){
            $user = new User($data);
            if($user->id() == 0){
                  $this->add($user);
            }else{
                  $this->update($user);
            }
      }
      private function update(User $user){
            $data = $user->getData();
            Database::getInstance()->update('users',$data);
      }
      private function add(User $user){
            $value = $user->getData();
            Database::getInstance()->add('users',$value);
      }

      public function blank($data=null){
            $obj = new User($data);
            return $obj->getData();
      }
      public function createObj($data =null){
            return new User($data);
      }
}