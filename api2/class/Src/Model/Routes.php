<?php

namespace Src\Model;

use App;

class Routes extends Model
{
      public static $table = 'routes';
      public static $dependencies = ['rides'];
      protected static function update_show()
      {
            $id = $_GET['id'] ?? 0;
            $route = new \Src\Entity\routes(App::$db->getOneFrom('routes', 'routes_id', $id));
            $account_id = $route->accounts_id();
            return
                  compact(["route", "account_id"], ["route", "account_id"]);
      }
      protected static function add_show()
      {
            $route = new \Src\Entity\routes();
            $account_id = $_GET['accounts_id'] ?? 0;
            return
                  compact(["route", "account_id"], ["route", "account_id"]);

      }
      protected static function all_show()
      {
            $account_id = $_GET['accounts_id'] ?? 0;
            return
                  [
                        "routes" => App::$db->getAllFromWhere("routes", ['stmt' => 'accounts_id =:accounts_id', 'params' => [':accounts_id' => $account_id]]),
                        "account_id" => $account_id,
                  ];
      }
}
