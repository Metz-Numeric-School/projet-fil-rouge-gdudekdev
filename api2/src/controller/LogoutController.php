<?php

namespace Controller;

use Core\Class\Auth;

class LogoutController
{
      public function handleLogout()
      {
                  Auth::getInstance()->disconnect();
                  header('Location: /index.php?page=login');
                  exit();
      }
}
