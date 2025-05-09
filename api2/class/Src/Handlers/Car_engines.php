<?php

namespace Src\Handlers;

use App;

class Car_engines
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
                        App::$db->delete('car_engines', $url['id']);
                        header("Location: index.php?page=cars&sub=engines");
                        exit();
                  }
            } else {
                  App::$db->add('car_engines', $data);
                  header("Location: index.php?page=cars&sub=engines");
                  exit();
            }
      }

}