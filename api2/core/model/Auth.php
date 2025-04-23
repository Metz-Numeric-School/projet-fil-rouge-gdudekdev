<?php

namespace Core\Model;

use Core\Model\JWT;
use Exception;
use Throwable;

class Auth
{
      private static $instance = null;

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
            } else {
                  throw new Exception("Nom d'utilisateur ou mot de passe incorrect");
                  header("Location: index.php?page=login");
                  exit();
            }
      }

      public function verifyApiAccess(string $email, string $password)
      {
            header('Content-Type: application/json');

            $user = Database::getInstance()->getOneFrom('accounts', 'accounts_email', $email);

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

      public function protect()
      {
            session_start();
            if (!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] != true) {
                  header("Location: index.php?page=login");
                  exit();
            }
      }
      public function protectApiAccess($data)
      {
            if (isset($data['headers']['Authorization'])) {
                  if (preg_match('/Bearer\s(\S+)/', $data['headers']['Authorization'], $matches)) {
                        $token = $matches[1];
                        $jwt = new JWT();

                        $status =  (array) $jwt->decode($token);
                        $dataRetrieved = (array) $status['data'];

                        return $dataRetrieved['userId'];
                  } else {
                        http_response_code(400);
                        die('Erreur dans le header de la requête');
                  }
            }
      }
      private function getPassword(string $id)
      {
            try {
                  $user = Database::getInstance()->getOneFrom('accounts', 'accounts_email', $id);
                  return $user['accounts_password'];
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
            header("Location: /index.php?page=login");
            exit();
      }
}
