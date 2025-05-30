<?php
namespace Src\Model;

use App;

class Car_engines extends Model
{
      public static $table = 'car_engines';
      protected static function all_show()
      {
            return
                  [
                        "engines" => Car_engines::getAll(),
                  ];
      }
}
