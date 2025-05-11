<?php

namespace Src\Handlers\Back\Handlers;

use Core\Interfaces\Handler;
use Src\Services\DivisionService;

class Divisions implements Handler
{
      private static $instance;
      private DivisionService $divisionService;
        public function __construct()
      {
            $this->divisionService = new DivisionService();
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
                  $this->handleDeleteDivision((int) $url['id']);
            }
                  $this->handleCreateDivision($data);
      }

      private function handleDeleteDivision(int $divisionId): void
      {
            $this->divisionService->deleteByDivisionId($divisionId);
            header("Location: index.php?page=divisions");
            exit();
      }

      private function handleCreateDivision(array $data): void
      {
            $this->divisionService->createDivision($data);
            header("Location: index.php?page=divisions");
            exit();
      }
}