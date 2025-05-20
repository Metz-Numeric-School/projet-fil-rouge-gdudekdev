<?php

namespace Src\Controller;

class Routes extends Controller
{
      public static $table = 'routes';
      public static $title = 'Page de gestion des Itinéraires';
      public static $redirect_path;
      public static function redirectPath()
      {
            if (isset(self::$url_params['accounts_id'])) {
                  $id = self::$url_params['accounts_id'];
            } else {
                  $id = self::$url_params['id'];
            }
            self::$redirect_path = "index.php?page=routes&accounts_id=" . $id;
            return self::$redirect_path;
      }
}
