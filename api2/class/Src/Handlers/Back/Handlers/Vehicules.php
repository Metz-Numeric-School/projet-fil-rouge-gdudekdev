<?php

namespace Src\Handlers\Back\Handlers;

use App;
use Core\Interfaces\Handler;
use Src\Services\VehiculeService;

class Vehicules implements Handler
{
      private static $instance;
      private VehiculeService $vehiculeService;
      public function __construct()
      {
            $this->vehiculeService = new VehiculeService();
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
                  $this->handleDeleteVehicule((int) $url['id']);
            }
            if (empty($data['vehicules_id'])) {
                  $this->handleCreateVehicule($data);
            } else {
                  $this->handleUpdateVehicule($data);
            }
      }

      private function handleDeleteVehicule(int $vehiculeId): void
      {
            $accountId = App::$db->getOneFrom('vehicules','vehicules_id', $vehiculeId)['accounts_id'];
            $this->vehiculeService->deleteByVehiculeId($vehiculeId);
            header("Location: index.php?page=vehicules&accounts_id=" . $accountId);
            exit();
      }

      private function handleCreateVehicule(array $data): void
      {
            
            $this->vehiculeService->createVehicule($data);
            header("Location: index.php?page=vehicules&accounts_id=" . $data['accounts_id']);
            exit();
      }
      private function handleUpdateVehicule(array $data): void
      {
            $this->vehiculeService->updateVehicule($data);
            header("Location: index.php?page=vehicules&accounts_id=" . $data['accounts_id']);
            exit();
      }
}