<?php

namespace Src\Back\Accounts\Controller;

use Src\Controller\Auth;


class Accounts
{
      public function handle($params)
      {
            Auth::getInstance()->protect();
            $title = "Page de gestion des Utilisateurs";
            $model = new \Src\Back\Accounts\Model\Accounts;
            extract($model->handle($params));
            if (isset($params['GET']['id'])) {
                  include __DIR__ . '/../view/accounts_detail.php';
            } else if (isset($params['GET']['add'])) {
                  include __DIR__ . '/../view/accounts_create.php';
            } else {
                  include __DIR__ . '/../view/accounts.php';
            }
      }
}
