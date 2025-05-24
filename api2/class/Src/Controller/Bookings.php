<?php

namespace Src\Controller;

use Src\Model\Instances;


class Bookings extends Controller
{
      public static $table = 'bookings';
      public static $title = 'Page de gestion des réservations de trajet';
      public static $redirect_path;
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

            if ($url['accounts_id'] == Instances::get($url['instances_id'])['instances_driver_id']) {
                  include ROOT . '/view/' . $obj . '/' . $table . '_receiver.php';

            } else {
                  include ROOT . '/view/' . $obj . '/' . $table . '_sender.php';

            }
      }
      public static function redirectPath()
      {
            var_dump(self::$url_params);
            $accounts_id = self::$url_params['accounts_id'];
            $instances_id = self::$url_params['instances_id'];
            self::$redirect_path = "index.php?page=bookings&instances_id=" . $instances_id . "&accounts_id=" . $accounts_id;
            return self::$redirect_path;
      }
}
