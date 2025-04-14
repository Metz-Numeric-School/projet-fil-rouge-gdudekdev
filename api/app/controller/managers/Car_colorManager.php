<?php

namespace App\Controller\Managers;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Class\Car_color;
use Core\Class\Database;

class Car_colorManager {
    private static $instance = null;

    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getById($value){
        return Database::getInstance()->getOneFrom('car_colors', 'car_colors_id', $value);
    }

    public function delete(int $value){
        Database::getInstance()->delete('car_colors', $value);
    }

    public function save(array $data){
        $obj = new Car_color($data);
        if ($obj->car_colors_id() == 0) {
            $this->add($obj);
        } else {
            $this->update($obj);
        }
    }

    private function update(Car_color $obj){
        $data = $obj->getData();
        Database::getInstance()->update('car_colors', $data);
    }

    private function add(Car_color $obj){
        $data = $obj->getData();
        Database::getInstance()->add('car_colors', $data);
    }

    public function blank($data = null){
        $obj = new Car_color($data);
        return $obj->getData();
    }

    public function createObj($data = null){
        return new Car_color($data);
    }
}
