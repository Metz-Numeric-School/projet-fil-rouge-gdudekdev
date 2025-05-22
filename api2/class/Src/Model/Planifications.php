<?php

namespace Src\Model;

use App;

class Planifications extends Model
{
      public static $table = 'planifications';
      // public static $dependencies = ['rides'];
      private function update_show($id)
      {
            $entreprise = new \Src\Entity\planifications(App::$db->getOneFrom('planifications', 'planifications_id', $id));
            $planification = App::$db->getAllFromWhere('planifications', ['stmt' => 'planifications_id =:planifications_id', 'params' => [':planifications_id' => $entreprise->id()]]);
            return
                  compact(["planification"]);
      }
      private function add_show()
      {
            $entreprise = new \Src\Entity\planifications();
            return
                  compact(["entreprise"]);

      }
      private function all_show()
      {
            return
                  [
                        "planifications" => App::$db->getAllFrom("planifications"),
                  ];
      }

      public static function getOrGeneratePlanificationId($ride)
      {
            $existing = self::findOne([
                  'pattern_type' => $ride['pattern_type'],
                  'days_of_week' => isset($ride['days_of_week']) ? json_encode($ride['days_of_week']) : null,
                  'interval_weeks' => $ride['interval_weeks'] ?? null,
            ]);
            if (!empty($existing)) {
                  return $existing[0]['planifications_id'];
            } else {
                  $newPlanification = [
                        self::$table . '_pattern_type' => $ride['pattern_type'],
                        self::$table . '_days_of_week' => isset($ride['days_of_week']) ? json_encode($ride['days_of_week']) : null,
                        self::$table . '_interval_weeks' => $ride['interval_weeks'] ?? null,
                  ];

                  App::$db->add('planifications', $newPlanification);
                  return App::$db->getLastInserted(); 
            }
      }

      private static function findOne($criteria)
      {
            $closure_value =[];
            $closure = [];
            foreach ($criteria as $key => $value) {
                  $closureKey = ':' . $key;
                  $closure[] = self::$table . '_' . $key .'='.  $closureKey;
                  $closure_value[$closureKey] = $value;
            }
            $closure = implode(" AND ", $closure);

            return App::$db->getAllFromWhere('planifications',['stmt'=>$closure,'params'=>$closure_value]);
      }

}
