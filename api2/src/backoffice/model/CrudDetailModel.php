<?php 
namespace Back\Model;

use Core\Model\Database;

class CrudDetailModel{
      public function handleCrudDetail(string $table, $id){
            $recordset =Database::getInstance()->getOneFrom($table,$table . '_id',$id);
            return $recordset;
      }
}