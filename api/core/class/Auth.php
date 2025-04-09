<?php

namespace Core\Class;

use Exception;
use Throwable;
use Core\Class\Database;

class Auth
{

      private static $instance = null;

      private function __construct() {}

      public static function getInstance()
      {
            if (is_null(self::$instance)) {
                  self::$instance = new self;
            }
            return self::$instance;
      }
      public function verify(string $email, string $password)
      {
            if ($password == $this->getPassword($email)) {
                  session_start();
                  $_SESSION['is_logged'] = true;
                  header("Location: index.php");
                  exit();
            } else {
                  throw new Exception("Nom d'utilisateur ou mot de passe incorrect");
                  header("Location: login.php");
                  exit();
            }
      }
      public function protect()
      {
            session_start();
            if (!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] != true) {
                  header("Location: ../model/login.php");
                  exit();
            }
      }
      private function getPassword(string $email)
      {
            try {
                  return Database::getInstance()->getOneFrom('users', 'users_email', $email)['users_password'];
            } catch (Throwable $e) {
                  throw $e;
                  header("Location: login.php");
                  exit();
            }
      }
      public function disconnect()
      {
            session_start();
            $_SESSION['is_logged'] = false;
            session_destroy();
            header("Location: login.php");
            exit();
      }
}
