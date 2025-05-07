<?php 

namespace Src\Back\Home\Controller;

use Src\Controller\Auth;



class Home{

      public function handleHome(){
            Auth::getInstance()->protect();
            include __DIR__ .'/../view/home.php';
      }
      
}