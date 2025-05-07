<?php

namespace Src\Handlers;

use Src\Controller\Auth;

class Handlers
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
            
            Auth::getInstance()->protect();
            if (isset($url['table'])) {
                  switch ($url['table']) {
                        case 'accounts':
                              Accounts::instance()->handle($url, $data);
                              break;
                        case 'accounts_preferences':
                              Accounts_Preferences::instance()->handle($url, $data);
                              break;
                        case 'entreprises':
                              Entreprises::instance()->handle($url, $data);
                              break;
                        case 'divisions':
                              Divisions::instance()->handle($url, $data);
                              break;

                  }
            }
      }
}