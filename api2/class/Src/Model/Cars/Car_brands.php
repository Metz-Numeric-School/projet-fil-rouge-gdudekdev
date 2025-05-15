<?php

namespace Src\Back\Cars\Model;

use App;

class Car_brands
{
      public function handle($url)
      {
            // Display accounts interfaces     
            if (isset($url['id'])) {
                  // Updating
                  $recordset = $this->update_show($url['id']);
            } else if (isset($url['add'])) {
                  // Creating
                  $recordset = $this->add_show();
            } else {
                  // Display all
                  $recordset = $this->all_show();
            }
            return $recordset;
      }
      private function update_show($id)
      {
            $car_brand = new \Src\Entity\Car_brands(App::$db->getOneFrom('car_brands', 'car_brands_id', $id));
            $models = App::$db->getAllFromWhere('car_models',['stmt'=>'car_brands_id =:car_brands_id' , 'params'=>[':car_brands_id'=>$car_brand->id()]]);
            return
                  compact(["car_brand","models"], ["car_brand","models"]);
      }
      private function add_show()
      {
            $car_brand = new \Src\Entity\Car_brands();
            return
                  compact(["car_brand"], ["car_brand"]);
            
      }
      private function all_show()
      {
            return
                  [
                        "car_brands" => App::$db->getAllFrom("car_brands"),
                  ];
      }
}
