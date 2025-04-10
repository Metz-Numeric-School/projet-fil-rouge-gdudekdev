<?php

namespace App\Controller;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Class\Route;
use Core\Class\Database;

class RouteManager {
    private static $instance = null;

    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getById($value){
        return Database::getInstance()->getOneFrom('routes', 'routes_id', $value);
    }

    public function delete(int $value){
        Database::getInstance()->delete('routes', $value);
    }

    public function save(array $data){
        $obj = new Route($data);
        if ($obj->routes_id() == 0) {
            $this->add($obj);
        } else {
            $this->update($obj);
        }
    }

    private function update(Route $obj){
        $data = $obj->getData();
        Database::getInstance()->update('routes', $data);
    }

    private function add(Route $obj){
        $data = $obj->getData();
        Database::getInstance()->add('routes', $data);
    }

    public function blank($data = null){
        $obj = new Route($data);
        return $obj->getData();
    }

    public function createObj($data = null){
        return new Route($data);
    }
}
