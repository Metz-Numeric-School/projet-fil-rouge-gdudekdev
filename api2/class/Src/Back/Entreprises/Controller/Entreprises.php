<?php

namespace Src\Back\Entreprises\Controller;

use Src\Controller\Auth;


class Entreprises
{
      public function handle($params)
      {
            Auth::getInstance()->protect();
            $title = "Page de gestion des Entreprises";
            $model = new \Src\Back\Entreprises\Model\Entreprises;
            extract($model->handle($params));
            if (isset($params['GET']['id'])) {
                  include __DIR__ . '/../view/entreprises_detail.php';
            } else if (isset($params['GET']['add'])) {
                  include __DIR__ . '/../view/entreprises_create.php';
            } else {
                  include __DIR__ . '/../view/entreprises.php';
            }
      }
}
