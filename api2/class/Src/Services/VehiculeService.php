<?php
namespace Src\Services;

use App;

class VehiculeService
{
     public function deleteByVehiculeId(int $vehiculeId): void
      {
            App::$db->deleteFromWhere('vehicules', [
                  'stmt' => 'vehicules_id = :id',
                  'params' => [':id' => $vehiculeId]
            ]);
      }
      public function deleteByAccountId(int $accountId): void
      {
            App::$db->deleteFromWhere('vehicules', [
                  'stmt' => 'accounts_id = :id',
                  'params' => [':id' => $accountId]
            ]);
      }
      public function updateVehicule(array $data): void
      {
            App::$db->update('vehicules', $data);
      }
      public function createVehicule(array $data): void
      {
            App::$db->add('vehicules', $data);
      }
}
