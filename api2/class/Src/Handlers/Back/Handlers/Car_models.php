<?php

namespace Src\Handlers\Back\Handlers;

use Core\Interfaces\Handler;
use Src\Services\CarModelService;

class Car_models implements Handler
{
      private static $instance;
      private CarModelService $carModelService;
      public function __construct()
      {
            $this->carModelService = new CarModelService();
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
                  $this->handleDeleteCarModel((int) $url['id']);
            }

            if (empty($data['car_models_id'])) {
                  $this->handleCreateCarModel($data);
            } 
      }

      private function handleDeleteCarModel(int $carModelId): void
      {
            $this->carModelService->deleteByCarModelId($carModelId);
            header("Location: index.php?page=car_models");
            exit();
      }

      private function handleCreatecarModel(array $data): void
      {
            $this->carModelService->createCarModel($data);
            header("Location: index.php?page=car_models");
            exit();
      }
}
