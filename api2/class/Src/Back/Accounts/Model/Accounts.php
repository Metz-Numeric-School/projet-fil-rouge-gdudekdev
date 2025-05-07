<?php

namespace Src\Back\Accounts\Model;

use App;

class Accounts
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
            $account = new \Src\Entity\Accounts(App::$db->getOneFrom('accounts', 'accounts_id', $id));
            $roles = App::$db->getAllFrom('roles');
            $entreprises = App::$db->getAllFrom('entreprises');
            $division_entreprises = App::$db->getOneFrom('divisions','divisions_id',$account->divisions_id());
            if(!$division_entreprises){
                  $division_entreprises = App::$db->getAllFrom('divisions')[0];
            }
            $divisions = App::$db->getAllFrom('divisions');
            $preferences = App::$db->getAllFrom('preferences');
            $account_preferences = array_column(App::$db->getAllFromWhere('accounts_preferences', ['stmt' => 'accounts_id =:accounts_id', 'params' => [':accounts_id' => $account->id()]]), 'preferences_id');
            return
                  compact(["account", "roles", "entreprises","divisions","division_entreprises", "preferences", "account_preferences"], ["account", "roles", "entreprises","divisions","division_entreprises", "preferences", "account_preferences"]);
      }
      private function add_show()
      {
            $account = new \Src\Entity\Accounts();
            $roles = App::$db->getAllFrom('roles');
            $entreprises = App::$db->getAllFrom('entreprises');
            $divisions = App::$db->getAllFrom('divisions');
            return
                  compact(["account", "roles","entreprises", "divisions"], ["account", "roles","entreprises","divisions"]);
            
      }
      private function all_show()
      {
            return
                  [
                        "accounts" => App::$db->getAllFrom("accounts"),
                  ];
      }
}
