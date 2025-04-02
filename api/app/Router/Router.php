<?php
namespace App\Router;

class Router
{
      private $routes = [];

      public function addRoute($method, $path, $handler)
      {
            $pattern = preg_replace('/\{([\w]+)\}/', '([^/]+)', $path);
            $pattern = "#^" . $pattern . "$#";
            $this->routes[] = [
                  'method' => strtoupper($method),
                  'pattern' => $pattern,
                  'handler' => $handler,
            ];
      }
      public function getRoutes()
      {
            return $this->routes;
      }
      public function dispatch($requestMethod, $requestUri)
      {
            foreach ($this->routes as $route) {
                  if ($route['method'] === strtoupper($requestMethod) && preg_match($route['pattern'], $requestUri, $matches)) {
                        array_shift($matches);

                        $data = $requestMethod === 'POST' ? $_POST : [];

                        call_user_func_array($route['handler'], array_merge($matches,[$data]));
                        return;
                  }
            }

            http_response_code(404);
            echo '404 not found';
      }

}