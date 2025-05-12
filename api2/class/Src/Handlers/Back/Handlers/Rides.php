<?php

namespace Src\Handlers\Back\Handlers;

use App;
use Core\Interfaces\Handler;
use Src\Services\RideService;

class Rides implements Handler
{
      private static $instance;
      private RideService $rideService;
      public function __construct()
      {
            $this->rideService = new RideService();
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
            var_dump($url,$data);

            if (isset($url['remove']) && isset($url['id'])) {
                  $this->handleDeleteRide((int) $url['id']);
            }
            if (empty($data['rides_id'])) {
                  $this->handleCreateRide($data);
            } else {
                  $this->handleUpdateRide($data);
            }
      }
       private function handleDeleteRide(int $rideId): void
      {
            $routeId = App::$db->getOneFrom('rides','rides_id', $rideId)['routes_id'];
            $accountId = App::$db->getOneFrom('routes','routes_id', $routeId)['accounts_id'];
            $this->rideService->deleteByRideId($rideId);
            header("Location: index.php?page=rides&accounts_id=" . $accountId);
            exit();
      }

      private function handleCreateRide(array $data): void
      {
            $accountId = App::$db->getOneFrom('vehicules','vehicules_id', $data['vehicules_id'])['accounts_id'];
            $this->rideService->createRide($data);
            header("Location: index.php?page=rides&accounts_id=" . $accountId);
            exit();
      }
      private function handleUpdateRide(array $data): void
      {
            $accountId = App::$db->getOneFrom('vehicules','vehicules_id', $data['vehicules_id'])['accounts_id'];
            $this->rideService->updateRide($data);
            header("Location: index.php?page=rides&accounts_id=" . $accountId);
            exit();
      }
}