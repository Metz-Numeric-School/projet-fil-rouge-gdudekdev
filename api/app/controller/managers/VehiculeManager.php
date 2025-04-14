<?php

namespace App\Controller\Managers;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Class\Vehicule;
use Core\Class\Database;

class VehiculeManager {
    private static $instance = null;

    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getById($value){
        return Database::getInstance()->getOneFrom('vehicules', 'vehicules_id', $value);
    }

    public function delete(int $value){
        Database::getInstance()->delete('vehicules', $value);
    }

    public function save(array $data){
        $obj = new Vehicule($data);
        if ($obj->vehicules_id() == 0) {
            $this->add($obj);
        } else {
            $this->update($obj);
        }
    }

    private function update(Vehicule $obj){
        $data = $obj->getData();
        Database::getInstance()->update('vehicules', $data);
    }

    private function add(Vehicule $obj){
        $data = $obj->getData();
        Database::getInstance()->add('vehicules', $data);
    }

    public function blank($data = null){
        $obj = new Vehicule($data);
        return $obj->getData();
    }

    public function createObj($data = null){
        return new Vehicule($data);
    }
}
