<?php

namespace Src\Handlers;

use App;
use Core\Model\Handlers;

class Preferences extends Handlers
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
                        $this->delete('preferences', $url['id']);
                        \Src\Handlers\Handlers::instance()->handle(['table'=>'accounts_preferences'], ['preferences_id'=>$url['id']]);
                        header("Location: index.php?page=preferences");
                        exit();
                  }
            } else {
                  if(empty($data['preferences_id'])){
                        App::$db->add('preferences',$data);
                        header("Location: index.php?page=preferences");
                        exit();
                  }else{
                        $this->save('preferences', $data);
                        header("Location: index.php?page=preferences&id=" . $data['preferences_id']);
                        exit();
                  }
            }
      }
      
}