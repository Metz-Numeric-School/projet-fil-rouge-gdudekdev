<?php

namespace App\Controller;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Class\Chat;
use Core\Class\Database;

class ChatManager {
    private static $instance = null;

    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getById($value){
        return Database::getInstance()->getOneFrom('chats', 'chats_id', $value);
    }

    public function delete(int $value){
        Database::getInstance()->delete('chats', $value);
    }

    public function save(array $data){
        $obj = new Chat($data);
        if (empty($obj->chats_id())) {
            $this->add($obj);
        } else {
            $this->update($obj);
        }
    }

    private function update(Chat $obj){
        $data = $obj->getData();
        Database::getInstance()->update('chats', $data);
    }

    private function add(Chat $obj){
        $data = $obj->getData();
        Database::getInstance()->add('chats', $data);
    }

    public function blank($data = null){
        $obj = new Chat($data);
        return $obj->getData();
    }

    public function createObj($data = null){
        return new Chat($data);
    }
}
