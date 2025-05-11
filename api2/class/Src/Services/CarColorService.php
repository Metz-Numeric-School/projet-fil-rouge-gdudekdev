<?php
namespace Src\Services;

use App;

class CarColorService
{
      public function deleteCarColor(int $carColorId): void
      {
            App::$db->delete('car_colors', $carColorId);
      }
      public function createCarColor(array $data): void
      {
            App::$db->add('car_colors', $data);
      }
}
