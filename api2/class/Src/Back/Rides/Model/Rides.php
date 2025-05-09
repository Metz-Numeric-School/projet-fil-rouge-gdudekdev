<?php

namespace Src\Back\Rides\Model;

use App;

class Rides
{
      public function handle($url)
      {
            // Display rides interfaces     
            if (isset($url['id'])) {
                  // Updating
                  $recordset = $this->update_show($url);
            } else if (isset($url['add'])) {
                  // Creating
                  $recordset = $this->add_show($url);
            } else {
                  // Display all
                  $recordset = $this->all_show($url);
            }
            return $recordset;
      }
      private function update_show($url)
      {
            $ride = new \Src\Entity\Rides(App::$db->getOneFrom('rides', 'rides_id', $url['id']));
            $account_id= $url['accounts_id'];
            $vehicules= App::$db->getAllFromWhere('vehicules',['stmt'=>'accounts_id =:accounts_id','params'=>[':accounts_id'=>$url['accounts_id']]]);
            $routes= App::$db->getAllFromWhere('routes',['stmt'=>'accounts_id =:accounts_id','params'=>[':accounts_id'=>$url['accounts_id']]]);
            $rides_recurrence_type= App::$db->getAllFrom('rides_recurrence_type');
            $models = [];
            $brands = [];
            $colors = [];
            $engines = [];
            foreach($vehicules as $vehicule){
                  $vehicule = new \Src\Entity\Vehicules($vehicule);
                  $models[] =  App::$db->getOneFrom('car_models','car_models_id',$vehicule->car_models_id())['car_models_name'];
                  $brandId =  App::$db->getOneFrom('car_models','car_models_id',$vehicule->car_models_id())['car_brands_id'];
                  $brands[] =  App::$db->getOneFrom('car_brands','car_brands_id',$brandId)['car_brands_name'];
                  $colors[] =  App::$db->getOneFrom('car_colors','car_colors_id',$vehicule->car_colors_id())['car_colors_name'];
                  $engines[] =  App::$db->getOneFrom('car_engines','car_engines_id',$vehicule->car_engines_id())['car_engines_name'];
            }
            return
                  compact(["ride", "account_id","vehicules","routes","rides_recurrence_type","models","brands","colors","engines"], ["ride", "account_id","vehicules","routes","rides_recurrence_type","models","brands","colors","engines"]);
      }
      private function add_show($url)
      {
            $ride = new \Src\Entity\Rides();
            $account_id= $url['accounts_id'];
            $vehicules= App::$db->getAllFromWhere('vehicules',['stmt'=>'accounts_id =:accounts_id','params'=>[':accounts_id'=>$url['accounts_id']]]);
            $routes= App::$db->getAllFromWhere('routes',['stmt'=>'accounts_id =:accounts_id','params'=>[':accounts_id'=>$url['accounts_id']]]);
            $rides_recurrence_type= App::$db->getAllFrom('rides_recurrence_type');
            $models = [];
            $brands = [];
            $colors = [];
            $engines = [];
            foreach($vehicules as $vehicule){
                  $vehicule = new \Src\Entity\Vehicules($vehicule);
                  $models[] =  App::$db->getOneFrom('car_models','car_models_id',$vehicule->car_models_id())['car_models_name'];
                  $brandId =  App::$db->getOneFrom('car_models','car_models_id',$vehicule->car_models_id())['car_brands_id'];
                  $brands[] =  App::$db->getOneFrom('car_brands','car_brands_id',$brandId)['car_brands_name'];
                  $colors[] =  App::$db->getOneFrom('car_colors','car_colors_id',$vehicule->car_colors_id())['car_colors_name'];
                  $engines[] =  App::$db->getOneFrom('car_engines','car_engines_id',$vehicule->car_engines_id())['car_engines_name'];
            }
            return
                  compact(["ride", "account_id","vehicules","routes","rides_recurrence_type","models","brands","colors","engines"], ["ride", "account_id","vehicules","routes","rides_recurrence_type","models","brands","colors","engines"]);
            
      }
      private function all_show($url)
      {
            $routes= App::$db->getAllFromWhere('routes',['stmt'=>'accounts_id =:accounts_id','params'=>[':accounts_id'=>$url['accounts_id']]]);
            $rides =[];
            foreach($routes as $route){
                  $corresponding_rides = App::$db->getAllFromWhere("rides",['stmt'=> 'routes_id =:routes_id','params'=>[':routes_id'=>$route['routes_id']]]);
                  foreach($corresponding_rides as $ride){
                        array_push($rides,$ride);
                  }
            }
            return
                  [
                       "rides" => $rides,
                        "account_id"=>$url['accounts_id'],
                  ];
      }
}
