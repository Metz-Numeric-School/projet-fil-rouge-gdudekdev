<?php

namespace Src\Model;

use App;

class Planifications extends Model
{
      public static $table = 'planifications';
      public static $dependencies = ['rides'];
      private function update_show($id)
      {
            $entreprise = new \Src\Entity\planifications(App::$db->getOneFrom('planifications', 'planifications_id', $id));
            $planification = App::$db->getAllFromWhere('planifications', ['stmt' => 'planifications_id =:planifications_id', 'params' => [':planifications_id' => $entreprise->id()]]);
            return
                  compact(["planification"], ["planification"]);
      }
      private function add_show()
      {
            $entreprise = new \Src\Entity\planifications();
            return
                  compact(["entreprise"], ["entreprise"]);

      }
      private function all_show()
      {
            return
                  [
                        "planifications" => App::$db->getAllFrom("planifications"),
                  ];
      }
}
