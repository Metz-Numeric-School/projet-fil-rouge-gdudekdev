<?php 
namespace App\Controller;
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Controller\UserManager;
use App\Controller\RideManager;

// TODO __sleep __wakeup
// TODO voir comment gérer les clés étrangères dans l'ajout d'un champ de trajet

/**
 * Pour que le Manager fonctionne, il faut que chaque sous Manager soit instatiable via singleton, il faut aussi qu'il ait tous la méthode new
 */
class Manager{
      private static $instance = null;
      private $controllers = [];

      private function __construct()
      {     
            $this->controllers['users'] = UserManager::getInstance();
            $this->controllers['rides'] = RideManager::getInstance();
      }

      public static function getInstance(){
            if(is_null(self::$instance)){
                  self::$instance = new Manager;
            }
            return self::$instance;
      }
      /**
       * Instancie un objet en  correspondance à la table passée en paramètre (possiblité de l'hydrater via $data)
       */
      public function initClass(string $table,$data = null){
            $obj = ucfirst($table);
            return new $obj($data);
      }
      /**
       * Supprime l'enregistrement correspondant à la clé primaire de ce dernier via le Manager de la table associée
       */
      private function getManagerFrom(string $table){
            return $this->controllers[$table];
      }
      public function delete(string $table , string $id){
            $this->getManagerFrom($table)->delete($id);
      }

      public function blankObjFrom(string $table){
            return $this->getManagerFrom($table)->blank();
      }
      public function save(string $table, array $data){
            $this->getManagerFrom($table)->save($data);
      }
      public function createObj(string $table, $data = null){
            return $this->getManagerFrom($table)->createObj($data);
      }

}