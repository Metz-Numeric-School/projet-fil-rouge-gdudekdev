<?php 

namespace Back\Controller;

use Core\Model\Auth;

class HomeController{

      public function handleHome(){
            Auth::getInstance()->protect();
            include __DIR__ .'/../view/home.php';
      }
      
}