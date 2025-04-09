<?php 
namespace App\Controller;
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Class\User;
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
            Manager::getInstance()->add('planning',self::blank(null));
            // TODO lors de l'ajout d'un utilisateur, il faudrait appler le Manager de la table planning et les autres qui sont en clé étrangères pour créer un champ dans leur table respective. Typiquement, il y aura surement des tables qui n'auront pas vriament besoin d'être supervisées par le Manager, il faudrait voir si il faut leur passé un statut spécial.
            // TODO en fait il faudrait que chaque ajout, modification suppression viennent se répercuter sur toutes les autres tables de manière dynamique


            // TODO voila la prochaine marche a suivre : mettre un observer dynamique sur le manager et créer des supermanager qui subscribe sur les evenements d'ajouts, de supression ...

      }
      

      public function blank($data=null){
            $obj = new User($data);
            return $obj->getData();
      }
      public function createObj($data =null){
            return new User($data);
      }
}