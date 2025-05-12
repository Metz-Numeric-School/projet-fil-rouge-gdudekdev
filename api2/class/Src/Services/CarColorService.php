<?php
namespace Src\Services;

use App;
use Core\Interfaces\ServiceInterface;

class CarColorService implements ServiceInterface
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
