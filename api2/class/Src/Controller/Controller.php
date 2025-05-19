<?php

namespace Src\Controller;

use Src\Controller\Auth;


class Controller
{// TODO faire une disjonction de cas , si il y a une vue, l'utiliser, sinon on est en API
      protected static $url_params;
      public function handle($url, $data)
      {
            Auth::getInstance()->protect();
            $table = get_called_class()::$table;
            self::$url_params = self::getTrimmedUrl($url);

            $obj = ucfirst($table);
            $model = '\Src\Model\\' . $obj;
            $model = new $model;
            if (isset($url['mode'])) {
                  echo self::var_in_called_class('redirect_path') ? 'dad' : 'no';
                  var_dump(get_called_class()::$redirect_path);
                  $model->process($url, $data);
                  self::redirect();
                  exit();
            }
            $title = get_called_class()::$title;
            extract($model->handle($url, $data));
            if (isset($url['id'])) {
                  include ROOT . '/view/' . $obj . '/' . $table . '_detail.php';
            } else if (isset($url['add'])) {
                  include ROOT . '/view/' . $obj . '/' . $table . '_create.php';
            } else {
                  include ROOT . '/view/' . $obj . '/' . $table . '.php';
            }
      }
      public static function redirect()
      {
            if (self::var_in_called_class('redirect_path')) {
                  header("Location: " . get_called_class()::redirectPath());
                  exit();
            }
            header("Location: index.php?page=" . get_called_class()::$table);
            exit();
      }
      public static function var_in_called_class($var)
      {
            return in_array($var, array_keys(get_class_vars(get_called_class())));
      }
      protected static function getTrimmedUrl($url)
      {
            $trimmed = $url;
            $keys_to_trim = ['page'];
            foreach (array_keys($trimmed) as $key) {
                  if (in_array($key, $keys_to_trim)) {
                        unset($trimmed[$key]);
                  }
            }
            return $trimmed;
      }
}
