<?php

namespace App\Controller;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Class\Account;
use Core\Class\Database;

class AccountManager {
    private static $instance = null;

    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getById($value){
        return Database::getInstance()->getOneFrom('accounts', 'accounts_id', $value);
    }

    public function delete(int $value){
        Database::getInstance()->delete('accounts', $value);
    }

    public function save(array $data){
        $obj = new Account($data);
        if ($obj->accounts_id() == 0) {
            $this->add($obj);
        } else {
            $this->update($obj);
        }
    }

    private function update(Account $obj){
        $data = $obj->getData();
        Database::getInstance()->update('accounts', $data);
    }

    private function add(Account $obj){
        $data = $obj->getData();
        Database::getInstance()->add('accounts', $data);
    }

    public function blank($data = null){
        $obj = new Account($data);
        return $obj->getData();
    }

    public function createObj($data = null){
        return new Account($data);
    }
}
