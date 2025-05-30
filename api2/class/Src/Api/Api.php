<?php

namespace Src\Api;

use Core\Model\JWT;

class Api
{

      public static function protectApiQuery($data)
      {
            if (!isset($data['headers']['Bearer'])) {
                  self::apiResponse(['error' => 'No Bearer Provided']);
            }

            $jwt = new JWT();
            $token = $jwt->decode($data['headers']['Bearer']);
            if (!$token) {
                  self::apiResponse(['error' => 'Invalid Token']);

            }
            // TODO pour le moment on ne fait que ça

            return $token;

      }
      public static function apiResponse($value)
      {
            echo json_encode($value);
            exit();
      }
}