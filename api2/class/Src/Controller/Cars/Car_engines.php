<?php

namespace Src\Back\Cars\Controller;

use Src\Controller\Auth;


class Car_engines
{
      public function handle($url)
      {
            Auth::getInstance()->protect();
            $title = "Page de gestion des Marques";
            $model = new \Src\Back\Cars\Model\Car_engines;
            extract($model->handle($url));
            include __DIR__ . '/../view/car_engines/car_engines.php';
      }
}
