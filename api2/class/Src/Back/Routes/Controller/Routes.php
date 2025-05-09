<?php

namespace Src\Back\routes\Controller;

use Src\Controller\Auth;


class routes
{
      public function handle($url)
      {
            Auth::getInstance()->protect();
            $model = new \Src\Back\Routes\Model\Routes;
            extract($model->handle($url));
            $title = "Itinéraires de l'utilisateur"  ;
            if (isset($url['id'])) {
                  include __DIR__ . '/../view/routes_detail.php';
            } else if (isset($url['add'])) {
                  include __DIR__ . '/../view/routes_create.php';
            } else {
                  include __DIR__ . '/../view/routes.php';
            }
      }
}
