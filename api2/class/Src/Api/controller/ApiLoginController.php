<?php 

namespace Api\Controller;

use Api\Model\ApiLoginModel;

class ApiLoginController{

      public function handleLogin(array $data){
            if(isset($data['body']['email']) && isset($data['body']['password'])){
                  $model = new ApiLoginModel;
                  $model->handleLogin($data);
            }
      }
      
}