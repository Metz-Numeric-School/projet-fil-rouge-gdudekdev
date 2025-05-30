<?php

namespace Src\Api;

use App;
use Core\Model\JWT;
use Src\Model\Accounts;

class Api
{
      public static $get_methods = [
            'me' => 'accounts',
            'vehicules' => 'vehicules',
            'preferences' => 'preferences',
            'routes' => 'routes',
            'rides' => 'rides',
            'instances' => 'instances',
            'bookings' => 'bookings',
      ];

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

      public static function handle($data, $url)
      {
            $token = self::protectApiQuery($data);

            if (!isset($url["action"])) {
                  self::apiResponse(['error' => "No Action Provided"]);
            }

            if (!in_array($url['action'], ['get', 'post', 'put', 'delete'])) {
                  self::apiResponse(['error' => "Action is not valid (get, put, post, delete only)"]);
            }

            if (!isset($url["target"])) {
                  self::apiResponse(['error' => "No Target Provided"]);
            }

            $id = $token->data->id;

            switch ($url['action']) {
                  case 'get':
                        self::handleApiGet($id, $url['target']);
                        break;
                  case 'post':
                        if (!isset($data['data']['payload'])) {
                              self::apiResponse(['error' => 'Not enough information to perform the operation']);
                              break;
                        }
                        self::handleApiPost($id, $url['target'], $data);
                        break;
                  case 'put':
                        if (!isset($data['data']['payload'])) {
                              self::apiResponse(['error' => 'Not enough information to perform the operation']);
                              break;
                        }
                        self::handleApiPut($id, $url['target'], $data);
                        break;
                  case 'delete':
                        if (!isset($url['id'])) {
                              self::apiResponse(['error' => "Deletion Cancelled, No Id Provided"]);
                        }
                        self::handleApiDelete($id, $url['target'], $url['id']);
                        break;
            }

      }
      protected static function handleApiGet($id, $target)
      {
            if (in_array($target, self::$get_methods)) {
                  $method = $target;
                  self::apiResponse(['response' => App::$db->$method($id)]);
            } else {
                  self::apiResponse(['error' => "Invalid Action"]);
            }
      }
      protected static function handleApiPost($id, $target, $data)
      {
            if (!self::hasPermission($id, $target, $data[$target . '_id'])) {
                  self::apiResponse(['error' => 'Not enough rights to delete this content']);
            }
            $model = '\Src\Model\\' . self::$get_methods[$target];
            $model::create($data);
      }
      protected static function handleApiPut($id, $target, $data)
      {
            if (!self::hasPermission($id, $target, $data[$target . '_id'])) {
                  self::apiResponse(['error' => 'Not enough rights to delete this content']);
            }
            $model = '\Src\Model\\' . self::$get_methods[$target];
            $model::create($data);
      }
      protected static function handleApiDelete($id, $target, $target_id)
      {
            if (!self::hasPermission($id, $target, $target_id)) {
                  self::apiResponse(['error' => 'Not enough rights to delete this content']);
            }
            $model = '\Src\Model\\' . self::$get_methods[$target];
            $model::delete($target_id);
      }

      protected static function hasPermission($id, $target, $target_id)
      {
            if ($target == 'accounts') {
                  return Accounts::get($target_id);
            }

            foreach (DEPENDENCY_TABLE[$target]['depends_on'] as $parent) {
                  $model = '\Src\Model\\' . $parent;
                  $parentId = $model::get($target_id)[$parent . '_id'];

                  if ($parentId == null)
                        continue;

                  if (self::hasPermission($id, $parent, $parentId)) {
                        return true;
                  }
            }
            return false;
      }
}