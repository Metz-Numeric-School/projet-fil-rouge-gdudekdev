<?php

namespace Back\Accounts;

use Core\Model\Database;
// TODO potentiellemnt extends d'un modele abstract qui contiendrait le handle et les infos de config pour lorsque que l'on devra traiter les autres table du crud qui nous interesse
class AccountsModel
{
      const array_accepted_key = [
            'accounts_id' => [
                  'title' => 'Numéro d\'identifiant',
                  'readonly' => true,
                  'crud_show' => true,
                  'detail_show' => false,
                  'create_show' => false,
                  'type' => "number",
            ],
            'accounts_fullname' => [
                  'title' => 'Nom complet',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => true,
                  'readonly' => false,
            ],
            'accounts_email' => [
                  'title' => 'Email',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => true,
                  'readonly' => false,
            ],
            'accounts_birthday' => [
                  'title' => 'Date d\'anniversaire',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => false,
                  'readonly' => false,
            ],
            'accounts_phone' => [
                  'title' => 'Numéro de téléphone',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => false,
                  'readonly' => false,
            ],
            'accounts_created_at' => [
                  'title' => 'Date de création',
                  'detail_show' => true,
                  'create_show' => false,
                  'crud_show' => false,
                  'readonly' => true,
            ],
            'accounts_password' => [
                  'title' => 'Mot de passe',
                  'detail_show' => false,
                  'create_show' => true,
                  'crud_show' => false,
                  'readonly' => false,
            ],
      ];
      public function handle($params)
      {
            // Updating an account
            if (isset($params['id'])) {
                  $recordset = [
                        "accounts" => Database::getInstance()->getOneFrom('accounts', 'accounts_id', $params['id']),
                        "roles" => Database::getInstance()->getAllFrom('roles'),
                        "divisions" => Database::getInstance()->getAllFrom('divisions'),
                        "preferences" => Database::getInstance()->getAllFrom('preferences'),
                        "accountPreferences" => $this->fetchAccountPreferences($params['id']),
                  ];
                  // Creating an account
            } else if (isset($params['mode']) && $params['mode'] == 'create') {
                  $recordset = [
                        "accounts" => Database::getInstance()->getBlankInput("accounts"),
                        "roles" => Database::getInstance()->getAllFrom('roles'),
                        "divisions" => Database::getInstance()->getAllFrom('divisions'),
                        "preferences" => Database::getInstance()->getAllFrom('preferences'),
                  ];
                  // Displaying all the accounts
            } else {
                  $recordset = Database::getInstance()->getAllFrom("accounts");
            }
            return $recordset;
      }
    
      private function fetchAccountsPreferencesData($id)
      {
            return Database::getInstance()->getAllFromWhere('accounts_preferences', ['stmt' => "accounts_id =:id", 'params' => [':id' => intval($id)]]);
      }
      private function fetchPreferencesById($id)
      {
            return Database::getInstance()->getOneFrom('preferences', 'preferences_id', $id);
      }
      private function fetchAccountPreferences($id)
      {
            $accountPreferences = [];
            foreach ($this->fetchAccountsPreferencesData($id) as $accountPreference) {
                  $accountPreferences[] = $this->fetchPreferencesById($accountPreference['preferences_id']);
            }
            return $accountPreferences;
      }
}
