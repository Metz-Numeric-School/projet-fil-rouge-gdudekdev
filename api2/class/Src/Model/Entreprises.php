<?php

namespace Src\Model;

use App;

class Entreprises extends Model
{
      public static $table = 'entreprises';
      protected static function update_show($id)
      {
            $entreprise =self::newEntity(self::get($id));
            $division = Divisions::getAllWhere('entreprises_id', $entreprise->id());
            return
                  compact(["entreprise", "division"]);
      }
      protected static function add_show(): array
      {
            $entreprise = self::newEntity();
            return
                  compact(["entreprise"], ["entreprise"]);
      }
      protected static function all_show(): array
      {
            return
                  [
                        "entreprises" => Entreprises::getAll(),
                  ];
      }
}