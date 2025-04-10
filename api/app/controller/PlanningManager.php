<?php

namespace App\Controller;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Class\Planning;
use Core\Class\Database;

class PlanningManager {
    private static $instance = null;

    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getById($value){
        return Database::getInstance()->getOneFrom('plannings', 'plannings_id', $value);
    }

    public function delete(int $value){
        Database::getInstance()->delete('plannings', $value);
    }

    public function save(array $data){
        $obj = new Planning($data);
        if ($obj->plannings_id() == 0) {
            $this->add($obj);
        } else {
            $this->update($obj);
        }
    }

    private function update(Planning $obj){
        $data = $obj->getData();
        Database::getInstance()->update('plannings', $data);
    }

    private function add(Planning $obj){
        $data = $obj->getData();
        Database::getInstance()->add('plannings', $data);
    }

    public function blank($data = null){
        $obj = new Planning($data);
        return $obj->getData();
    }

    public function createObj($data = null){
        return new Planning($data);
    }
}
