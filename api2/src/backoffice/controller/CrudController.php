<?php 

namespace Back\Controller;

use Back\Model\CrudModel;
use Core\Model\Auth;

class CrudController{

      public function handleCrud($data){
            Auth::getInstance()->protect();
            if(!isset($data['table'])){
                  http_response_code(404);
                  die('Table non existante');
            }
            $model = new CrudModel;
            $table = $data['table'];
            $recordset = $model->handleCrud($table);
            include __DIR__ .'/../view/crud.php';
      }
      
}