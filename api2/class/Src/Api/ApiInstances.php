<?php

namespace Src\Api;

use App;

class ApiInstances
{

      public function request($request)
      {

            $token = Api::protectApiQuery($request);

            if($query = $this->dbQuery($token->sub)){
                  Api::apiResponse(['response'=> $query]);
            }else{
                  http_response_code(403);
                  Api::apiResponse(['error'=>'Permission not granted']);
            }

      }
      public function dbQuery($id)
      {
            $sql = "SELECT instances_id, instances.rides_id, instances_status, instances_departure, instances_departure_time, instances_destination, instances_driver_id
                      FROM (instances INNER JOIN rides ON instances.rides_id = rides.rides_id ) INNER JOIN routes ON rides.routes_id = routes.routes_id
                     WHERE accounts_id =:id AND instances_departure_time BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
                     ORDER BY instances_departure_time ASC";
            $bound = [':id' => $id];
            return App::$db->query($sql, $bound);
      }
}