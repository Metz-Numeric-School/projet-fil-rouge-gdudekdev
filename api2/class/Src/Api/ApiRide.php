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

            $response = [];

            if ($position === 'driver') {
                  $sql = "
        SELECT 
            i.instances_id,
            i.instances_departure_time,
            i.instances_departure,
            i.instances_destination,
            b.bookings_id,
            b.bookings_status,
            s.accounts_fullname AS sender_fullname,
            s.accounts_phone AS sender_phone
        FROM rides r
        JOIN instances i ON r.rides_id = i.rides_id
        LEFT JOIN bookings b ON i.instances_id = b.instances_receiver_id
        LEFT JOIN instances si ON si.instances_id = b.instances_sender_id
        LEFT JOIN rides sr ON sr.rides_id = si.rides_id
        LEFT JOIN routes sroutes ON sr.routes_id = sroutes.routes_id
        LEFT JOIN accounts s ON sroutes.accounts_id = s.accounts_id
        WHERE r.rides_id = :id
          AND r.rides_position = 'driver'
          AND i.instances_departure_time BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
        ORDER BY i.instances_departure_time ASC;
    ";
                  $response['received'] = App::$db->query($sql, [':id' => $rides_id]);
            }

            if ($position === 'passager') {
                  $sql = "
        SELECT 
            b.bookings_id,
            b.bookings_status,
            ir.instances_id AS receiver_instance_id,
            ir.instances_departure_time,
            ir.instances_departure,
            ir.instances_destination,
            a.accounts_id AS driver_id,
            a.accounts_fullname AS driver_fullname,
            a.accounts_email AS driver_email,
            a.accounts_phone AS driver_phone
        FROM rides r
        JOIN instances isender ON r.rides_id = isender.rides_id
        JOIN bookings b ON isender.instances_id = b.instances_sender_id
        JOIN instances ir ON b.instances_receiver_id = ir.instances_id
        JOIN rides r2 ON ir.rides_id = r2.rides_id
        JOIN routes rt ON r2.routes_id = rt.routes_id
        JOIN accounts a ON rt.accounts_id = a.accounts_id
        WHERE r.rides_id = :id
          AND r.rides_position = 'passager'
          AND ir.instances_departure_time BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
        ORDER BY b.bookings_status ASC;
    ";
                  $response['sent'] = App::$db->query($sql, [':id' => $rides_id]);
            }
            return $response;
      }
      
}