<?php
namespace Src\Services;

use App;
use Core\Interfaces\ServiceInterface;

class CarModelService implements ServiceInterface
{
      public function deleteByCarModelId(int $carModelId): void
      {
            App::$db->deleteFromWhere('car_models', [
                  'stmt' => 'car_models_id = :id',
                  'params' => [':id' => $carModelId]
            ]);
      }

      public function deleteByCarBrandId(int $carBrandId): void
      {
            App::$db->deleteFromWhere('car_models', [
                  'stmt' => 'car_brands_id = :id',
                  'params' => [':id' => $carBrandId]
            ]);
      }

      public function createCarModel(array $data): void
      {
            App::$db->add('car_models', $data);
      }
}
