<?php

namespace Src\Model;

use App;

class Preferences extends Model
{
      public static $table = 'preferences';
     
      protected static function update_show($id)
      {
            $preference = self::newEntity(self::get($id));
            $preferences = Preferences::getAll();
            return
                  compact([ "preferences","preference"]);
      }
      protected static function add_show()
      {
            $preference = self::newEntity();
            return
                  compact(["preference"]);
            
      }
      protected static function all_show()
      {
            return
                  [
                        "preferences" => Preferences::getAll(),
                  ];
      }
}
