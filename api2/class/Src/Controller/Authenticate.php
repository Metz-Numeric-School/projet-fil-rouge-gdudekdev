<?php

namespace Src\Controller;

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
            var_dump($data['body']);
            $body = $data['body'];
            if(Auth::verifyApiAccess($body->email,$body->password)){
                  echo 'test';
            }
      }
      private function logout()
      {
            Auth::disconnect();
      }
}
