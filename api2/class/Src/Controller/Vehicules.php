<?php

namespace Src\Controller;

class Vehicules extends Controller
{
      public static $table = 'vehicules';
      public static $title = 'Page de gestion des Vehicules';
      public static $redirect_path;

      public static function redirectPath()
      {
            if (isset(self::$url_params['accounts_id'])) {
                  $id = self::$url_params['accounts_id'];
            } else {
                  $id = self::$url_params['id'];
            }
            self::$redirect_path = "index.php?page=vehicules&accounts_id=" . $id;
            return self::$redirect_path;
      }
}
