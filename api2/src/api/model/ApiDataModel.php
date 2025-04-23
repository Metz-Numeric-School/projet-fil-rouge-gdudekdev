<?php 

namespace Api\Model;

use Core\Model\Database;
use Error;

class ApiDataModel{

      public function handleData($table, $id){
            try{  
                  $user = Database::getInstance()->getOneFrom('accounts','accounts_id',$id);
                  var_dump($user);
                  // TODO a finir
                  $recordset = Database::getInstance()->getOneFrom($table,$table . '_id',$id);
                  var_dump($recordset);
                  // echo json_encode([
                  //       "token" => $token
                  // ]);
            } catch(Error $e){
                  http_response_code(400);
                  throw $e("Requête non conforme");
            }
                  
      }
      
}