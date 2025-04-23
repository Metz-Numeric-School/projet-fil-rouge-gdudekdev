<?php

namespace Back\Controller;

use Core\Model\Auth;

class LogoutController
{
      public function handleLogout()
      {
                  Auth::getInstance()->disconnect();
      }
}
