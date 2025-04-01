<?php
namespace App\Router;

class Route
{
      private $path;
      private $callable;
      private $matches;
      public function __construct($path, $callable)
      {
            $this->path = trim($path, '/');
            $this->callable = $callable;
      }
      public function match($url)
      {
            $url = trim($url, '/');
            $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
            $regex = '#^' . $path . '$#i'; // i permet de faire un match case sensitive
            if (!preg_match($regex, $url, $matches)) {
                  return false;
            }
            if (sizeof($matches) > 1) {
                  array_shift($matches);
            }
            $this->matches = $matches[0];
            return true;
      }
      public function call()
      {
            return call_user_func($this->callable, $this->matches);
      }
}