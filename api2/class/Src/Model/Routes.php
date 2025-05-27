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
            $route = self::newEntity(self::get($id));
            $account_id = $route->accounts_id();
            return
                  compact(["route", "account_id"]);
      }
      protected static function add_show()
      {
            $route = self::newEntity();
            $account_id = $_GET['accounts_id'] ?? 0;
            return
                  compact(["route", "account_id"]);

      }
      protected static function all_show()
      {
            $account_id = $_GET['accounts_id'] ?? 0;
            return
                  [
                        "routes" => Routes::getAllWhere('accounts_id', $account_id),
                        "account_id" => $account_id,
                  ];
      }
}
