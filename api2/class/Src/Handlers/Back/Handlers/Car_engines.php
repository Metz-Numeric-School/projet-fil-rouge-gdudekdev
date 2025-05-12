<?php

namespace Src\Handlers\Back\Handlers;

use Core\Interfaces\HandlerInterface;
use Src\Services\CarEngineService;

class Car_engines implements HandlerInterface
{
      private static $instance;
      private CarEngineService $carengineService;
        public function __construct()
      {
            $this->car_engineService = new CarEngineService();
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
                  $this->handleDeleteCarEngine((int) $url['id']);
            }
                  $this->handleCreateCarEngine($data);
      }

      private function handleDeleteCarEngine(int $carengineId): void
      {
            $this->carengineService->deleteCarEngine($carengineId);
            header("Location: index.php?page=car_engines");
            exit();
      }

      private function handleCreateCarEngine(array $data): void
      {
            $this->carengineService->createCarEngine($data);
            header("Location: index.php?page=car_engines");
            exit();
      }
}