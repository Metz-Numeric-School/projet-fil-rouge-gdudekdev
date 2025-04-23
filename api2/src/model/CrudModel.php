<?php 
namespace Model;

use Core\Class\Database;

class CrudModel{

      public function handleCrud(string $table){
            $recordset =Database::getInstance()->getAllFrom($table);
            return $recordset;
      }
}