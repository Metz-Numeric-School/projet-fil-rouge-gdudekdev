<?php

namespace Src\Controller;

use App;
use Core\Model\JWT;
use Throwable;

class Auth
{
      private static $instance = null;
      private static $redirect_protect_path = REDIRECT_PROTECT_PATH ?? "";
      public static function getInstance()
      {
            if (is_null(self::$instance)) {
                  self::$instance = new self;
            }
            return self::$instance;
      }
      public function verify(string $email, string $password)
      {     var_dump($email);
            var_dump($password);
            if ($password == $this->getPassword($email)) {
                  $_SESSION['is_logged'] = true;
            } else {
                  $this->redirect();
            }
      }

      public function verifyApiAccess(string $email, string $password)
      {
            header('Content-Type: application/json');

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

      public function protect()
      {
            if (!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] != true) {
                  $this->redirect();
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
                  $user = App::$db->getOneFrom('accounts', 'accounts_email', $id);
                  return $user['accounts_password'];
            } catch (Throwable $e) {
                  $this->redirect();
            }
      }
      public function disconnect()
      {     
            echo'here';
            $_SESSION['is_logged'] = false;
            session_destroy();
            $this->redirect();
      }
      private function redirect(){
            header("Location: " . self::$redirect_protect_path);
            exit();
      }
}
