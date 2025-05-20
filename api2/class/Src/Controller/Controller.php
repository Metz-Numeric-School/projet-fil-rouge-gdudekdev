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
                  $response = $model->process($url, $data);

                  if ($response === true) {
                        self::redirect();
                        exit();
                  } else {
                        extract($response);
                  }
            } else {
                  extract($model->handle($url, $data));
            }

            $title = get_called_class()::$title;

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
