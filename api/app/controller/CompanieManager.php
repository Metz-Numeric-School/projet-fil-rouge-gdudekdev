<?php

namespace App\Controller;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Class\Companie;
use Core\Class\Database;

class CompanieManager {
    private static $instance = null;

    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getById($value){
        return Database::getInstance()->getOneFrom('companies', 'companies_id', $value);
    }

    public function delete(int $value){
        Database::getInstance()->delete('companies', $value);
    }

    public function save(array $data){
        $obj = new Companie($data);
        if ($obj->companies_id() == 0) {
            $this->add($obj);
        } else {
            $this->update($obj);
        }
    }

    private function update(Companie $obj){
        $data = $obj->getData();
        Database::getInstance()->update('companies', $data);
    }

    private function add(Companie $obj){
        $data = $obj->getData();
        Database::getInstance()->add('companies', $data);
    }

    public function blank($data = null){
        $obj = new Companie($data);
        return $obj->getData();
    }

    public function createObj($data = null){
        return new Companie($data);
    }
}
