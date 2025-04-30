<?php

namespace Back\Accounts\Model;

use Core\Model\Database;

class AccountsModel
{
      public function handle($params)
      {
            // Adding an account
            if (isset($params['id'])) {
                  $recordset = Database::getInstance()->getOneFrom('accounts', 'accounts_id', $params['id']);
                  $roles = $this->fetchRoles();
                  $divisions = $this->fetchDivisions();
                  $recordset = [
                        "accounts" => $recordset,
                        "roles" => $roles,
                        "divisions" => $divisions,
                  ];
                  // Creating an account
            } else if (isset($params['mode']) && $params['mode'] == 'create') {
                  $recordset = Database::getInstance()->getAllFrom("accounts");
                  $r
                  // Displaying all the accounts
            } else {
                  $recordset = Database::getInstance()->getAllFrom("accounts");
            }
            return $recordset;
      }
      private function fetchRoles()
      {
            return Database::getInstance()->getAllFrom('roles');
      }
      private function fetchDivisions()
      {
            return Database::getInstance()->getAllFrom('divisions');
      }
}
