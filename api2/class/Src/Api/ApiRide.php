<?php

namespace Src\Api;

use App;

class ApiRide
{

      public function request($request)
      {

            $token = Api::protectApiQuery($request);
            if (empty($request['body']['ride_id'])) {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not granted']);
            }

            $ride_id = $request['body']['id'];
            $id = $token->sub;

            if (!$this->hasPermission($id, $ride_id)) {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not granted']);
            }
            if ($query = $this->dbQuery($ride_id)) {
                  Api::apiResponse(['response' => $query]);
            } else {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not grantedd']);
            }

      }
      public function hasPermission($id, $ride_id)
      {
            $sql = "SELECT instances_id, instances_driver_id
                      FROM (rides INNER JOIN routes ON rides.routes_id = routes.routes_id ) INNER JOIN accounts ON rides.accounts_id = accounts.accounts_id
                     WHERE rides_id =:ride_id AND instances_departure_time BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
                     ORDER BY instances_departure_time ASC";
            $bound = [':ride_id' => $ride_id];
            $account = App::$db->query($sql, $bound, false);
            if (empty($account)) {
                  return false;
            }

            return $account['accounts_id'] == $id;
      }
      public function dbQuery($id)
      {
            $sql = "SELECT rides_departure_time, rides_planifications_start,rides_planifications_end, rides_status,rides_position,rides_seats,planifications_pattern_type, planifications_days_of_week,planifications_interval_weeks,routes_departure,routes_destination, vehicules_id
                      FROM 
                      (instances INNER JOIN routes ON rides.routes_id = routes.routes_id ) 
                      INNER JOIN  planifications ON rides.planifications_id = planifications.planifications_id
                     WHERE rides_id = :id ";
            $bound = [':id' => $id];
            return App::$db->query($sql, $bound);
      }
}