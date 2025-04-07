<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/class/Database.php";

class UserManager{

      private static $instance = null;

      private  $listUser = [];//TODO est ce que c'est vraiment utile  ?? 

      private function __construct(){
            
      }

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

      public function update(array $object){
            Database::getInstance()->update('users',$object);
      }
}