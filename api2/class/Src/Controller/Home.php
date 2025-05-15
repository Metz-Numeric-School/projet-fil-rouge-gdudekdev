<?php

namespace Src\Controller;

class Home
{
      public function handle($url, $data)
      {
            Auth::getInstance()->protect();
            include ROOT . '/view/Home/home.php';
      }

}