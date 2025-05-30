<?php

namespace Core\Model;

use PDO;

class Database
{
      private static $PDOInstance;

      public function __construct()
      {
            self::$PDOInstance = new PDO(DEFAULT_DSN, DEFAULT_HOST, DEFAULT_PASS);
      }

      public function getAllFrom(string $table)
      {
            $stmt = self::$PDOInstance->prepare("SELECT * FROM $table ORDER BY " . $table . "_id ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      public function getOneFrom(string $table, $champ, $value)
      {
            $stmt = self::$PDOInstance->prepare("SELECT * FROM $table WHERE " . $champ . "= :value");
            $stmt->execute([":value" => $value]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
      }
      public function delete(string $table, int $id)
      {
            $stmt = self::$PDOInstance->prepare("DELETE FROM $table WHERE " . $table . "_id = :id");
            $stmt->execute([':id' => $id]);
      }
      /**
       * @param $object : array relatif à sa structure dans la table $table de la BDD
       */
      public function update(string $table, array $data)
      {
            $values = "";
            $id = $data[$table . '_id'];
            foreach ($data as $key => $value) {
                  $values .= $key . "=" . "'" . $value . "',";
            }
            $values = substr($values, 0, -1);
            $stmt = self::$PDOInstance->prepare("UPDATE $table SET $values WHERE " . $table . "_id=:id");
            $stmt->execute([':id' => $id]);
      }
      public function add(string $table, array $value)
      {
            $sql = '(';
            foreach ($value as $k => $v) {
                  $sql .= $k . ',';
            }
            $sql = substr($sql, 0, -1);
            $sql .= ') VALUES (';
            foreach ($value as $k => $v) {
                  $sql .= ":" . $k . ',';
            }
            $sql = substr($sql, 0, -1);
            $sql .= ')';
            $execute = [];
            foreach ($value as $k => $v) {
                  $execute[':' . $k] = $v;
            }
            $stmt = self::$PDOInstance->prepare("INSERT INTO $table $sql");
            $stmt->execute($execute);
      }
      /**
       * @var table : table name
       * @var bool  : associative array formated as follow
       *              ['stmt'=>string "boolean statement (e.g : id =:id)",
       *                'params'=>array ['marker'=>value (e.g: [':id'=>id]])
       */
      public function getAllFromWhere($table, $bool)
      {
            $stmt = self::$PDOInstance->prepare("SELECT * FROM $table WHERE " . $bool['stmt']);
            $stmt->execute($bool['params']);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      public function deleteFromWhere($table, $bool)
      {
            $stmt = self::$PDOInstance->prepare("DELETE FROM $table WHERE " . $bool['stmt']);
            $stmt->execute($bool['params']);
      }
      public function updateFromWhere($table, $bool)
      {
            $stmt = self::$PDOInstance->prepare("UPDATE $table SET $bool WHERE " . $bool['stmt']);
            $stmt->execute($bool['params']);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      public function getLastInserted()
      {
            return intval(self::$PDOInstance->lastInsertId());
      }
      public function me($id)
      {
            $sql = "SELECT accounts_fullname,accounts_email,accounts_phone,accounts_birthday,divisions_name,entreprises_name,entreprises_location
                      FROM (accounts INNER JOIN divisions ON accounts.divisions_id = divisions.divisions_id) INNER JOIN entreprises ON divisions.entreprises_id = entreprises.entreprises_id
                     WHERE accounts_id =:id";
            $stmt = self::$PDOInstance->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      public function vehicules($id)
      {
            $sql = "SELECT vehicules_id, vehicules_license_plate, car_models_name, car_brands_name, car_colors_name, car_engines_name
                      FROM (((vehicules INNER JOIN car_models ON vehicules.car_models_id = car_models.car_models_id) INNER JOIN car_brands ON car_models.car_brands_id = car_brands.car_brands_id) INNER JOIN car_colors ON vehicules.car_colors_id = car_colors.car_colors_id) INNER JOIN car_engines ON vehicules.car_engines_id = car_engines.car_engines_id
                     WHERE accounts_id =:id";
            $stmt = self::$PDOInstance->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      public function preferences($id)
      {
            $sql = "SELECT preferences.preferences_id, preferences_name
                      FROM accounts_preferences INNER JOIN preferences ON accounts_preferences.preferences_id = preferences.preferences_id
                     WHERE accounts_id =:id";
            $stmt = self::$PDOInstance->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      public function routes($id)
      {
            $sql = "SELECT routes_id, routes_departure, routes_destination
                      FROM routes
                     WHERE accounts_id =:id";
            $stmt = self::$PDOInstance->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      public function rides($id)
      {
            $sql = "SELECT rides_id, rides_departure_time, rides_seats, rides_direction, planifications_start, planifications_end, routes_departure, routes_destination, rides_position, rides_status, planifications_pattern_type, planifications_days_of_week,planifications_interval_weeks,vehicules_id
                      FROM (rides INNER JOIN routes ON rides.routes_id = routes.routes_id) INNER JOIN planifications ON rides.planifications_id = planifications.planifications_id
                     WHERE accounts_id =:id";
            $stmt = self::$PDOInstance->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      public function instances($id)
      {
            $sql = "SELECT instances_id, instances.rides_id, instances_status, instances_departure, instances_departure_time, instances_destination, instances_driver_id
                      FROM (instances INNER JOIN rides ON instances.rides_id = rides.rides_id ) INNER JOIN routes ON rides.routes_id = routes.routes_id
                     WHERE accounts_id =:id AND instances_departure_time BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)";
            $stmt = self::$PDOInstance->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            $stmt = self::$PDOInstance->prepare($sql);
            $stmt->execute([':id' => $id, ':id2' => $id]);


            return   $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

}
