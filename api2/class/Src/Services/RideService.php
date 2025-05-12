<?php
namespace Src\Services;

use App;

class RideService
{
      public function deleteByRideId(int $rideId): void
      {
            App::$db->delete('rides', $rideId);
      }
      public function deleteByRouteId(int $routeId): void
      {
            App::$db->deleteFromWhere('rides', [
                  'stmt' => 'routes_id = :id',
                  'params' => [':id' => $routeId]
            ]);
      }
      public function deleteByAccountId(int $accountId): void
      {
            App::$db->deleteFromWhere('rides', [
                  'stmt' => 'accounts_id = :id',
                  'params' => [':id' => $accountId]
            ]);
      }
      public function updateRide(array $data): void
      {
            App::$db->update('rides', $data);
      }
      public function createRide(array $data): void
      {
            App::$db->add('rides', $data);
      }
}
