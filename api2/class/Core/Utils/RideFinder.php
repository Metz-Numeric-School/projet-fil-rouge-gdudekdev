<?php

namespace Core\Utils;

use App;
use DateTime;
use Src\Model\Instances;

class RideFinder
{

      public function search($instance_id)
      {
            $query_instance = Instances::get($instance_id);

            if (!$query_instance || empty($query_instance['instances_departure_time'])) {
                  return [];
            }

            $departure_date = (new DateTime($query_instance['instances_departure_time']))->format('Y-m-d');
            $date_inteval_start = $departure_date . ' 00:00:00';
            $date_inteval_end = $departure_date . ' 23:59:59';

            $sql = "SELECT instances_id, instances_departure, instances_departure_time, instances_destination, instances_driver_id
            FROM instances 
            WHERE instances_driver_id != 0 
              AND instances_departure_time BETWEEN :start AND :end
            AND instances_status = 'active'
            ORDER BY instances_departure_time ASC";

            $bound = [
                  ':start' => $date_inteval_start,
                  ':end' => $date_inteval_end
            ];

            return App::$db->query($sql, $bound);
      }

}