<?php
namespace Back\Model;

use Core\Model\Crud;

class ProcessPreferencesModel extends Crud
{
      // TODO déplacer les classes de process dans un dossier a part comme pour accounts et changer les namesapce en conséquences
      // 
      public function handleProcess(array $params, array $data)
      {
            var_dump($params);
            var_dump($data);
            echo 'process preferences';
      }

}
