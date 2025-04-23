<?php

namespace Back\Controller;

use Core\Model\Auth;

class LoginController
{
      public function handleLogin(array $data)
      {
            if (isset($data['username']) && isset($data['password'])) {
                  Auth::getInstance()->verify($data['username'], $data['password']);
                  header('Location: /index.php?page=home');
                  exit();
            }
            require __DIR__ . '/../view/login.php';
      }
}
