<?php

namespace Src\Model;

use App;

class Car_colors extends Model
{
      public static $table = 'car_colors';
      // TODO voir comment gérer la dépendence sur les véhicules des utilsiateurs lors de la suppresion
      public static $dependencies = ['vehicules'];
      protected static function all_show()
      {
            return
                  [
                        "colors" => App::$db->getAllFrom("car_colors"),
                  ];
      }
}
