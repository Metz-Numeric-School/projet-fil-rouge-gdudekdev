<?php

namespace Src\Handlers;

use Src\Controller\Auth;

class Handlers extends \Core\Model\Handlers
{
      private static $instance;

      public static function instance()
      {
            if (is_null(self::$instance)) {
                  self::$instance = new self;
            }
            return self::$instance;
      }
      public function handle($url, $data)
      {
            var_dump($url,$data);
            Auth::getInstance()->protect();
            if (isset($url['table'])) {
                  switch ($url['table']) {
                        case 'accounts':
                              Accounts::instance()->handle($url, $data);
                              break;
                        case 'accounts_preferences':
                              Accounts_Preferences::instance()->handle($url, $data);
                              break;
                  }
            }
      }
}