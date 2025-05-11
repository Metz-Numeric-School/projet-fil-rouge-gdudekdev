<?php
namespace Src\Services;

use App;

class CarEngineService
{
      public function deleteCarEngine(int $carEngineId): void
      {
            App::$db->delete('car_engines', $carEngineId);
      }
      public function createCarEngine(array $data): void
      {
            App::$db->add('car_engines', $data);
      }
}