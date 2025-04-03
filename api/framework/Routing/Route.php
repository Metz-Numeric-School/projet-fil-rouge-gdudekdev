<?php
namespace Framework\Routing;

class Route
{
      protected $method;
      protected $path;
      protected $handler;
      protected $parameters = [];
      protected $name = null;
      
      public function __construct(
            $method,
            $path,
            $handler
      ) {
            $this->method = $method;
            $this->path = $path;
            $this->handler = $handler;
      }

      public function method($method)
      {
            return $this->method;
      }
      public function path()
      {
            return $this->path;
      }
      public function matches($method, $path)
      {
            if ($this->method === $method && $this->path === $path) {
                  return true;
            }
            $parameterNames = [];
            $pattern = $this->normalisePath($this->path);

            $pattern = preg_replace_callback(
                  '#{([^}]+)}/#',
                  function (array $found) use (&$parameterNames) {
                        array_push(
                              $parameterNames,
                              rtrim($found[1], '?')
                        );
                        if (str_ends_with($found[1], '?')) {
                              return '([^/]*)(?:/?)';
                        }
                        return '([^/]+)/';
                  },
                  $pattern,
            );
            if (
                  !str_contains($pattern, '+')
                  && !str_contains($pattern, '*')
            ) {
                  return false;
            }
            preg_match_all(
                  "#{$pattern}#",
                  $this->normalisePath($path),
                  $matches
            );
            $parameterValues = [];
            if (count($matches[1]) > 0) {
                  foreach ($matches[1] as $value) {
                        array_push($parameterValues, $value);
                  }
                  $emptyValues = array_fill(
                        0,
                        count($parameterNames),
                        null
                  );
                  $parameterValues += $emptyValues;
                  $this->parameters = array_combine(
                        $parameterNames,
                        $parameterValues,
                  );
                  return true;
            }
            return false;
      }
      private function normalisePath(string $path): string
      {
            $path = trim($path, '/');
            $path = "/{$path}/";
            $path = preg_replace('/[\/]{2,}/', '/', $path);
            return $path;
      }

      public function dispatch()
      {
            return call_user_func($this->handler);
      }
      public function parameters()
      {
            return $this->parameters;
      }
      public function name($name = null)
      {
            if ($name) {
                  $this->name = $name;
                  return $this;
            }
            return $this->name;
      }
}