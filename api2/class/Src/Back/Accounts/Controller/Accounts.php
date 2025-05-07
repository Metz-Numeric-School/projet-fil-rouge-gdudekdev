<?php

namespace Src\Back\Accounts\Controller;

use Src\Controller\Auth;


class Accounts
{
      public function handle($url)
      {
            Auth::getInstance()->protect();
            $title = "Page de gestion des Utilisateurs";
            $model = new \Src\Back\Accounts\Model\Accounts;
            extract($model->handle($url));
            if (isset($url['id'])) {
                  include __DIR__ . '/../view/accounts_detail.php';
            } else if (isset($url['add'])) {
                  include __DIR__ . '/../view/accounts_create.php';
            } else {
                  include __DIR__ . '/../view/accounts.php';
            }
      }
}
