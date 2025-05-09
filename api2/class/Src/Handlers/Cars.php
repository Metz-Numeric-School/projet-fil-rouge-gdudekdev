<?php

namespace Src\Handlers;

use App;
use Core\Model\Handlers;

class Cars extends Handlers
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
            if(isset($url['sub'])){
                  switch($url['sub']){
                        case 'brands' :
                              Car_brands::instance()->handle($url, $data);
                        case 'models' :
                              Car_models::instance()->handle($url, $data);
                        case 'colors' :
                              Car_colors::instance()->handle($url, $data);
                        case 'engines' :
                              Car_engines::instance()->handle($url, $data);
                  }
            }
            
      }

}