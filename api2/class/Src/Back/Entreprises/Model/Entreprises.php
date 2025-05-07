<?php

namespace Src\Back\Entreprises\Model;

use App;

class Entreprises
{
      public function handle($params)
      {
            // Display accounts interfaces     
            if (isset($params['GET']['id'])) {
                  // Updating
                  $recordset = $this->update_show($params['GET']['id']);
            } else if (isset($params['GET']['add'])) {
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
            $entreprise = new \Src\Entity\Entreprises(App::$db->getOneFrom('entreprises', 'entreprises_id', $id));
            $division = App::$db->getAllFromWhere('divisions',['stmt'=>'entreprises_id =:entreprises_id' , 'params'=>[':entreprises_id'=>$entreprise->id()]]);
            return
                  compact(["entreprise","division"], ["entreprise","division"]);
      }
      private function add_show()
      {
            $entreprise = new \Src\Entity\Entreprises();
            return
                  compact(["entreprise"], ["entreprise"]);
            
      }
      private function all_show()
      {
            return
                  [
                        "entreprises" => App::$db->getAllFrom("entreprises"),
                  ];
      }
}
