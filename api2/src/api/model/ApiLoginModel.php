<?php 

namespace Api\Model;

use Core\Model\Auth;

class ApiLoginModel{

      public function handleLogin(array $data){
            Auth::getInstance()->verifyApiAccess($data['body']['email'],$data['body']['password']);
      }
      
}