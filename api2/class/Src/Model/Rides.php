<?php

namespace Src\Model;

use App;

class Rides extends Model
{
      public static $table = 'rides';
      public static $dependencies = ['instances'];
      protected static function update_show()
      {
            $id = $_GET['id'] ?? 0;
            $account_id = $_GET['accounts_id'];

            $ride = new \Src\Entity\Rides(App::$db->getOneFrom('rides', 'rides_id', $id));
            $vehicules = App::$db->getAllFromWhere('vehicules', ['stmt' => 'accounts_id =:accounts_id', 'params' => [':accounts_id' => $account_id]]);
            $routes = App::$db->getAllFromWhere('routes', ['stmt' => 'accounts_id =:accounts_id', 'params' => [':accounts_id' => $account_id]]);
            $planifications = App::$db->getAllFrom('planifications');
            $models = [];
            $brands = [];
            $colors = [];
            $engines = [];
            foreach ($vehicules as $vehicule) {
                  $vehicule = new \Src\Entity\Vehicules($vehicule);
                  $models[] = App::$db->getOneFrom('car_models', 'car_models_id', $vehicule->car_models_id())['car_models_name'];
                  $brandId = App::$db->getOneFrom('car_models', 'car_models_id', $vehicule->car_models_id())['car_brands_id'];
                  $brands[] = App::$db->getOneFrom('car_brands', 'car_brands_id', $brandId)['car_brands_name'];
                  $colors[] = App::$db->getOneFrom('car_colors', 'car_colors_id', $vehicule->car_colors_id())['car_colors_name'];
                  $engines[] = App::$db->getOneFrom('car_engines', 'car_engines_id', $vehicule->car_engines_id())['car_engines_name'];
            }
            return
                  compact(["ride", "account_id", "vehicules", "routes", "planifications", "models", "brands", "colors", "engines"]);
      }
      protected static function add_show()
      {
            $account_id = $_GET['accounts_id'];

            $ride = new \Src\Entity\Rides();
            $vehicules = App::$db->getAllFromWhere('vehicules', ['stmt' => 'accounts_id =:accounts_id', 'params' => [':accounts_id' => $account_id]]);
            $routes = App::$db->getAllFromWhere('routes', ['stmt' => 'accounts_id =:accounts_id', 'params' => [':accounts_id' => $account_id]]);
            $planifications = App::$db->getAllFrom('planifications');
            $models = [];
            $brands = [];
            $colors = [];
            $engines = [];
            foreach ($vehicules as $vehicule) {
                  $vehicule = new \Src\Entity\Vehicules($vehicule);
                  $models[] = App::$db->getOneFrom('car_models', 'car_models_id', $vehicule->car_models_id())['car_models_name'];
                  $brandId = App::$db->getOneFrom('car_models', 'car_models_id', $vehicule->car_models_id())['car_brands_id'];
                  $brands[] = App::$db->getOneFrom('car_brands', 'car_brands_id', $brandId)['car_brands_name'];
                  $colors[] = App::$db->getOneFrom('car_colors', 'car_colors_id', $vehicule->car_colors_id())['car_colors_name'];
                  $engines[] = App::$db->getOneFrom('car_engines', 'car_engines_id', $vehicule->car_engines_id())['car_engines_name'];
            }
            return
                  compact(["ride", "account_id", "vehicules", "routes", "planifications", "models", "brands", "colors", "engines"]);

      }
      protected static function all_show()
      {
            $account_id = $_GET['accounts_id'];

            $routes = App::$db->getAllFromWhere('routes', ['stmt' => 'accounts_id =:accounts_id', 'params' => [':accounts_id' => $account_id]]);
            $rides = [];
            foreach ($routes as $route) {
                  $corresponding_rides = App::$db->getAllFromWhere("rides", ['stmt' => 'routes_id =:routes_id', 'params' => [':routes_id' => $route['routes_id']]]);
                  foreach ($corresponding_rides as $ride) {
                        array_push($rides, $ride);
                  }
            }
            return
                  [
                        "rides" => $rides,
                        "account_id" => $account_id,
                  ];
      }
      public static function create(array $data)
      {
            $ride = $data;
            $removeKeys = array('pattern_type', 'single_date', 'interval_weeks', 'days_of_week');


            $planification_id = Planifications::getOrGeneratePlanificationId($ride);
            $ride = array_diff_key($data, array_flip($removeKeys));
            $ride['planifications_id'] = $planification_id;

            App::$db->add(get_called_class()::$table, $ride);
            $data['rides_id'] = App::$db->getLastInserted();
            Instances::onCreateRide($data);
            return true;
      }
}
