<?php

namespace Src\Back\routes\Model;

use App;

class routes
{
      public function handle($url)
      {
            // Display routes interfaces     
            if (isset($url['id'])) {
                  // Updating
                  $recordset = $this->update_show($url['id']);
            } else if (isset($url['add'])) {
                  // Creating
                  $recordset = $this->add_show($url);
            } else {
                  // Display all
                  $recordset = $this->all_show($url);
            }
            return $recordset;
      }
      private function update_show($id)
      {
            $route = new \Src\Entity\routes(App::$db->getOneFrom('routes','routes_id',$id));
            $account_id = $route->accounts_id();
            return
                  compact(["route", "account_id"], ["route", "account_id"]);
      }
      private function add_show($url)
      {
            $route = new \Src\Entity\routes();
            $account_id = $url['accounts_id'];
            return
                  compact(["route", "account_id"], ["route", "account_id"]);
            
      }
      private function all_show($url)
      {     
            return
                  [
                        "routes" => App::$db->getAllFrom("routes"),
                        "account_id"=> $url['accounts_id'],
                  ];
      }
}
