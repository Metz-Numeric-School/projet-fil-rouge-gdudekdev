<?php

namespace Src\Model;

use App;

class Routes extends Model
{
      public static $table = 'routes';
      public static $dependencies = ['rides'];
      private function update_show($id)
      {
            $route = new \Src\Entity\routes(App::$db->getOneFrom('routes', 'routes_id', $id));
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
                        "routes" => App::$db->getAllFromWhere("routes", ['stmt' => 'accounts_id =:accounts_id', 'params' => [':accounts_id' => $url['accounts_id']]]),
                        "account_id" => $url['accounts_id'],
                  ];
      }
}
