<?php

namespace Src\Handlers\Back;

use App;
use Core\Interfaces\Handler;

class Vehicules implements Handler
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
                  App::$db->deleteFromWhere('vehicules', ['stmt' => 'accounts_id = :accounts_id', 'params' => [':accounts_id' => $data['account_id']]]);

            } else {
                  // Remove, add and update
                  if (sizeof($data) == 0) {
                        if (isset($url['remove']) && isset($url['id'])) {
                              $account_id = App::$db->getOneFrom('vehicules', 'vehicules_id', $url['id'])['accounts_id'];
                              App::$db->delete('vehicules', $url['id']);
                              header("Location: index.php?page=vehicules&accounts_id=" . $account_id);
                              exit();
                        }
                  } else {
                        if (empty($data['vehicules_id'])) {
                              App::$db->add('vehicules', $data);
                              header("Location: index.php?page=vehicules&accounts_id=" . $data['accounts_id']);
                              exit();
                        } else {
                              App::$db->update('vehicules', $data);
                              header("Location: index.php?page=vehicules&accounts_id=" . $url['accounts_id']);
                              exit();
                        }
                  }
            }


      }

}