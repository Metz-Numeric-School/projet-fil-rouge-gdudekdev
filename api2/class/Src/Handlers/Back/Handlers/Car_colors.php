<?php

namespace Src\Handlers\Back\Handlers;

use Core\Interfaces\Handler;
use Src\Services\CarColorService;

class Car_colors implements Handler
{
      private static $instance;
      private CarColorService $carColorService;
        public function __construct()
      {
            $this->car_colorService = new CarColorService();
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
                  $this->handleDeleteCarColor((int) $url['id']);
            }
                  $this->handleCreateCarColor($data);
      }

      private function handleDeleteCarColor(int $carColorId): void
      {
            $this->carColorService->deleteCarColor($carColorId);
            header("Location: index.php?page=car_colors");
            exit();
      }

      private function handleCreateCarColor(array $data): void
      {
            $this->carColorService->createCarColor($data);
            header("Location: index.php?page=car_colors");
            exit();
      }
}