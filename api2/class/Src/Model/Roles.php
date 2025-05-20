<?php

namespace Src\Model;

class Roles extends Model
{
      public static $table = 'roles';
      protected static function all_show()
      {
            return
                  [
                        "roles" => self::getAll(),
                  ];
      }
}
