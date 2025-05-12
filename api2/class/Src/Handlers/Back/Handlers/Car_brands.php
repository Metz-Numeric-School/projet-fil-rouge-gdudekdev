<?php

namespace Src\Handlers\Back\Handlers;

use Core\Interfaces\HandlerInterface;
use Src\Services\CarBrandService;

class Car_brands implements HandlerInterface
{
      private static $instance;
      private CarBrandService $carBrandService;
      public function __construct()
      {
            $this->carBrandService = new CarBrandService();
      }
      public static function instance()
      {
            if (is_null(self::$instance)) {
                  self::$instance = new self;
            }
            return self::$instance;
      }

      public function handle($url, $data)
      {
            if (isset($url['remove']) && isset($url['id'])) {
                  $this->handleDeleteCarBrand((int) $url['id']);
            }

            if (empty($data['car_brands_id'])) {
                  $this->handleCreateCarBrand($data);
            } else {
                  $this->handleUpdateCarBrand($data);
            }
      }

      private function handleDeleteCarBrand(int $carBrandId): void
      {
            $this->carBrandService->deleteCarBrand($carBrandId);
            header("Location: index.php?page=car_brands");
            exit();
      }

      private function handleCreateCarBrand(array $data): void
      {
            $this->carBrandService->createCarBrand($data);
            header("Location: index.php?page=car_brands");
            exit();
      }

      private function handleUpdateCarBrand(array $data): void
      {
            $this->carBrandService->updateCarBrand($data);
            header("Location: index.php?page=car_brands&id=" . $data['car_brands_id']);
            exit();
      }
}
