<?php 

namespace Back\Model;

use Core\Model\Database;

class AccountsModel{
      public function handle($params){
            if(isset($params['id'])){
                  $recordset = Database::getInstance()->getOneFrom('accounts','accounts_id',$params['id']);
                  $role = $this->fetchRoles();
                  $recordset = [
                        "accounts"->$recordset,
                  ]
            }else{
                  $recordset =Database::getInstance()->getAllFrom("accounts");
            }
            return $recordset;
      }
      private function fetchRoles(){
            return Database::getInstance()->getAllFrom('roles');
      }
}