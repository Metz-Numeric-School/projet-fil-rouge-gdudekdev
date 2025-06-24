<?php

namespace Src\Model;

use App;

class Planifications extends Model
{
      public static $table = 'planifications';

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
                  var_dump($newPlanification);
                  App::$db->add('planifications', $newPlanification);
                  return App::$db->getLastInserted();
            }
      }

      protected static function findOne($criteria)
      {
            $closure_value = [];
            $closure = [];
            foreach ($criteria as $key => $value) {
                  $closureKey = ':' . $key;
                  $closure[] = self::$table . '_' . $key . '=' . $closureKey;
                  $closure_value[$closureKey] = $value;
            }
            $closure = implode(" AND ", $closure);

            return App::$db->getAllFromWhere('planifications', ['stmt' => $closure, 'params' => $closure_value]);
      }

}
