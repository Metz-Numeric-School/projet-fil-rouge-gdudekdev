<?php

namespace Src\Api;

use App;

class ApiGet
{
      public function me($id)
      {
            $sql = "SELECT accounts_fullname,accounts_email,accounts_phone,accounts_birthday,divisions_name,entreprises_name,entreprises_location
                      FROM (accounts INNER JOIN divisions ON accounts.divisions_id = divisions.divisions_id) INNER JOIN entreprises ON divisions.entreprises_id = entreprises.entreprises_id
                     WHERE accounts_id =:id";
            $bound = [':id' => $id];
            return App::$db->query($sql, $bound);
      }
      public function vehicules($id)
      {
            $sql = "SELECT vehicules_id, vehicules_license_plate, car_models_name, car_brands_name, car_colors_name, car_engines_name
                      FROM (((vehicules INNER JOIN car_models ON vehicules.car_models_id = car_models.car_models_id) INNER JOIN car_brands ON car_models.car_brands_id = car_brands.car_brands_id) INNER JOIN car_colors ON vehicules.car_colors_id = car_colors.car_colors_id) INNER JOIN car_engines ON vehicules.car_engines_id = car_engines.car_engines_id
                     WHERE accounts_id =:id";
            $bound = [':id' => $id];
            return App::$db->query($sql, $bound);
      }
      public function preferences($id)
      {
            $sql = "SELECT preferences.preferences_id, preferences_name
                      FROM accounts_preferences INNER JOIN preferences ON accounts_preferences.preferences_id = preferences.preferences_id
                     WHERE accounts_id =:id";
            $bound = [':id' => $id];
            return App::$db->query($sql, $bound);
      }
      public function routes($id)
      {
            $sql = "SELECT routes_id, routes_departure, routes_destination
                      FROM routes
                     WHERE accounts_id =:id";
            $bound = [':id' => $id];
            return App::$db->query($sql, $bound);
      }
      public function rides($id)
      {
            $sql = "SELECT rides_id, rides_departure_time, rides_seats, rides_direction, planifications_start, planifications_end, routes_departure, routes_destination, rides_position, rides_status, planifications_pattern_type, planifications_days_of_week,planifications_interval_weeks,vehicules_id
                      FROM (rides INNER JOIN routes ON rides.routes_id = routes.routes_id) INNER JOIN planifications ON rides.planifications_id = planifications.planifications_id
                     WHERE accounts_id =:id";
            $bound = [':id' => $id];
            return App::$db->query($sql, $bound);
      }
      public function instances($id)
      {
            $sql = "SELECT instances_id, instances.rides_id, instances_status, instances_departure, instances_departure_time, instances_destination, instances_driver_id
                      FROM (instances INNER JOIN rides ON instances.rides_id = rides.rides_id ) INNER JOIN routes ON rides.routes_id = routes.routes_id
                     WHERE accounts_id =:id AND instances_departure_time BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
                     ORDER BY instances_departure_time ASC";
            $bound = [':id' => $id];
            return App::$db->query($sql, $bound);
      }
      public function bookings($id)
      {

            $sql1 = "SELECT bookings_id, 
                           instances_receiver_id, 
                           instances_sender_id, 
                           bookings_status, 
                           instances_departure,
                           instances_destination,
                           instances_departure_time,
                           instances_driver_id

                      FROM ((bookings 
                      INNER JOIN instances ON bookings.instances_sender_id = instances.instances_id) 
                      INNER JOIN rides ON  instances.rides_id = rides.rides_id)
                      INNER JOIN routes ON rides.routes_id = routes.routes_id
                      WHERE routes.accounts_id = :id 
                     ";
            $sql2 = "SELECT bookings_id, 
                           instances_receiver_id, 
                           instances_sender_id, 
                           bookings_status, 
                           instances_departure,
                           instances_destination,
                           instances_departure_time,
                           instances_driver_id

                      FROM ((bookings 
                      INNER JOIN instances ON bookings.instances_receiver_id = instances.instances_id) 
                      INNER JOIN rides ON  instances.rides_id = rides.rides_id)
                      INNER JOIN routes ON rides.routes_id = routes.routes_id
                      WHERE routes.accounts_id = :id 
                     ";
            $sql = $sql1 . ' UNION ' . $sql2;
            $bound = [':id' => $id, ':id2' => $id];
            return App::$db->query($sql, $bound);
      }
      public function search($id)
      {
            $sql = "SELECT instances_id, instances.rides_id, instances_status, instances_departure, instances_departure_time, instances_destination, instances_driver_id
                      FROM instances
                     WHERE  instances_departure_time BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
                            AND NOT(instances_driver_id =:id OR instances_driver_id=0)";
            $bound = [':id' => $id];
            return App::$db->query($sql, $bound);
      }
}
