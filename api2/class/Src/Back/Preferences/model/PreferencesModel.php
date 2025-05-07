<?php

namespace Back\Preferences;

use Core\Model\Database;
// TODO potentiellemnt extends d'un modele abstract qui contiendrait le handle et les infos de config pour lorsque que l'on devra traiter les autres table du crud qui nous interesse
class PreferencesModel
{
      const array_accepted_key = [
            'preferences_id' => [
                  'title' => 'Identifiant de la préférence',
                  'readonly' => true,
                  'crud_show' => true,
                  'detail_show' => false,
                  'create_show' => false,
                  'type' => "number",
            ],
            'preferences_name' => [
                  'title' => 'Intitulé de la préférence',
                  'detail_show' => true,
                  'create_show' => true,
                  'crud_show' => true,
                  'readonly' => false,
            ],
      ];
      public function handle($params)
      {
            // Updating an account
            if (isset($params['id'])) {
                  $recordset = [
                        "preferences" => Database::getInstance()->getOneFrom('preferences', 'preferences_id', $params['id']),
                  ];
                  // Creating an account
            } else if (isset($params['mode']) && $params['mode'] == 'create') {
                  $recordset = [
                        "preferences" => Database::getInstance()->getBlankInput('preferences'),
                  ];
                  // Displaying all the accounts
            } else {
                  $recordset = Database::getInstance()->getAllFrom("preferences");
            }
            return $recordset;
      }
    
}
