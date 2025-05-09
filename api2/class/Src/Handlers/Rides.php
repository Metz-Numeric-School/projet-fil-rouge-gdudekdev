<?php

namespace Src\Handlers;

use App;

class Rides
{
      private static $instance;
      public static function instance()
      {
            if (is_null(self::$instance)) {
                  self::$instance = new self;
            }
            return self::$instance;
      }
      public function handle($url, $data)
      {     
            if (isset($data['route_id'])) {
                  App::$db->deleteFromWhere('rides', ['stmt' => 'routes_id = :routes_id', 'params' => [':routes_id' => $data['route_id']]]);
            } else {
                  echo'test';
                  // Case where the account associated is deleted
                  if (isset($data['account_id'])) {
                        $routes = App::$db->getAllFromWhere('routes', ['stmt' => 'accounts_id =:accounts_id', 'params' => [':accounts_id' => $data['account_id']]]);
                        foreach ($routes as $route) {
                              App::$db->deleteFromWhere('rides', ['stmt' => 'routes_id = :routes_id', 'params' => [':routes_id' => $route['routes_id']]]);
                        }

                  } else {
                        if (sizeof($data) == 0) {
                              if (isset($url['remove']) && isset($url['id'])) {
                                    $vehicule_id = App::$db->getOneFrom('rides', 'rides_id', $url['id'])['vehicules_id'];
                                    $account_id = App::$db->getOneFrom('vehicules', 'vehicules_id', $vehicule_id)['accounts_id'];

                                    App::$db->delete('rides', $url['id']);
                                    header("Location: index.php?page=rides&accounts_id=" . $account_id);
                                    exit();
                              }
                        } else {
                              $account_id = App::$db->getOneFrom('vehicules', 'vehicules_id', $data['vehicules_id'])['accounts_id'];
                              if (empty($data['rides_id'])) {
                                    App::$db->add('rides', $data);
                                    header("Location: index.php?page=rides&accounts_id=" . $account_id);
                                    exit();
                              } else {
                                    App::$db->update('rides', $data);
                                    header("Location: index.php?page=rides&accounts_id=" . $account_id);
                                    exit();
                              }
                        }
                  }
            }


      }
}