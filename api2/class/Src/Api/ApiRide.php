<?php

namespace Src\Api;

use App;
use Src\Entity\Accounts;
use Src\Model\Bookings;
use Src\Model\Instances;
use Src\Model\Rides;
use Src\Model\Routes;

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
            $sql = "SELECT rides_id, accounts.accounts_id
                      FROM (rides INNER JOIN routes ON rides.routes_id = routes.routes_id ) INNER JOIN accounts ON routes.accounts_id = accounts.accounts_id
                     WHERE rides_id =:ride_id ";
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
      public function request_instances($request)
      {
            $token = Api::protectApiQuery($request);
            if (empty($request['body']['rides_id'])) {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not granted']);
            }

            $ride_id = $request['body']['rides_id'];
            $id = $token->sub;

            if (!$this->hasPermission($id, $ride_id)) {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not granted']);
            }
            if ($query = $this->dbQueryInstances($ride_id)) {
                  Api::apiResponse(['response' => $query]);
            } else {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not grantedd']);
            }
      }
      public function dbQueryInstances($rides_id)
      {
            $sql = "SELECT rides_position FROM rides WHERE rides_id = :id LIMIT 1";
            $position = App::$db->query($sql, [':id' => $rides_id], false)['rides_position'];
            if ($position === 'driver') {
              $res = [];
                  if ($instances = Instances::getAllWhere('rides_id', $rides_id)) {
                        $i = 0;
                        foreach ($instances as $instance) {
                              $res[$i] = [
                                    'instances_departure' => $instance['instances_departure'],
                                    'instances_destination' => $instance['instances_destination'],
                                    'instances_departure_time' => $instance['instances_departure_time'],
                              ];
                              if ($bookings = Bookings::getAllWhere('instances_receiver_id', $instance['instances_id'])) {
                                    foreach ($bookings as $booking) {
                                          $sql = "SELECT a.accounts_fullname, a.accounts_phone, a.accounts_id,instances_departure, i.instances_destination,i.instances_departure_time , b.bookings_status
                                          FROM bookings b
                                          JOIN instances i ON b.instances_receiver_id = i.instances_id
                                          JOIN rides ri ON i.rides_id = ri.rides_id
                                          JOIN routes ro ON ri.routes_id = ro.routes_id
                                          JOIN accounts a ON ro.accounts_id = a.accounts_id  
                                          WHERE b.instances_sender_id =:id
                                          GROUP BY a.accounts_id";
                                          $bound = [":id" => $booking['instances_receiver_id']];
                                          if ($sender = App::$db->query($sql, $bound)) {
                                                $res[$i]['bookings'][] = $sender;
                                          } else {
                                                return false;
                                          }
                                    }
                              } else {
                                    $res[$i]['bookings'] = [];
                              }
                              $i++;
                        }
                        return $res;
                  }
            }

            if ($position === 'passager') {
                  $res = [];
                  if ($instances = Instances::getAllWhere('rides_id', $rides_id)) {
                        $i = 0;
                        foreach ($instances as $instance) {
                              $res[$i] = [
                                    'instances_departure' => $instance['instances_departure'],
                                    'instances_destination' => $instance['instances_destination'],
                                    'instances_departure_time' => $instance['instances_departure_time'],
                              ];
                              if ($bookings = Bookings::getAllWhere('instances_sender_id', $instance['instances_id'])) {
                                    foreach ($bookings as $booking) {
                                          $sql = "SELECT a.accounts_fullname, a.accounts_phone, a.accounts_id,instances_departure, i.instances_destination,i.instances_departure_time , b.bookings_status
                                          FROM bookings b
                                          JOIN instances i ON b.instances_receiver_id = i.instances_id
                                          JOIN rides ri ON i.rides_id = ri.rides_id
                                          JOIN routes ro ON ri.routes_id = ro.routes_id
                                          JOIN accounts a ON ro.accounts_id = a.accounts_id  
                                          WHERE b.instances_receiver_id =:id
                                          GROUP BY a.accounts_id";
                                          $bound = [":id" => $booking['instances_receiver_id']];
                                          if ($receiver = App::$db->query($sql, $bound)) {
                                                $res[$i]['bookings'][] = $receiver;
                                          } else {
                                                return false;
                                          }
                                    }
                              } else {
                                    $res[$i]['bookings'] = [];
                              }
                              $i++;
                        }
                        return $res;
                  }
                  return false;
            }
            return false;
      }
      public function delete($request)
      {
            $token = Api::protectApiQuery($request);
            if (empty($request['body']['rides_id'])) {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not granted']);
            }

            $ride_id = $request['body']['rides_id'];
            $id = $token->sub;

            if (!$this->hasPermissionToDelete($id, $ride_id)) {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not granted']);
            }
            $this->deleteRides($ride_id);
            Api::apiResponse(['response' => 'Action Completed']);
      }
      public function hasPermissionToDelete($accounts_id, $rides_id)
      {
            $sql = "SELECT a.accounts_id 
                    FROM rides ri JOIN routes ro ON  ri.routes_id = ro.routes_id
                    JOIN accounts a ON ro.accounts_id = a.accounts_id
                    WHERE ri.rides_id = :id ";
            $bound = [':id' => $rides_id];
            $account = App::$db->query($sql, $bound, false);

            if ($account) {
                  return $account['accounts_id'] == $accounts_id;
            }
            return false;

      }
      public function deleteRides($rides_id)
      {
            Rides::delete($rides_id);
      }
      public function post($request)
      {
            $token = Api::protectApiQuery($request);
            var_dump($request['body']);

            if (empty($request['body']['rides'])) {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not granted']);
            }

            try {
                  $routes_id = $this->addRoutesFromRequest($request, $token);
                  $this->addRidesFromRequest($request, $routes_id);
                  http_response_code(204);
            } catch (e) {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not granted']);
            }

      }
      protected function addRoutesFromRequest($request, $token)
      {
            $route = $request['body']['rides']['route'];
            $routes = [
                  'routes_departure' => $route['routes_departure']['routes_departure_name'],
                  'routes_destination' => $route['routes_destination']['routes_destination_name'],
                  'routes_departure_lat' => $route['routes_departure']['routes_departure_coord'][0],
                  'routes_departure_lon' => $route['routes_departure']['routes_departure_coord'][1],
                  'routes_destination_lat' => $route['routes_destination']['routes_destination_coord'][0],
                  'routes_destination_lon' => $route['routes_destination']['routes_destination_coord'][1],
                  'accounts_id' => $token->sub,
            ];
            Routes::create($routes);
            return App::$db->getLastInserted();
      }
      protected function addRidesFromRequest($request, $routes_id)
      {
            $rides = $request['body']['rides'];
            $planifications = $rides['planifications'];
            var_dump($rides);
            if ($planifications['planifications_pattern_type'] == 'none') {
                  $rides_departure_time = $rides['rides_departure_date'] . 'T' . $rides['rides_departure_time'];
            } else {
                  $rides_departure_time = $rides['planifications_start'] . 'T' . $rides['rides_departure_time'];
            }
            $rides = [
                  'rides_departure_time' => $rides_departure_time,
                  'rides_seats' => $rides['rides_seats'],
                  'planifications_start' => $rides['planifications_start'],
                  'planifications_end' => $rides['planifications_end'],
                  'rides_position' => $rides['rides_position'],
                  'pattern_type' => $planifications['planifications_pattern_type'],
                  'days_of_week' => $planifications['planifications_days_of_week'],
                  'interval_week' => $planifications['planifications_interval_week'],
                  'routes_id' => $routes_id,
                  'vehicules_id' => $rides['vehicules_id'],
            ];
            Rides::create($rides);
      }
}