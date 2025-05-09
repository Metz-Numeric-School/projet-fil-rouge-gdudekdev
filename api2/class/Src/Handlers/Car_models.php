<?php

namespace Src\Handlers;

use App;

class Car_models
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
            if(isset($url['car_brands_id'])){
                  App::$db->deleteFromWhere('car_models',['stmt'=>'car_brands_id =:car_brands_id','params'=>[':car_brands_id'=>$url['car_brands_id']]]);
            }
            if (sizeof($data) == 0) {
                  if (isset($url['remove']) && isset($url['id'])) {
                        $brand_id = App::$db->getOneFrom('car_models','car_models_id',$url['id'])['car_brands_id'];
                        App::$db->delete('car_models', $url['id']);
                        header("Location: index.php?page=cars&sub=brands&id=" . $brand_id);
                        exit();
                  }
            } else {
                  App::$db->add('car_models', $data);
                  header("Location: index.php?page=cars&sub=brands&id=" . $data['car_brands_id']);
                  exit();
            }
      }

}