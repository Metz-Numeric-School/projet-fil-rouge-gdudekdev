<?php

namespace App\Controller\Observers;

use App\Controller\Manager;
use Core\Class\Database;

class AccountObserver
{

      private static $instance = null;


      private function __construct() {}

      public static function getInstance()
      {
            if (is_null(self::$instance)) {
                  self::$instance = new self;
            }
            return self::$instance;
      }

      public function handle(array $data)
      {
            if ($data['table'] == 'accounts') {
                  $tables = ['preferences', 'plannings', 'companies', 'routes'];
                  switch ($data['action']) {
                        case 'add':
                              foreach ($tables as $table) {
                                    // Creating an empty dataset without id then add it
                                    $handleTmp = Manager::getInstance()->blankObjFrom($table);
                                    Manager::getInstance()->save($table, $handleTmp);
                                    // Retrieve id from previous add
                                    $lastInsertedId = Database::getInstance()->getLastInserted();
                                    // Fetch account information and update table id (foreign key)
                                    $fetch = Database::getInstance()->getOneFrom('accounts', 'accounts_id', $data['params']['accounts_id']);
                                    $fetch[$table . '_id'] = $lastInsertedId;
                                    Manager::getInstance()->save('accounts', $fetch);
                              }
                              break;
                        case 'delete':
                              $fetch = Database::getInstance()->getOneFrom('accounts','accounts_id',$data['params']);
                              foreach ($tables as $table) {
                                    $id = $fetch[$table .'_id'];
                                    Manager::getInstance()->delete($table, $id);
                              }
                              break;
                  }
            }
      }
}
