<?php

namespace Src\Controller;

class Cars extends Controller
{
      public static $table = 'cars';
      public static $title = 'Page de gestion des Voitures';
      public function handle($url, $data)
      {
            Auth::getInstance()->protect();
            $title = "Gestion des véhicules";
            if (isset($url['sub'])) {
                  switch ($url['sub']) {
                        case 'brands':
                              $controller = new Car_brands;
                              $controller->handle($url, $data);
                              break;
                        case 'colors':
                              $controller = new Car_colors;
                              $controller->handle($url, $data);
                              break;
                        case 'engines':
                              $controller = new Car_engines;
                              $controller->handle($url, $data);
                              break;
                        case 'models':
                              $controller = new Car_models;
                              $controller->handle($url, $data);
                              break;
                  }
            } else {
                  include ROOT . '/view/Cars/cars.php';
            }
      }
}
