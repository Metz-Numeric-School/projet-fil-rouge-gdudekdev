<?php

namespace Src\Model;

use App;

class Car_brands extends Model
{
      public static $table = 'car_brands';
      public static $dependencies = ['car_models','vehicules'];
      protected static function update_show($id)
      {
            $car_brand = new \Src\Entity\Car_brands(self::get($id));
            $models = Car_models::getAllWhere('car_brands_id', $car_brand->id());
            return
                  compact(["car_brand", "models"]);
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
