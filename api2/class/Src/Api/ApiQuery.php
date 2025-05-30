<?php

namespace Src\Api;

use App;
use Src\Controller\Accounts;

class ApiQuery
{

      public static $get_methods = [
            'me',
            'vehicules',
            'preferences',
            'routes',
            'rides',
            'instances',
            'bookings',
      ];
      public static function handle($data, $url)
      {
            $token = Api::protectApiQuery($data);

            if (!isset($url["action"])) {
                  Api::apiResponse(['error' => "No Action Provided"]);
            }

            if (!in_array($url['action'], ['get', 'post', 'put', 'delete'])) {
                  Api::apiResponse(['error' => "Action is not valid (get, put, post, delete only)"]);
            }

            if (!isset($url["target"])) {
                  Api::apiResponse(['error' => "No Target Provided"]);
            }

            $id = $token->data->id;
            if (in_array($url['target'], self::$get_methods)) {
                  $method = $url['target'];
                  Api::apiResponse(['response' => App::$db->$method($id)]);
            } else {
                  Api::apiResponse(['error' => "Invalid Action"]);
            }
      }
}