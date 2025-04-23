<?php

namespace Controller;

use Core\Class\Auth;
use Model\ProcessModel;

class ProcessController
{
      /**
       * Methode de traitement du formulaire du crud
       * @var     params : parametrage du process
       * @var     data   : données relative au parametrage
       */
      public function handleProcess(array $params , array $data)
      {           
            if(!isset($params['table']) && !isset($params['mode'])){
                  http_response_code(400);
                  die('Erreur de la requête');
            }
            $model = new ProcessModel;
            $recordset = $model->handleProcess($params,$data);
            var_dump($data);
            $table = $params['table'];
            include __DIR__ .'/../view/process.php';
      }
}
