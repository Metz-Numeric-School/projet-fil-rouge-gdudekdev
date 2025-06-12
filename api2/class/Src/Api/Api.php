<?php

namespace Src\Api;

use App;
use Core\Model\JWT;
use Src\Auth\Auth;
use Src\Model\Accounts;

class Api
{
      public static $get_methods = [
            'accounts' => 'me',
            'vehicules' => 'vehicules',
            'preferences' => 'preferences',
            'routes' => 'routes',
            'rides' => 'rides',
            'plannings' => 'instances',
            'bookings' => 'bookings',
      ];

      public static function protectApiQuery($data)
      {
            if (!isset($data['headers']['Authorization'])) {
                  http_response_code(401);
                  self::apiResponse(['error' => 'No Bearer Provided']);
            }

            $jwt = new JWT();
            $token = $jwt->decode(str_replace('Bearer ', '', $data['headers']['Authorization']));
            if (!$token) {
                  http_response_code(401);
                  self::apiResponse(['error' => 'Invalid Token']);
            }

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
                  http_response_code(400);
                  self::apiResponse(['error' => "No Action Provided"]);
            }

            if (!in_array($url['action'], ['get', 'post', 'put', 'delete'])) {
                  http_response_code(400);
                  self::apiResponse(['error' => "Action is not valid (get, put, post, delete only)"]);
            }

            if (!isset($url["target"])) {
                  http_response_code(400);
                  self::apiResponse(['error' => "No Target Provided"]);
            }

            $id = $token->sub;

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
            if (in_array($target, array_keys(self::$get_methods))) {
                  $method = self::$get_methods[$target];
                  $class = new ApiGet();
                  self::apiResponse(['response' => $class->$method($id)]);
            } else {
                  self::apiResponse(['error' => "Invalid Action"]);
            }
      }
      protected static function handleApiPost($id, $target, $data)
      {
            if (!self::hasPermission($id, $target, $data[$target . '_id'])) {
                  self::apiResponse(['error' => 'Permission not granted']);
            }
            $model = '\Src\Model\\' . self::$get_methods[$target];
            $model::create($data);
      }
      protected static function handleApiPut($id, $target, $data)
      {
            if (!self::hasPermission($id, $target, $data[$target . '_id'])) {
                  self::apiResponse(['error' => 'Permission not granted']);
            }
            $model = '\Src\Model\\' . self::$get_methods[$target];
            $model::create($data);
      }
      protected static function handleApiDelete($id, $target, $target_id)
      {
            if (!self::hasPermission($id, $target, $target_id)) {
                  self::apiResponse(['error' => 'Permission not granted']);
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
      public function connect($data)
      {
            $account_id = Auth::verifyApiAccess($data['body']['email'], $data['body']['password']);
            if (is_int($account_id)) {
                  JWT::instance()->getTokens($account_id);
            } else {
                  http_response_code(422);
                  self::apiResponse(['error' => 'Incorrect Credentials']);
            }

      }
      public function disconnect($data)
      {
            var_dump($_COOKIE);
            if (!isset($data['Cookie'])) {
                  self::apiResponse(['error' => 'No Refresh-token Provided']);
            }

            $refresh_token_hash = hash('sha256', $data['Cookie']);

            $token_row = App::$db->getOneFrom('tokens', 'tokens_hash', $refresh_token_hash);
            $token_row['tokens_revoked'] = true;

            App::$db->update('tokens', $token_row);
            setcookie('refresh_token', '', [
                  'expires' => time() - 3600,
                  'path' => '/auth/refresh',
                  // 'secure' => true,
                  'httponly' => true,
                  'samesite' => 'Strict'
            ]);

      }
      public function refresh($data)
      {
            if (!isset($_COOKIE['refresh_token'])) {
                  self::apiResponse(['error' => 'No Refresh-token Provided']);
            }
            JWT::instance()->refresh();
      }
}