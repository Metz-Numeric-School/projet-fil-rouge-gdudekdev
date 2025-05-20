<?php

namespace Src\Model;

use App;

class Car_models extends Model
{
      public static $table = 'car_models';
      public static $dependencies = ['vehicules'];
      protected static function update_show($id)
      {
            $car_brand = new \Src\Entity\Car_brands(App::$db->getOneFrom('car_brands', 'car_brands_id', $id));
            $car_brand = Car_brands::get($id);
            $models = Car_models::getAll();
            $models = App::$db->getAllFromWhere('car_models', ['stmt' => 'car_brands_id =:car_brands_id', 'params' => [':car_brands_id' => $car_brand->id()]]);
            return
                  compact(["car_brand", "models"], ["car_brand", "models"]);
      }
      protected static function add_show()
      {
            $car_brand = new \Src\Entity\Car_brands();
            return
                  compact(["car_brand"]);

      }
      protected static function all_show()
      {
            return
                  [
                        "car_brands" => self::getAll(),
                  ];
      }
}
