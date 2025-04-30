<?php
namespace Back\Model;

use Core\Model\Crud;

class ProcessPreferencesModel extends Crud
{
      // TODO déplacer les classes de process dans un dossier a part comme pour accounts et changer les namesapce en conséquences
      // Voir si il est plus judicieux de supprimer tous les champs de la table accounts_preferences pour le compte et de tous les rajouter, ou si on fait au cas par cas et on appelle des méthodes de suprresion, modification ou ajout adapter
      public function handleProcess(array $params, array $data)
      {
            var_dump($params);
            var_dump($data);
            echo 'process preferences';
      }

}
