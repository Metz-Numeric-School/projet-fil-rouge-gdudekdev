<?php

namespace Src\Handlers;

use App;

class Car_colors
{
      private static $instance;
      public static function instance()
      {
            if (is_null(self::$instance)) {
                  self::$instance = new self;
            }
            return self::$instance;
      }
      public function handle($url, $data)
      {
            if (sizeof($data) == 0) {
                  if (isset($url['remove']) && isset($url['id'])) {
                        App::$db->delete('car_colors', $url['id']);
                        header("Location: index.php?page=cars&sub=colors");
                        exit();
                  }
            } else {
                  App::$db->add('car_colors', $data);
                  header("Location: index.php?page=cars&sub=colors");
                  exit();
            }
      }

}