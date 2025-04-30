<?php

namespace Back\Model;

use Core\Model\Crud;
use Core\Model\Database;

class ProcessPreferencesModel extends Crud
{
      // TODO déplacer les classes de process dans un dossier a part comme pour accounts et changer les namesapce en conséquences
      // Voir si il est plus judicieux de supprimer tous les champs de la table accounts_preferences pour le compte et de tous les rajouter, ou si on fait au cas par cas et on appelle des méthodes de suprresion, modification ou ajout adapter
      public function handleProcess(array $params, array $data)
      {
             isset($data['accounts_id']) ? $user_id =$data['accounts_id'] : exit();
            echo 'here';
            if (!isset($data['preferences'])) {
                  header("Location: index.php?page=accounts");
                  exit();
            }
           

            // Suppression de toutes les préférences utilisateurs

            $user_preferences = Database::getInstance()->getAllFromWhere('accounts_preferences', ['stmt' => 'accounts_id =:id', 'params' => [':id' => $user_id]]);

            foreach ($user_preferences as $pref) {
                  Database::getInstance()->deleteFromWhere('accounts_preferences', [
                        'stmt' => 'accounts_id = :accounts_id AND preferences_id= :preferences_id',
                        'params' => [':accounts_id' => $user_id, ':preferences_id' => $pref['preferences_id']]
                  ]);
            }

            // Ajout des nouvelles préférences

            foreach ($data['preferences'] as $pref) {
                  var_dump($pref);
                  Database::getInstance()->add('accounts_preferences', ['accounts_id' => $user_id, 'preferences_id' => $pref]);
            }
            $new_preferences =  $user_preferences = Database::getInstance()->getAllFromWhere('accounts_preferences', ['stmt' => 'accounts_id =:id', 'params' => [':id' => $user_id]]);
            header("Location: index.php?page=accounts&id=" . $user_id);
            exit();
            
      }
}
