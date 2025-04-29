<?php 

namespace Back\Model;

use Core\Model\Database;

class AccountsModel{
      public function handle($params){
            if(isset($params['id']))
            $recordset =Database::getInstance()->getAllFrom("accounts");
            return $recordset;
      }
}