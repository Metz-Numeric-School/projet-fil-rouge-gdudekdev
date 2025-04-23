<?php 

namespace Api\Controller;

use Api\Model\ApiDataModel;
use Core\Model\Auth;

class ApiDataController{

      public function handleData(array $data){
            $id = Auth::getInstance()->protectApiAccess($data);

            if(isset($data['body']['table'])){
                  $model = new ApiDataModel;
                  $model->handleData($data['body']['table'],$id);
            }else{
                  http_response_code(400);
                  die('Requête non conforme');
            }
      }
      
}