<?php
namespace Framework\Routing;

use Throwable, Exception;

class Router
{
      protected $routes = [];
      protected $errorHandlers = [];
      protected $current;

      public function add(
            $method,
            $path,
            $handler
      ) {
            $route = $this->routes[] = new Route($method, $path, $handler);
      }
      public function dispatch()
      {
            $paths = $this->paths();

            $requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
            $requestPath = $_SERVER['REQUEST_URI'] ?? '/';

            $matching = $this->match($requestMethod, $requestPath);

            if ($matching) {
                  try {
                        return $matching->dispatch();
                  } catch (Throwable $e) {
                        return $this->dispatchError();
                  }
            }
            if (in_array($requestPath, $paths)) {
                  return $this->dispatchNotAllowed();
            }
            return $this->dispatchNotFound();
      }
      private function paths()
      {
            $paths = [];
            foreach ($this->routes as $route) {
                  $paths[] = $route->path();
            }
            return $paths;
      }
      private function match($method, $path)
      {
            foreach ($this->routes as $route) {
                  if ($route->matches($method, $path)) {
                        return $route;
                  }
            }
            return null;
      }
      public function errorHandler($code, $handler)
      {
            $this->errorHandlers[$code] = $handler;
      }
      public function dispatchNotAllowed()
      {
            $this->errorHandlers[400] ??= fn() => "not allowed";
            return $this->errorHandlers[400]();
      }
      public function dispatchNotFound()
      {
            $this->errorHandlers[404] ??= fn() => "not found";
            return $this->errorHandlers[404]();
      }
      public function dispatchError()
      {
            $this->errorHandlers[500] ??= fn() => "server error";
            return $this->errorHandlers[500]();
      }
      public function redirect($path){
            header(
                  "Location: {$path}", true , 301
            );
            exit();
      }
      public function current(){
            return $this->current;
      }
      public function route(
            string $name,
            array $parameters = [],
           )
           {
            foreach ($this->routes as $route) {
            if ($route->name() === $name) {
            $finds = [];
            $replaces = [];
            foreach ($parameters as $key => $value) {
            array_push($finds, "{{$key}}");
            array_push($replaces, $value);

            array_push($finds, "{{$key}?}");
            array_push($replaces, $value);
            }
            $path = $route->path();
            $path = str_replace($finds, $replaces, $path);
            $path = preg_replace('#{[^}]+}#', '', $path);
            return $path;
            }
            }
            throw new Exception('no route with that name');
           }
}