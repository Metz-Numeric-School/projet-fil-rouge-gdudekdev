<?php 

namespace Api\Controller;

use Api\Model\ApiFetchModel;
use Core\Model\Auth;

class ApiFetchController{

      public function handleFetch(array $data){
            $id = Auth::getInstance()->protectApiAccess($data);

            if(isset($data['body']['table'])){
                  $model = new ApiFetchModel;
                  $model->handleFetch($data['body']['table'],$id);
            }else{
                  http_response_code(400);
                  die('Requête non conforme');
            }
      }
      
}