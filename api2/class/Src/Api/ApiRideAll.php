<?php

namespace Src\Api;

use App;

class ApiRideAll
{

      public function request($request)
      {

            $token = Api::protectApiQuery($request);

            $id = $token->sub;

            if ($query = $this->dbQuery($id)) {
                  Api::apiResponse(['response' => $query]);
            } else {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not grantedd']);
            }

      }
      public function dbQuery($id)
      {
            $sql = "SELECT rides_id, rides_departure_time, planifications_start,planifications_end, rides_status,rides_position,rides_seats,planifications_pattern_type, planifications_days_of_week,planifications_interval_weeks,routes_departure,routes_destination, vehicules_id
                      FROM 
                      (rides INNER JOIN routes ON rides.routes_id = routes.routes_id ) 
                      INNER JOIN  planifications ON rides.planifications_id = planifications.planifications_id
                      INNER JOIN accounts ON routes.accounts_id=accounts.accounts_id
                     WHERE accounts.accounts_id = :id ";
            $bound = [':id' => $id];
            return App::$db->query($sql, $bound);
      }
}