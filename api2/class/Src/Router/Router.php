<?php

namespace Src\Router;

use Src\Api\Api;
use Src\Api\ApiBookings;
use Src\Api\ApiInstances;
use Src\Api\ApiMe;
use Src\Api\ApiPreferences;
use Src\Api\ApiQuery;
use Src\Api\ApiRide;
use Src\Api\ApiRideAll;
use Src\Api\ApiRideChoice;
use Src\Api\ApiRides;
use Src\Api\ApiVehicule;
use Src\Auth\Auth;
use Src\Controller\Authenticate;
use Src\Test;

class Router
{
      public static function run()
      {
            if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
                  http_response_code(200);
                  exit();
            }

            if (isset($_GET['api'])) {
                  self::run_api();
            } else {
                  self::run_back();
            }

      }
      private static function run_back()
      {
            $page = 'Home';
            if (isset($_GET['page'])) {
                  $page = ucfirst($_GET['page']);
            }
            if ($page == "Authenticate") {
                  $controller = new Authenticate;
                  $controller->handle($_GET, $_POST);
            } else {
                  Auth::protect();
                  $class = '\Src\Controller\\' . $page;
                  if (class_exists('\Src\Controller\\' . $page)) {
                        $controller = new $class;
                        $controller->handle($_GET, $_POST);
                  } else {
                        $controller = new \Src\Controller\Home;
                        $controller->handle($_GET, $_POST);
                  }
            }

      }
      private static function run_api()
      {
            if (isset($_GET['api'])) {
                  $query = $_GET['query'] ?? '';
                  $data = [
                        'headers' => getallheaders(),
                        'body' => json_decode(file_get_contents('php://input'), true),
                  ];

                  if (!empty($query)) {
                        switch ($query) {
                              case 'login':
                                    $controller = new Api;
                                    $controller->connect($data);
                                    break;
                              case 'logout':
                                    $controller = new Api;
                                    $controller->disconnect($data);
                                    break;
                              case 'refresh':
                                    $controller = new Api;
                                    $controller->refresh($data);
                                    break;
                              case 'me':
                                    (new ApiMe)->request($data);
                                    break;
                              case 'me/update':
                                    (new ApiMe)->update($data);
                                    break;
                              case 'vehicules':
                                    (new ApiVehicule)->request( $data);
                                    break;
                              case 'vehicules/update':
                                    (new ApiVehicule)->update($data);
                              case 'instances':
                                    (new ApiInstances)->request($data);
                                    break;
                              case 'ride':
                                    (new ApiRide)->request($data);
                                    break;
                              case 'ride/instances':
                                    (new ApiRide)->request_instances($data);
                                    break;
                              case 'rides_all': 
                                    (new ApiRideAll)->request($data);
                                    break;
                              case 'rides/delete': 
                                    (new ApiRide)->delete($data);
                                    break;
                              case 'ride_choice':
                                    (new ApiRideChoice)->request($data);
                                    break;
                              case 'rides/post':
                                    (new ApiRide)->post($data);
                                    break;
                              case 'bookings/set_status':
                                    (new ApiBookings)->request($data);
                                    break;
                              case 'on':
                                    $controller = new Api;
                                    $controller->handle($data, $_GET);
                                    break;
                              default:
                                    http_response_code(400);
                                    die("Requete mal formulée");
                        }
                  } else {
                        echo 'Erreur: Page non trouvé';
                        http_response_code(404);
                        exit();
                  }

            }
      }
}