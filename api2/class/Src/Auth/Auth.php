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
            $user = App::$db->getOneFrom('accounts', 'accounts_email', $email);

            return $user['accounts_id'] ?? false;
      }

      public static function protect()
      {
            if (!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] != true) {
                  self::redirect();
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
