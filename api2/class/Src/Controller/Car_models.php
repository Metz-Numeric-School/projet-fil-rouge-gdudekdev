<?php


namespace Src\Controller;


class Car_models extends Controller
{
      public static $table = 'car_models';
      public static $redirect_path;
      public static function redirectPath()
      {
            if (isset(self::$url_params['car_brands_id'])) {
                  $id = self::$url_params['car_brands_id'];
            } else {
                  $id = self::$url_params['id'];
            }
            self::$redirect_path = "index.php?page=cars&sub=brands&id=" . $id;
            return self::$redirect_path;
      }
}
