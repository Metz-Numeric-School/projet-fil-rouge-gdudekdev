<?php

namespace Src\Back\Cars\Controller;

use Src\Controller\Auth;


class Cars
{
      public function handle($url)
      {
            Auth::getInstance()->protect();
            $title = "Gestion des véhicules";
            if (isset($url['sub'])) {
                  switch ($url['sub']) {
                        case 'brands';
                              $controller = new Car_brands;
                              $controller->handle($_GET);
                              break;
                        case 'colors';
                              $controller = new Car_colors;
                              $controller->handle($_GET);
                              break;
                        case 'engines';
                              $controller = new Car_engines;
                              $controller->handle($_GET);
                              break;
                  }
            } else {
                  include __DIR__ . '/../view/cars.php';
            }
      }
}
