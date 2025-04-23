<?php 
namespace Back\Model;

use Core\Model\Database;

class CrudModel{

      public function handleCrud(string $table){
            $recordset =Database::getInstance()->getAllFrom($table);
            return $recordset;
      }
}