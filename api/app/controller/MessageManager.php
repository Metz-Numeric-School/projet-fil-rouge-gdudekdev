<?php

namespace App\Controller;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Class\Message;
use Core\Class\Database;

class MessageManager {
    private static $instance = null;

    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getById($value){
        return Database::getInstance()->getOneFrom('messages', 'messages_id', $value);
    }

    public function delete(int $value){
        Database::getInstance()->delete('messages', $value);
    }

    public function save(array $data){
        $obj = new Message($data);
        if ($obj->id() == 0) {
            $this->add($obj);
        } else {
            $this->update($obj);
        }
    }

    private function update(Message $obj){
        $data = $obj->getData();
        Database::getInstance()->update('messages', $data);
    }

    private function add(Message $obj){
        $data = $obj->getData();
        Database::getInstance()->add('messages', $data);
    }

    public function blank($data = null){
        $obj = new Message($data);
        return $obj->getData();
    }

    public function createObj($data = null){
        return new Message($data);
    }
}
