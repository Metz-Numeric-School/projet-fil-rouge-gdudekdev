<?php

namespace Src\Factory;

use Core\Interfaces\HandlerInterface;
use Src\Controller\Auth;

class HandlersFactory
{
     
      public static function createHandler($table) : ?HandlerInterface
      {
            Auth::getInstance()->protect();
            return match($table){
                  'accounts'=>\Src\Handlers\Back\Handlers\Accounts::instance(),
                  'entreprises'=>\Src\Handlers\Back\Handlers\Entreprises::instance(),
                  'divisions'=>\Src\Handlers\Back\Handlers\Divisions::instance(),
                  'preferences'=>\Src\Handlers\Back\Handlers\Preferences::instance(),
                  'vehicules'=>\Src\Handlers\Back\Handlers\Vehicules::instance(),
                  'car_brands'=>\Src\Handlers\Back\Handlers\Car_brands::instance(),
                  'car_models'=>\Src\Handlers\Back\Handlers\Car_models::instance(),
                  'car_colors'=>\Src\Handlers\Back\Handlers\Car_colors::instance(),
                  'car_engines'=>\Src\Handlers\Back\Handlers\Car_engines::instance(),
                  'routes'=>\Src\Handlers\Back\Handlers\Routes::instance(),
                  'rides'=>\Src\Handlers\Back\Handlers\Rides::instance(),
                  default => null
            };
      }
}