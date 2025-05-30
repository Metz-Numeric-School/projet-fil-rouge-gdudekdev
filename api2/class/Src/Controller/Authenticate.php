<?php

namespace Src\Controller;

use Core\Model\JWT;
use Src\Auth\Auth;

class Authenticate extends Controller
{
      public function handle($url, $data)
      {
            if (isset($data['email']) && isset($data['password'])) {
                  $this->login($data);
            }
            if (isset($url['logout']) && $url['logout'] == true) {
                  $this->logout();

            }
            require ROOT . '/view/Authenticate/authenticate.php';
      }

      private function login(array $data)
      {
            Auth::verify($data['email'], $data['password']);
            header('Location: /index.php?page=home');
            exit();

      }
      public function handleApiLogin($data)
      {
            $body = $data['body'];
            if (Auth::verifyApiAccess($body->email, $body->password)) {
                  echo 'test';
            }
      }
      public function handleApiLogout($data)
      {
            $headers = $data['headers'];
            $token = $headers['Bearer'] ?? "";
            if (!empty($token)) {
                  var_dump($token);
                  $jwt = new JWT();
                  var_dump($jwt->decode($token));
            }
            // TODO créer une blacklist qui supprime au bout d'un certain temps le token
      }
      private function logout()
      {
            Auth::disconnect();
      }
}
