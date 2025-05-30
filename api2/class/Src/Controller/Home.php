<?php

namespace Src\Controller;

class Home
{
      public function handle($url, $data)
      {
            \Src\Auth\Auth::protect();
            include ROOT . '/view/Home/home.php';
      }

}