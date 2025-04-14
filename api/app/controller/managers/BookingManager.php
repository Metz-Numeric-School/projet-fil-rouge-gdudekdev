<?php

namespace App\Controller\Managers;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Class\Booking;
use Core\Class\Database;

class BookingManager {
    private static $instance = null;

    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getById($value){
        return Database::getInstance()->getOneFrom('bookings', 'bookings_id', $value);
    }

    public function delete(int $value){
        Database::getInstance()->delete('bookings', $value);
    }

    public function save(array $data){
        $obj = new Booking($data);
        if ($obj->bookings_id() == 0) {
            $this->add($obj);
        } else {
            $this->update($obj);
        }
    }

    private function update(Booking $obj){
        $data = $obj->getData();
        Database::getInstance()->update('bookings', $data);
    }

    private function add(Booking $obj){
        $data = $obj->getData();
        Database::getInstance()->add('bookings', $data);
    }

    public function blank($data = null){
        $obj = new Booking($data);
        return $obj->getData();
    }

    public function createObj($data = null){
        return new Booking($data);
    }
}
