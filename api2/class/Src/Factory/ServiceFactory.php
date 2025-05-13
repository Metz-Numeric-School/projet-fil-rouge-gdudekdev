<?php

namespace Src\Factory;

use Core\Interfaces\ServiceInterface;
use Src\Controller\Auth;

class ServiceFactory
{
     
      public static function createService($table) : ?ServiceInterface
      {
            Auth::getInstance()->protect();
            return match($table){
                  'accounts'=>new \Src\Services\AccountService(),
                  'accounts_preferences'=>new \Src\Services\AccountPreferencesService(),
                  'entreprises'=>new \Src\Services\EntrepriseService(),
                  'divisions'=>new \Src\Services\DivisionService(),
                  'preferences'=>new \Src\Services\PreferenceService(),
                  'vehicules'=>new \Src\Services\VehiculeService(),
                  'car_brands'=>new \Src\Services\CarBrandService(),
                  'car_models'=>new \Src\Services\CarModelService(),
                  'car_colors'=>new \Src\Services\CarColorService(),
                  'car_engines'=>new \Src\Services\CarEngineService(),
                  'routes'=>new \Src\Services\RouteService(),
                  'rides'=>new \Src\Services\RideService(),
                  default => null
            };
      }
}