<?php

namespace App\Controller\Managers;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Class\Car_brand;
use Core\Class\Database;

class Car_brandManager {
    private static $instance = null;

    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getById($value){
        return Database::getInstance()->getOneFrom('car_brands', 'car_brands_id', $value);
    }

    public function delete(int $value){
        Database::getInstance()->delete('car_brands', $value);
    }

    public function save(array $data){
        $obj = new Car_brand($data);
        if ($obj->car_brands_id() == 0) {
            $this->add($obj);
        } else {
            $this->update($obj);
        }
    }

    private function update(Car_brand $obj){
        $data = $obj->getData();
        Database::getInstance()->update('car_brands', $data);
    }

    private function add(Car_brand $obj){
        $data = $obj->getData();
        Database::getInstance()->add('car_brands', $data);
    }

    public function blank($data = null){
        $obj = new Car_brand($data);
        return $obj->getData();
    }

    public function createObj($data = null){
        return new Car_brand($data);
    }
}
