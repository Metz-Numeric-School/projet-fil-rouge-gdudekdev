<?php

namespace Src\Model;

use App;

class Car_colors extends Model
{
      public static $table = 'car_colors';
      public static $dependencies = ['vehicules'];
      protected static function all_show()
      {
            return
                  [
                        "colors" => Car_colors::getAll(),
                  ];
      }
}
