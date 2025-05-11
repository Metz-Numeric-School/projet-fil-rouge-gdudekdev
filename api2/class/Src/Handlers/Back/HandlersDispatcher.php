<?php
namespace Src\Handlers\Back;

class HandlersDispatcher
{
      public static function dispatch(array $url, array $data)
      {
            if (!isset($url['table'])) {
                  header("Location: index.php?page=home");
                  exit();
            }
            $controller = HandlersFactory::createHandler($url['table']);
            if (is_null($controller)) {
                  header("Location: index.php?page=home");
                  exit();
            }
            $controller->handle($url, $data);
      }
}