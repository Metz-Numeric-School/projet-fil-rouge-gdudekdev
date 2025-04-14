<?php

namespace App\Controller\Managers;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Class\Rating;
use Core\Class\Database;

class RatingManager {
    private static $instance = null;

    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getById($value){
        return Database::getInstance()->getOneFrom('ratings', 'ratings_id', $value);
    }

    public function delete(int $value){
        Database::getInstance()->delete('ratings', $value);
    }

    public function save(array $data){
        $obj = new Rating($data);
        if ($obj->ratings_id() == 0) {
            $this->add($obj);
        } else {
            $this->update($obj);
        }
    }

    private function update(Rating $obj){
        $data = $obj->getData();
        Database::getInstance()->update('ratings', $data);
    }

    private function add(Rating $obj){
        $data = $obj->getData();
        Database::getInstance()->add('ratings', $data);
    }

    public function blank($data = null){
        $obj = new Rating($data);
        return $obj->getData();
    }

    public function createObj($data = null){
        return new Rating($data);
    }
}
