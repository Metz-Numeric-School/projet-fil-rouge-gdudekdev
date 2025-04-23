<?php

namespace Observer\Accounts;

use Core\Model\Database;

class AccountsObserver
{
      private static $instance = null;

      public static function getInstance()
      {
            if (is_null(self::$instance)) {
                  self::$instance = new self;
            }
            return self::$instance;
      }

      public function notify($action, $params)
      {
            switch ($action) {
                  case 'delete':
                        $this->delete($params);
                        break;
                  case 'add':
                        echo "cas de l'ajout";
                        $this->add();
                        break;
            }
      }

      public function delete($params)
      {
            $account = Database::getInstance()->getOneFrom('accounts', 'accounts_id',$params);
            foreach($account as $k=>$v){
                  if(str_contains($k,'_id') && 'accounts'!=str_replace('_id','',$k)){
                        Database::getInstance()->delete(str_replace('_id','',$k),$v);
                  }
            }
      }
      public function add()
      {
            $id = Database::getInstance()->getLastInserted('accounts');
            $account = Database::getInstance()->getOneFrom('accounts','accounts_id',$id);
            foreach($account as $k=>$v){

                  if(str_contains($k,'_id') && 'accounts'!=str_replace('_id','',$k)){
                        $currentTable = str_replace('_id','',$k);
                        $tableFields = Database::getInstance()->getBlankInput($currentTable);
                        Database::getInstance()->add($currentTable,$tableFields);
                        $addedContentId = Database::getInstance()->getLastInserted($currentTable);
                        $account[$k] = $addedContentId;
                  }
            }
            Database::getInstance()->update('accounts',$account);
      }
}
