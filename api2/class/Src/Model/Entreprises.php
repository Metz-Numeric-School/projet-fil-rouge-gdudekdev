<?php

namespace Src\Model;

use App;

class Entreprises extends Model
{
      public static $table = 'entreprises';
      public static $dependencies = ['divisions'];
      protected static function update_show($id)
      {
            $entreprise = new \Src\Entity\Entreprises(self::get($id));
            $division = Divisions::getAllWhere('entreprises_id', $entreprise->id());
            return
                  compact(["entreprise","division"]);
      }
      protected static function add_show(): array
      {
            $entreprise = new \Src\Entity\Entreprises();
            return
                  compact(["entreprise"], ["entreprise"]);
      }
      protected static function all_show(): array
      {
            return
                  [
                        "entreprises" => App::$db->getAllFrom("entreprises"),
                  ];
      }
}