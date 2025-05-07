<?php

namespace Src\Back\Authenticate\Controller;

use Src\Controller\Auth;


class Authenticate
{
      public function authenticate($data,$params = null)
      {     
            if (isset($data['email']) && isset($data['password'])) {
                  $this->login($data);
            }
            if(isset($params['logout']) && $params['logout']==true){
                  $this->logout();
                  
            }
            require dirname(__DIR__) . '/view/authentificate.php';
      }

      private function login(array $data)
      {
            Auth::getInstance()->verify($data['email'], $data['password']);
            header('Location: /index.php?page=home');
            exit();
           
      }
      private function logout()
      {
            Auth::getInstance()->disconnect();
      }
}
