<?php

namespace App\Controller;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Config\Config;
use Core\Class\Database;
use Core\Class\Notification;

class Manager
{
      private static $instance = null;
      private $managers = [];
      private $observers = [];

      private function __construct()
      {
            foreach (array_keys(Config::TABLE_CONFIG) as $table) {
                  $manager  = 'App\\Controller\\Managers\\' . ucfirst(substr($table, 0, -1)) . 'Manager';
                  $this->managers[$table] = $manager::getInstance();
            }
            foreach (scandir($_SERVER['DOCUMENT_ROOT'] . '/app/controller/observers') as $file) {
                  if ($file[0] != '.') {
                        $file = str_replace('.php', '', $file);
                        $this->observers[] = '\\App\\Controller\\Observers\\' . $file;
                  }
            }
      }

      public static function getInstance()
      {
            if (is_null(self::$instance)) {
                  self::$instance = new Manager;
            }
            return self::$instance;
      }

      // Observer functions 
      /**
       * This function notify all the observers of the current changes happening
       * @var data : associative array obtained throught create method from Notification class
       */
      private function notify(array $data)
      {     
            foreach ($this->observers as $observer) {
                  $observer::getInstance()->handle($data);
            }
      }

      // Manager functions
      private function getManagerFrom(string $table)
      {
            return $this->managers[$table];
      }
      public function delete(string $table, int $id)
      {
            $data = new Notification($table, 'delete', $id);
            $this->notify($data->create());
            
            $this->getManagerFrom($table)->delete($id);

      }

      public function blankObjFrom(string $table)
      {
            return $this->getManagerFrom($table)->blank();
      }
      public function save(string $table, array $data)
      {     
            $this->getManagerFrom($table)->save($data);
            if($data[$table.'_id']==0){
                  $newId = Database::getInstance()->getLastInserted();
                  $data[$table.'_id'] = $newId;
                  $notif = new Notification($table,'add',$data);
            }else{
                  $notif = new Notification($table, 'update', $data);
            }
            $this->notify($notif->create());
      }
      public function createObj(string $table, $data = null)
      {
            return $this->getManagerFrom($table)->createObj($data);
      }
      public function getObservers()
      {
            var_dump($this->observers);
      }
      public function getAddableData($table)
      {
            $data = Manager::getInstance()->blankObjFrom($table);
            unset($data[$table .  "_id"]);
            return $data;
      }
}
