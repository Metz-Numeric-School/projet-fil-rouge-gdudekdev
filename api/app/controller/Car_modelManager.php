<?php

namespace App\Controller;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Class\Car_model;
use Core\Class\Database;

class Car_modelManager {
    private static $instance = null;

    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getById($value){
        return Database::getInstance()->getOneFrom('car_models', 'car_models_id', $value);
    }

    public function delete(int $value){
        Database::getInstance()->delete('car_models', $value);
    }

    public function save(array $data){
        $obj = new Car_model($data);
        if ($obj->car_models_id() == 0) {
            $this->add($obj);
        } else {
            $this->update($obj);
        }
    }

    private function update(Car_model $obj){
        $data = $obj->getData();
        Database::getInstance()->update('car_models', $data);
    }

    private function add(Car_model $obj){
        $data = $obj->getData();
        Database::getInstance()->add('car_models', $data);
    }

    public function blank($data = null){
        $obj = new Car_model($data);
        return $obj->getData();
    }

    public function createObj($data = null){
        return new Car_model($data);
    }
}
