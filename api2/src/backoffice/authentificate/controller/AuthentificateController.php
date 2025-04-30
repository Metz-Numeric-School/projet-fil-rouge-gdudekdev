<?php

namespace Back\Authentificate;

use Core\Model\Auth;

class AuthentificateController
{

      public function handleAuthentificate($data,$params = null)
      {     
            if (isset($data['username']) && isset($data['password'])) {
                  $this->handleLogin($data);
            }
            if(isset($params['logout']) && $params['logout']==true){
                  $this->handleLogout();
                  
            }
            require __DIR__ . '/../view/authentificate.php';
      }

      private function handleLogin(array $data)
      {
            Auth::getInstance()->verify($data['username'], $data['password']);
            header('Location: /index.php?page=home');
            exit();
           
      }
      private function handleLogout()
      {
            Auth::getInstance()->disconnect();
      }
}
