<?php 
namespace App\Controller;
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Config\Config;
// TODO extends Manager sur les managers basiques si nécessaire
class Manager{
      private static $instance = null;
      private $controllers = [];

      private function __construct()
      {     
            foreach(array_keys(Config::TABLE_CONFIG) as $table){
                  $manager  = 'App\\Controller\\' . ucfirst(substr($table,0,-1)) . 'Manager';
                  $this->controllers[$table] = $manager::getInstance();
            }
      }

      public static function getInstance(){
            if(is_null(self::$instance)){
                  self::$instance = new Manager;
            }
            return self::$instance;
      }
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