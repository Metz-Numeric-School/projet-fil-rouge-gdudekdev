<?php
namespace Src\Model;

use App;

class Car_engines extends Model
{
      public static $table = 'car_engines';
      public static $dependencies = ['vehicules'];
      protected static function all_show()
      {
            return
                  [
                        "engines" => App::$db->getAllFrom("car_engines"),
                  ];
      }
}
