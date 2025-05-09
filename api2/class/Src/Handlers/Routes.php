<?php

namespace Src\Handlers;

use App;

class Routes
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
            // Case where the account associated is deleted
            if (isset($data['account_id'])) {
                  \Src\Handlers\Handlers::instance()->handle(['table'=>'rides'],['account_id'=>$data['account_id']]);
                  App::$db->deleteFromWhere('routes', ['stmt' => 'accounts_id = :accounts_id', 'params' => [':accounts_id' => $data['account_id']]]);
            } else {
                  if (sizeof($data) == 0) {
                        if (isset($url['remove']) && isset($url['id'])) {
                              \Src\Handlers\Handlers::instance()->handle(['table'=>'rides'],['route_id'=>$url['id']]);
                              $account_id = App::$db->getOneFrom('routes', 'routes_id', $url['id'])['accounts_id'];
                              // TODO delete all rides related to the routes
                              App::$db->delete('routes', $url['id']);
                              header("Location: index.php?page=routes&accounts_id=" . $account_id);
                              exit();
                        }
                  } else {
                        if (empty($data['routes_id'])) {
                              App::$db->add('routes', $data);
                              header("Location: index.php?page=routes&accounts_id=" . $data['accounts_id']);
                              exit();
                        } else {
                              App::$db->update('routes', $data);
                              header("Location: index.php?page=routes&accounts_id=" . $data['accounts_id']);
                              exit();
                        }
                  }
            }

      }

}