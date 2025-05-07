<?php 

namespace Api\Model;

use Core\Model\Database;
use Error;

class ApiFetchModel{

      public function handleFetch($table, $id){
            try{  
                  $user = Database::getInstance()->getOneFrom('accounts','accounts_id',$id);
                  $fetchId = $user[$table . '_id'];
                  $recordset = Database::getInstance()->getOneFrom($table,$table . '_id',$fetchId);
                  echo json_encode([
                        'data'=>$recordset
                  ]);
            } catch(Error $e){
                  http_response_code(400);
                  throw $e("Requête non conforme");
            }
      }
}