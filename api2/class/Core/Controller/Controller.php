<?php

namespace Core\Controller;

class Controller
{
      public $viewPath;


      public function render(string $view, array $params = [])
      {
            extract($params);
            require $this->viewPath . $view . '.php';
      }
}
