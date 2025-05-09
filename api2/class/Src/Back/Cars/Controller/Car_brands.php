<?php

namespace Src\Back\Cars\Controller;

use Src\Controller\Auth;


class Car_brands
{
      public function handle($url)
      {
            Auth::getInstance()->protect();
            $title = "Page de gestion des Marques";
            $model = new \Src\Back\Cars\Model\Car_brands;
            extract($model->handle($url));
            if (isset($url['id'])) {
                  include __DIR__ . '/../view/car_brands/car_brands_detail.php';
            } else if (isset($url['add'])) {
                  include __DIR__ . '/../view/car_brands/car_brands_create.php';
            } else {
                  include __DIR__ . '/../view/car_brands/car_brands.php';
            }
      }
}
