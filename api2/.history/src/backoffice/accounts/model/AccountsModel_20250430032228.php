<?php

namespace Back\Accounts\Model;

use Core\Model\Database;
// TODO potentiellemnt extends d'un modele abstract qui contiendrait le handle et les infos de config
class AccountsModel
{
      const array_accepted_key = [
            'accounts_id' => [
                  'title' => 'Numéro d\'identifiant',
                  'readonly' => true,
                  'crud_show'=>true,
                  'detail_show'=>false,
                  'create_show'=>false,
                  'type' => "number",
            ],
            'accounts_fullname' => [
                  'title' => 'Nom complet',
                  'detail_show'=>true,
                  'create_show'=>true,
                  'crud_show'=>true,
                  'readonly' => false,
            ],
            'accounts_email' => [
                  'title' => 'Email',
                  'detail_show'=>true,
                  'create_show'=>true,
                  'crud_show'=>true,
                  'readonly' => false,
            ],
            'accounts_birthday' => [
                  'title' => 'Date d\'anniversaire',
                  'detail_show'=>true,
                  'create_show'=>true,
                  'crud_show'=>false,
                  'readonly' => false,
            ],
            'accounts_phone' => [
                  'title' => 'Numéro de téléphone',
                  'detail_show'=>true,
                  'create_show'=>true,
                  'crud_show'=>false,
                  'readonly' => false,
            ],
            'accounts_created_at' => [
                  'title' => 'Date de création',
                  'detail_show'=>true,
                  'create_show'=>false,
                  'crud_show'=>false,
                  'readonly' => true,
            ],
            'accounts_password' => [
                  'title' => 'Mot de passe',
                  'detail_show'=>false,
                  'create_show'=>true,
                  'crud_show'=>false,
                  'readonly' => false,
            ],
      ];
      public function handle($params)
      {
            // Updating an account
            if (isset($params['id'])) {
                  $recordset = Database::getInstance()->getOneFrom('accounts', 'accounts_id', $params['id']);
                  $roles = $this->fetchRoles();
                  $divisions = $this->fetchDivisions();
                  $preferences $this->fetchPreferences();
                  $accountPreferences = [];
                  foreach($this->fetchAccountPreferences($params['id']) as $accountPreference){
                        $accountPreferences[] = $this->fetchByIdPreferences($accountPreference['preferences_id']);
                  }
                  $recordset = [
                        "accounts" => $recordset,
                        "roles" => $roles,
                        "divisions" => $divisions,
                        "preferences"=>$preferences,
                        "accountPreferences" => $accountPreferences,
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
      private function fetchAccountPreferences($id){
            return Database::getInstance()->getAllFromWhere('accounts_preferences',['stmt'=>"accounts_id =:id",'params'=>[':id'=>intval($id)]]);
      }
      private function fetchPreferencesById($id){
            return Database::getInstance()->getOneFrom('preferences','preferences_id',$id);
      }
      private function fetchPreferences(){
            return Database::getInstance()->getAllFrom('preferences');
      }
}
