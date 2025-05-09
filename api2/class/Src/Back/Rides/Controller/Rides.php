<?php

namespace Src\Back\Rides\Controller;

use Src\Controller\Auth;


class Rides
{
      public function handle($url)
      {
            Auth::getInstance()->protect();
            $title = "Trajets de l'utilisateur";
            $model = new \Src\Back\Rides\Model\Rides;
            extract($model->handle($url));
            if(isset($url['accounts_id'])){
                  if (isset($url['id'])) {
                  include __DIR__ . '/../view/rides_detail.php';
            } else if (isset($url['add'])) {
                  include __DIR__ . '/../view/rides_create.php';
            } else {
                  include __DIR__ . '/../view/rides.php';
            }
            }else{
                  header("Location: index.php?page=accounts");
                  exit();
            }
            
      }
}
