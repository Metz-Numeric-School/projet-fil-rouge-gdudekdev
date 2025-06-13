<?php

namespace Src\Api;

use App;
use Core\Utils\RideFinder;

class ApiRideChoice
{

      public function request($request)
      {
            $token = Api::protectApiQuery($request);

            if (empty($request['body']['id'])) {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not granted']);
            }
            $instance_id = $request['body']['id'];
            $id = $token->sub;

            if (!$this->hasPermission($id, $instance_id)) {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not granted']);
            }
            if ($query = $this->dbQuery($instance_id)) {
                  Api::apiResponse(['response' => $query]);
            } else {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not grantedd']);
            }

      }
      public function dbQuery($instance_id)
      {
            $valid_rides = (new RideFinder)->search($instance_id);
            $query = $this->getRidesInfo($valid_rides);
            return $query;
      }
      protected function hasPermission($id, $instance_id)
      {
            $sql = "SELECT instances_id, instances_driver_id
                      FROM (instances INNER JOIN rides ON instances.rides_id = rides.rides_id ) INNER JOIN routes ON rides.routes_id = routes.routes_id
                     WHERE accounts_id =:id AND instances_departure_time BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
                     ORDER BY instances_departure_time ASC";
            $bound = [':id' => $id];
            $instances = App::$db->query($sql, $bound);
            return in_array($instance_id, array_column($instances, 'instances_id'));

      }
      protected function getRidesInfo($instances)
      {
            $toReturn = [];

            foreach ($instances as $instance) {
                  $toReturn[] = [array_merge($instance, $this->accountInfoToShow($instance['instances_driver_id']))];
            }
            return $toReturn;
      }
      protected function accountInfoToShow($account_id)
      {
            $sql = "SELECT accounts_fullname, accounts_phone, entreprises_name, divisions_name
                      FROM (accounts INNER JOIN divisions ON accounts.divisions_id = divisions.divisions_id ) INNER JOIN entreprises ON divisions.entreprises_id = entreprises.entreprises_id
                     WHERE accounts_id =:id ";
            $bound = [':id' => $account_id];
            return App::$db->query($sql, $bound,false);
      }
}