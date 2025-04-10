<?php

namespace App\Controller;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Class\Preference;
use Core\Class\Database;

class PreferenceManager {
    private static $instance = null;

    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getById($value){
        return Database::getInstance()->getOneFrom('preferences', 'preferences_id', $value);
    }

    public function delete(int $value){
        Database::getInstance()->delete('preferences', $value);
    }

    public function save(array $data){
        $obj = new Preference($data);
        if ($obj->preferences_id() == 0) {
            $this->add($obj);
        } else {
            $this->update($obj);
        }
    }

    private function update(Preference $obj){
        $data = $obj->getData();
        Database::getInstance()->update('preferences', $data);
    }

    private function add(Preference $obj){
        $data = $obj->getData();
        Database::getInstance()->add('preferences', $data);
    }

    public function blank($data = null){
        $obj = new Preference($data);
        return $obj->getData();
    }

    public function createObj($data = null){
        return new Preference($data);
    }
}
