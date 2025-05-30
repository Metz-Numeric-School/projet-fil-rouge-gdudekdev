<?php

namespace Src\Auth;

use App;
use Core\Model\JWT;
use Throwable;

class Auth
{
      private static $redirect_protect_path = REDIRECT_PROTECT_PATH ?? "index.php";
      public static function verify(string $email, string $password)
      {
            if ($password == self::getPassword($email)) {
                  $_SESSION['is_logged'] = true;
            } else {
                  self::redirect();
            }
      }

      public static function verifyApiAccess(string $email, string $password)
      {
            // header('Content-Type: application/json');

            $user = App::$db->getOneFrom('accounts', 'accounts_email', $email);

            if (!$user || $password !== $user['accounts_password']) {
                  echo json_encode([
                        'error' => "Nom d'utilisateur ou mot de passe incorrect"
                  ]);
                  exit;
            }

            $jwt = new JWT($user['accounts_id']);
            $token = $jwt->encode();

            echo json_encode([
                  "token" => $token
            ]);
            exit;
      }

      public static function protect()
      {
            if (!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] != true) {
                  self::redirect();
            }
      }
      public function protectApiAccess($data)
      {
            if (isset($data['headers']['Authorization'])) {
                  if (preg_match('/Bearer\s(\S+)/', $data['headers']['Authorization'], $matches)) {
                        $token = $matches[1];
                        $jwt = new JWT();

                        $status = (array) $jwt->decode($token);
                        $dataRetrieved = (array) $status['data'];

                        return $dataRetrieved['userId'];
                  } else {
                        http_response_code(400);
                        die('Erreur dans le header de la requête');
                  }
            }
      }
      private static function getPassword(string $id)
      {
            try {
                  $user = App::$db->getOneFrom('accounts', 'accounts_email', $id);
                  return $user['accounts_password'];
            } catch (Throwable $e) {
                  self::redirect();
            }
      }
      public static function disconnect()
      {
            $_SESSION['is_logged'] = false;
            session_destroy();
            self::redirect();
      }
      private static function redirect()
      {
            header("Location: index.php?page=authenticate");
            exit;
      }
}
