<?php

namespace Back\Controller;

use Back\Model\CrudDetailModel;
use Back\Model\CrudModel;
use Core\Model\Auth;

class CrudDetailController
{
      // TODO faire un extends pour les crud controller ?? 
      public function handleCrudDetail($data)
      {
            Auth::getInstance()->protect();
            if (!isset($data['table'])) {
                  http_response_code(404);
                  die('Table non existante');
            }
            $model = new CrudDetailModel;
            $table = $data['table'];
            $recordset = $model->handleCrudDetail($table,$data['id']);
            include __DIR__ . '/../view/crud_detail.php';
      }
}
