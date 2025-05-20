<?php

namespace Src\Controller;

class Rides extends Controller
{
      public static $table = 'rides';
      public static $title = 'Page de gestion des Trajets Utilisateurs';
      public static $redirect_path;
      public static function redirectPath()
      {
            if (isset(self::$url_params['accounts_id'])) {
                  $id = self::$url_params['accounts_id'];
            } else {
                  $id = self::$url_params['id'];
            }
            self::$redirect_path = "index.php?page=rides&accounts_id=" . $id;
            return self::$redirect_path;
      }
}
