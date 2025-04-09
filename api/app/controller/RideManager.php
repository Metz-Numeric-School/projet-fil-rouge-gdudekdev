<?php 
namespace App\Controller;
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Class\Ride;
use Core\Class\Database;

class RideManager{
      private static $instance = null;

      public static function getInstance(){
            if(is_null(self::$instance)){
                  self::$instance = new self;
            }
            return self::$instance;
      }

      public function getById($value){
            return Database::getInstance()->getOneFrom("rides","rides_id",$value);
      }
      
      public function delete(int $id){
            Database::getInstance()->delete('rides',$id);
      }
      public function save(array $data){
            $ride = new Ride($data);
            if($ride->id() == 0){
                  $this->add($ride);
            }else{
                  $this->update($ride);
            }
      }
      private function update(Ride $ride){
            $data = $ride->getData();
            Database::getInstance()->update('rides',$data);
      }
      private function add(Ride $ride){
            $value = $ride->getData();
            Database::getInstance()->add('rides',$value);
      }

      public function blank($data=null){
            $obj = new Ride($data);
            return $obj->getData();
      }
      public function createObj($data =null){
            return new Ride($data);
      }
}