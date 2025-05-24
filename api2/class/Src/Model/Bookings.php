<?php

namespace Src\Model;

use App;

class Bookings extends Model
{
      public static $table = 'bookings';
      protected static function all_show(): array
      {
            $account_id = $_GET['accounts_id'];
            $instance_id = $_GET['instances_id'];

            $current_instance = Instances::get($instance_id);
            if ($current_instance['instances_driver_id'] == $account_id) {
                  $bookings = Bookings::getAllWhere('instances_receiver_id', $instance_id);
                  return
                        [
                              "account_id" => $account_id,
                              "bookings" => $bookings,
                        ];
                  // TODO montrer les demandes de passagers pour ce trajet en particulier
            } else {
                  // TODO faire une recherche de demande de trajet qui sont proposés par les conducteurs selon des critères encore a definir 
                  $bookings = Bookings::getAllWhere('instances_sender_id', $instance_id);
                  $valid_instances = [];
                  $instances = Instances::getAll();
                  foreach ($instances as $instance) {
                        if ($instance['instances_driver_id'] == 0)
                              continue;
                        if(in_array($instance['instances_id'], array_column($bookings,'instances_receiver_id'))){
                              continue;
                        }
                        $route = $instance['instances_departure'] . ", " . $instance['instances_destination'];
                        $time = $instance['instances_departure_time'];
                        $driver = new \Src\Entity\Accounts(Accounts::get($instance['instances_driver_id']));

                        $valid_instances[] = [
                              'route' => $route,
                              'time' => $time,
                              'driver' => $driver,
                              'instance' => $instance,
                        ];
                  }

                  return
                        [
                              "account_id" => $account_id,
                              "instance_id" => $instance_id,
                              "bookings" => $bookings,
                              "valid_instances" => $valid_instances,
                        ];
            }

      }
}