<?php

namespace Back\Controller;

use Back\Model\ProcessModel;
use Back\Model\ProcessPreferencesModel;
use Core\Model\Auth;

class ProcessController
{
      /**
       * Methode de traitement du formulaire du crud
       * @var     params : parametrage du process
       * @var     data   : données relative au parametrage
       */
      public function handleProcess(array $params , array $data)
      {     
            Auth::getInstance()->protect();
            if(!isset($params['table']) || !isset($params['mode'])){
                  http_response_code(400);
                  die('Erreur de la requête');
            }
            // TODO faire le process de l'ajout de préférences 
            if($params['table'] === 'accounts_preferences'){
                  $model = new ProcessPreferencesModel;
            }else{
                  $model = new ProcessModel;
            }
            $recordset = $model->handleProcess($params,$data);
      }
}
