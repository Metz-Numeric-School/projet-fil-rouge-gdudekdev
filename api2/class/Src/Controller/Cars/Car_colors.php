<?php

namespace Src\Back\Cars\Controller;

use Src\Controller\Auth;


class Car_colors
{
      public static $table = 'car_colors';
      public static $title = 'Page de gestion des Couleurs des véhicules';
      public function handle($url)
      {
            Auth::getInstance()->protect();
            $title = "Page de gestion des Marques";
            $model = new \Src\Back\Cars\Model\Car_colors;
            extract($model->handle($url));
            include __DIR__ . '/../view/car_colors/car_colors.php';
      }
}
