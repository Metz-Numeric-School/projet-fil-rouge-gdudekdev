<?php 

namespace Back\Model;

use Core\Model\Database;

class AccountsModel{
      public function handle($params){
            if(isset($params['id'])){
                  $recordset = <Data></Data>
            }
            $recordset =Database::getInstance()->getAllFrom("accounts");
            return $recordset;
      }
}