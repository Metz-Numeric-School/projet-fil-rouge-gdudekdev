<?php

namespace Api\Controller;

use Core\Class\Auth;

class RouteLogin
{
      // TODO dans le cas des routes dynamiques, il faudrait lire le currentRoute du RouteManager pour récupérer la valeur dynamique si nécessaire

      private $headers;
      private $body;

      public function __construct($params)
      {
            $this->headers = $params['headers'];
            $this->body = $params['body'];
      }
      public function login()
      {
            if (isset($this->body['email']) && isset($this->body['password'])) {
                  Auth::getInstance()->verifyApiAccess($this->body['email'], $this->body['password']);
            } else {
                  echo json_encode([
                        'error' => "Erreur de la requête",
                  ]);
            }
      }
}
