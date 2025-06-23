<?php

namespace Src\Api;

use App;

class ApiBookings
{

      public function request($request)
      {
            $token = Api::protectApiQuery($request);
            if (empty($request['body']['bookings_id']) || empty($request['body']['bookings_status'] || in_array($request['body']['bookings_status'], ['accepted', 'refused']))) {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not granted']);
            }

            $booking_id = $request['body']['bookings_id'];
            $booking_status = $request['body']['bookings_status'];
            $id = $token->sub;
            var_dump($booking_id, $booking_status);

            if (!$this->hasPermission($id, $booking_id)) {
                  http_response_code(403);
                  Api::apiResponse(['error' => 'Permission not granted']);
            }
            $this->dbQuery($booking_id, $booking_status);
            Api::apiResponse(['response' => 'Action completed !']);
      }
      public function hasPermission($id, $booking_id)
      {
            $sql = "SELECT bookings_id , i.instances_driver_id
                      FROM bookings b
                      JOIN instances i ON b.instances_receiver_id = i.instances_id
                     WHERE bookings_id =:booking_id ";
            $bound = [':booking_id' => $booking_id];
            $driver = App::$db->query($sql, $bound, false);
            if (empty($driver)) {
                  return false;
            }
            return $driver['instances_driver_id'] == $id;
      }
      public function dbQuery($id, $status)
      {
            $sql = "UPDATE bookings 
                    SET bookings_status  = :status
                    WHERE bookings_id = :id";

            $bound = ['status' => $status, ':id' => $id];
            $query = App::$db->query($sql, $bound);
            var_dump($query);
            return $query;
      }
}