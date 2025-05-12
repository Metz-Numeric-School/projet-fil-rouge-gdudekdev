<?php
namespace Src\Services;

use App;
use Core\Interfaces\ServiceInterface;

class CarBrandService implements ServiceInterface
{
      public CarModelService $carModelService;
      public function __construct()
      {
            $this->carModelService = new CarModelService();
      }
      public function deleteCarBrand(int $carBrandId): void
      {
            $this->carModelService->deleteByCarBrandId($carBrandId);
            App::$db->delete('car_brands', $carBrandId);
      }

      public function updateCarBrand(array $data): void
      {
            App::$db->update('car_brands', $data);
      }
      public function createCarBrand(array $data): void
      {
            App::$db->add('car_brands', $data);
      }
}
