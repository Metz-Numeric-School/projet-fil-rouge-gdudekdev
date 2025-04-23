<?php 

namespace Controller;

use Model\CrudModel;

class CrudController{

      public function handleCrud($data){
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