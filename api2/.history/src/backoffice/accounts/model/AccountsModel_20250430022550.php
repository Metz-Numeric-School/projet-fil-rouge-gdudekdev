<?php

namespace Back\Accounts\Model;

use Core\Model\Database;

class AccountsModel
{
      const array_accepted_key = [
            'accounts_id' => [
                  'title' => 'Numéro d\'identifiant',
                  'readonly' => true,
                  'crud'=>true,
                  'admin_show'=>true,
                  'type' => "number",
            ],
            'accounts_fullname' => [
                  'title' => 'Nom complet',
                  'admin_show'=>true,
                  'crud'=>true,
                  'readonly' => false,
            ],
            'accounts_email' => [
                  'title' => 'Email',
                  'admin_show'=>true,
                  'crud'=>true,
                  'readonly' => false,
            ],
            'accounts_birthday' => [
                  'title' => 'Date d\'anniversaire',
                  'admin_show'=>true,
                  'crud'=>false,
                  'readonly' => false,
            ],
            'accounts_phone' => [
                  'title' => 'Numéro de téléphone',
                  'admin_show'=>true,
                  'crud'=>false,
                  'readonly' => false,
            ],
            'accounts_created_at' => [
                  'title' => 'Date de création',
                  'admin_show'=>true,
                  'crud'=>true,
                  'readonly' => true,
            ],
            'accounts_password' => [
                  'title' => 'Mot de passe',
                  'admin_show'=>false,
                  'crud'=>false,
                  'readonly' => false,
            ],
      ];
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
                  $recordset = Database::getInstance()->getBlankInput("accounts");
                  $roles = $this->fetchRoles();
                  $divisions = $this->fetchDivisions();
                  $recordset = [
                        "accounts" => $recordset,
                        "roles" => $roles,
                        "divisions" => $divisions,
                  ];
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
