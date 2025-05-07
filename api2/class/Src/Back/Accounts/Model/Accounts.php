<?php

namespace Src\Back\Accounts\Model;

use App;
use Core\Model\Database;

class Accounts
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
            $account = new \Src\Entity\Accounts(App::$db->getOneFrom('accounts', 'accounts_id', $id));
            $roles = App::$db->getAllFrom('roles');
            $divisions = App::$db->getAllFrom('divisions');
            $preferences = App::$db->getAllFrom('preferences');
            $account_preferences = array_column(App::$db->getAllFromWhere('accounts_preferences', ['stmt' => 'accounts_id =:accounts_id', 'params' => [':accounts_id' => $account->id()]]), 'preferences_id');
            return
                  compact(["account", "roles", "divisions", "preferences", "account_preferences"], ["account", "roles", "divisions", "preferences", "account_preferences"]);
      }
      private function add_show()
      {
            $account = new \Src\Entity\Accounts();
            $roles = App::$db->getAllFrom('roles');
            $divisions = App::$db->getAllFrom('divisions');
            return
                  compact(["account", "roles", "divisions"], ["account", "roles", "divisions"]);
            
      }
      private function all_show()
      {
            return
                  [
                        "accounts" => App::$db->getAllFrom("accounts"),
                  ];
      }
}
