<?php

namespace Src\Controller;

class Divisions extends Controller
{
      public static $table = 'divisions';
      public static $redirect_path;
      public static function redirectPath()
      {
            if(isset(self::$url_params['entreprises_id'])){
                  $id = self::$url_params['entreprises_id'];
            }else{
                  $id = self::$url_params['id'];
            }
            self::$redirect_path = "index.php?page=entreprises&id=" . $id;
            return self::$redirect_path;
      }
}
