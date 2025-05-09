<?php

namespace Src\Handlers;

use App;

class Car_brands 
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
                        App::$db->delete('car_brands', $url['id']);
                        \Src\Handlers\Handlers::instance()->handle(['table'=>'cars','sub'=>'models','car_brands_id'=>$url['id']],[]);
                        header("Location: index.php?page=cars&sub=brands");
                        exit();
                  }
            } else {
                  if(empty($data['car_brands_id'])){
                        App::$db->add('car_brands',$data);
                        header("Location: index.php?page=cars&sub=brands");
                        exit();
                  }else{
                        App::$db->update('car_brands', $data);
                        header("Location: index.php?page=cars&sub=brands&id=" . $data['car_brands_id']);
                        exit();
                  }
            }
      }
      
}