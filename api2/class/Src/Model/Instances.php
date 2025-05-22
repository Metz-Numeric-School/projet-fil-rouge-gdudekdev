<?php

namespace Src\Model;

use App;

class Instances extends Model
{
      public static $table = 'instances';
      protected static function update_show()
      {
            $id = $_GET['id'] ?? 0;
            $route = new \Src\Entity\Routes(Routes::get($id));
            $account_id = $route->accounts_id();
            return
                  compact(["route", "account_id"], ["route", "account_id"]);
      }
      protected static function all_show()
      {
            return
                  [
                        "instances" => self::getAll()
                  ];
      }
      public static function onCreateRide($ride)
      {
            $pattern_type = $ride['pattern_type'];
            match ($pattern_type) {
                  'none' => self::generateInstance($ride),
                  'daily' => self::generateDailyInstance($ride),
                  'days' => self::generateDaysInstance($ride),
            };
            // ne pas oublier de fournir le planification id correspondant dans le ride 
            // faire changer la valeur de ride et notamment le departure_time en fonction de la planification
      }
      private static function createInstance($ride)
      {
            $route = Routes::get($ride['routes_id']);
            $driverId = $route['accounts_id'];
            $departure = $route['routes_departure'];
            $destination = $route['routes_destination'];
            $instance_data = [
                  'rides_id' => $ride['rides_id'],
                  'instances_status' => 'active',
                  'instances_driver_id' => $driverId,
                  'instances_departure' => $departure,
                  'instances_destination' => $destination,
                  'instances_departure_time' => $ride['rides_departure_time'],
            ];
            Instances::create($instance_data);
      }
      private static function generateInstance($ride)
      {
            self::createInstance($ride);
      }
      private static function generateDailyInstance($ride)
      {
            $start = new \DateTime($ride['planifications_start']);
            $end = new \DateTime($ride['planifications_end']);
            $departureTime = (new \DateTime($ride['rides_departure_time']))->format('H:i:s');

            $interval = new \DateInterval('P1D');
            $period = new \DatePeriod($start, $interval, $end->modify('+1 day'));

            foreach ($period as $date) {
                  $dayOfWeek = (int) $date->format('N');

                  if ($dayOfWeek >= 6) {
                        continue;
                  }
                  $rideCopy = $ride;
                  $dateWithTime = $date->format('Y-m-d') . ' ' . $departureTime;
                  $rideCopy['rides_departure_time'] = $dateWithTime;
                  self::createInstance($rideCopy);
            }
      }
      private static function generateDaysInstance($ride)
      {
            $start = new \DateTime($ride['planifications_start']);
            $end = new \DateTime($ride['planifications_end']);
            $departureTime = (new \DateTime($ride['rides_departure_time']))->format('H:i:s');

            $daysMap = [
                  'mon' => 1,
                  'tue' => 2,
                  'wed' => 3,
                  'thu' => 4,
                  'fri' => 5,
            ];

            $selectedDays = array_map(fn($day) => $daysMap[$day], $ride['days_of_week'] ?? []);

            $interval = new \DateInterval('P1D');
            $period = new \DatePeriod($start, $interval, (clone $end)->modify('+1 day'));

            foreach ($period as $date) {
                  $dayOfWeek = (int) $date->format('N'); // 1 = lundi, ..., 7 = dimanche

                  if (in_array($dayOfWeek, $selectedDays)) {
                        $rideCopy = $ride;
                        $rideCopy['rides_departure_time'] = $date->format('Y-m-d') . ' ' . $departureTime;
                        self::createInstance($rideCopy);
                  }
            }
      }



}
