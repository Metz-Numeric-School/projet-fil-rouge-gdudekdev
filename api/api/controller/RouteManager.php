<?php

namespace Api\Controller;

use Core\Class\Auth;
use Core\Class\JWT;
use Error;

class RouteManager
{
      private static $instance;

      private function __construct() {}

      public static function getInstance()
      {
            if (is_null(self::$instance)) {
                  self::$instance = new self;
            }
            return self::$instance;
      }

      public function dispatch($method , $params){
            if($method == 'login'){
                  $login = new RouteLogin($params);
                  $login->login($params);
            }
      }
  

      public function home($params)
      {
            $header = $params['headers'];

            if (isset($header['Authorization']) &&  $token = $this->isBearerFormat($header['Authorization'])) {
                  $jwt = new JWT();
                  var_dump($jwt->decode($token));
            } else {
                  throw new Error("Token non valide");
            }
      }
      public function backoffice($params)
      {
            header('Location: /app/model/index.php');
            exit();
      }

      private function isBearerFormat(string $string)
      {
            if (preg_match('/Bearer\s(\S+)/', $string, $matches)) {
                  $jwt = $matches[1];
                  return $jwt;
            } else {
                  http_response_code(400);
                  echo "Format de token invalide";
            }
      }
}
