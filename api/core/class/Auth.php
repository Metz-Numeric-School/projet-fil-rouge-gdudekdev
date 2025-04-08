<?php
namespace Core\Class;
use Throwable;
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
      public function verify(string $username, string $password)
      {
            if ($password == $this->getPassword($username)) {
                  session_start();
                  $_SESSION['is_logged'] = true;
                  header("Location: index.php");
                  exit();
            } else {
                  throw "Nom d'utilisateur ou mot de passe incorrect";
                  header("Location: login.php");
                  exit();
            }
      }
      public function protect()
      {
            session_start();
            if (!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] != true) {
                  header("Location: ../pages/login.php");
                  exit();
            }
      }
      private function getPassword(string $username)
      {
            try {
                  return Database::getInstance()->getOneFrom('users', 'username', $username)['password'];
            } catch (Throwable $e) {
                  throw "Nom d'utilisateur ou mot de passe incorrect";
                  header("Location: login.php");
                  exit();
            }
      }
      public function disconnect()
      {
            session_start();
            $_SESSION['is_logged'] = false;
            session_destroy();
            header("Location: /pages/login.php");
            exit();
      }
}
