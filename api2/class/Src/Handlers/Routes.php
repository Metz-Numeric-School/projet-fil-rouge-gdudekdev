<?php

namespace Src\Handlers;

use App;

class Routes
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
                        App::$db->delete('routes', $url['id']);
                        header("Location: index.php?page=routes&accounts_id=" . $url['accounts_id']);
                        exit();
                  }
            } else {
                  if(empty($data['routes_id'])){
                        App::$db->add('routes',$data);
                        header("Location: index.php?page=routes&accounts_id=" . $data['accounts_id']);
                        exit();
                  }else{
                        App::$db->update('routes', $data);
                        header("Location: index.php?page=routes&accounts_id=" . $data['accounts_id']);
                        exit();
                  }
            }
      }
      
}