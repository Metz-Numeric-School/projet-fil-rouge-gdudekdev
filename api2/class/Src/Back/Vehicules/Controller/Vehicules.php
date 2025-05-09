<?php

namespace Src\Back\Vehicules\Controller;

use App;
use Src\Controller\Auth;

class Vehicules
{

      public function handle($url)
      {
            Auth::getInstance()->protect();
            if(isset($url['accounts_id'])){
                  $title = "Véhicule de l'utilisateur n°" . $url['accounts_id'] ;
                  $model = new \Src\Back\Vehicules\Model\Vehicules;
                  extract($model->handle($url));
                  
                  if(isset($url['id'])){
                        include __DIR__ . '/../view/vehicules_detail.php';
                  }else if(isset($url['add'])){
                        include __DIR__ . '/../view/vehicules_create.php';
                  }else{
                        include __DIR__ . '/../view/vehicules.php';
                  }
            } else {
                  header("Location: index.php?page=home");
                  exit();
            }
      }
}
