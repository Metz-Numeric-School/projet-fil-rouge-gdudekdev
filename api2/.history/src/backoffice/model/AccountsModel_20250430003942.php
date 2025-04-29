<?php 

namespace Back\Model;

class AccountsModel{
      public function handle(){
            $recordset =Database::getInstance()->getAllFrom("accounts");
            return $recordset;
      }
}