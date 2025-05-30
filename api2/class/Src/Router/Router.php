<?php

namespace Src\Router;

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

            // if (isset($_GET['api'])) {
            //       self::run_api();
            // } else {
            //       self::run_back();
            // }

      }
      private static function run_back()
      {
            Auth::protect();
            $page = 'Home';
            if (isset($_GET['page'])) {
                  $page = ucfirst($_GET['page']);
            }


            $class = '\Src\Controller\\' . $page;
            if (class_exists('\Src\Controller\\' . $page)) {
                  $controller = new $class;
                  $controller->handle($_GET, $_POST);
            } else {
                  $controller = new \Src\Controller\Home;
                  $controller->handle($_GET, $_POST);
            }
      }
      private static function run_api()
      {
            if (isset($_GET['api'])) {
                  $acces_path = $_GET['access'] ?? '';
                  $data = [
                        'headers' => getallheaders(),
                        'body' => json_decode(file_get_contents('php://input'), true),
                  ];

                  if (!empty($acces_path)) {
                        var_dump($data['headers']);
                        $data['body'] = json_decode(Test::test());
                        var_dump($data['body']->email);
                        switch ($acces_path) {
                              case 'login':
                                    $controller = new Authenticate;
                                    $controller->handleApiLogin($data);
                                    break;
                              case 'fetch':
                                    $controller = new ApiFetchController;
                                    $controller->handleFetch($data);
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