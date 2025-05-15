<?php

namespace Src\Controller;

use Src\Controller\Auth;


class Controller
{// TODO faire une disjonction de cas , si il y a une vue, l'utiliser, sinon on est en API
      public function handle($url, $data)
      {
            Auth::getInstance()->protect();

            $table = get_called_class()::$table;
            $title = get_called_class()::$title;
            $obj = ucfirst($table);

            $model = '\Src\Model\\' . $obj;
            $model = new $model;
            extract($model->handle($url, $data));

            if (isset($url['mode'])) {
                  $model->process($url, $data);
                  header("Location: index.php?page=" . $table);
                  exit();
            }

            if (isset($url['id'])) {
                  include ROOT . '/view/' . $obj . '/' . $table . '_detail.php';
            } else if (isset($url['add'])) {
                  include ROOT . '/view/' . $obj . '/' . $table . '_create.php';
            } else {
                  include ROOT . '/view/' . $obj . '/' . $table . '.php';
            }
      }
}
