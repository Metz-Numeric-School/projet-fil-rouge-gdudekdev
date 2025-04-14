<?php

namespace App\Controller\Managers;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Class\Ride;
use Core\Class\Database;

class RideManager {
    private static $instance = null;

    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getById($value){
        return Database::getInstance()->getOneFrom('rides', 'rides_id', $value);
    }

    public function delete(int $value){
        Database::getInstance()->delete('rides', $value);
    }

    public function save(array $data){
        $obj = new Ride($data);
        if ($obj->rides_id() == 0) {
            $this->add($obj);
        } else {
            $this->update($obj);
        }
    }

    private function update(Ride $obj){
        $data = $obj->getData();
        Database::getInstance()->update('rides', $data);
    }

    private function add(Ride $obj){
        $data = $obj->getData();
        Database::getInstance()->add('rides', $data);
    }

    public function blank($data = null){
        $obj = new Ride($data);
        return $obj->getData();
    }

    public function createObj($data = null){
        return new Ride($data);
    }
}
