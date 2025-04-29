<?php

namespace Back\Controller;

use Back\Model\AccountsModel;
use Core\Model\Auth;

class AccountsController
{

      public function handle()
      {
            Auth::getInstance()->protect();
            $model = new AccountsModel;
            $recordset = $model->handle();

            include __DIR__ . '/../view/accounts.php';
      }
}
