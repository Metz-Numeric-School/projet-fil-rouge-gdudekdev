<?php
namespace Src\Services;

use App;

class RouteService
{
      public RideService $rideService;
      public function __construct()
      {
            $this->rideService = new RideService();
      }
      public function deleteByRouteId(int $routeId): void
      {
            $this->rideService->deleteByRouteId($routeId);
            App::$db->deleteFromWhere('routes', [
                  'stmt' => 'routes_id = :id',
                  'params' => [':id' => $routeId]
            ]);
      }
      public function deleteByAccountId(int $accountId): void
      {
            $routes = App::$db->getAllFromWhere('routes',['stmt'=>'accounts_id = :id','params'=>[':id'=>$accountId]]);
            foreach($routes as $route){
                  $this->rideService->deleteByRouteId($route['routes_id']);
            }
            App::$db->deleteFromWhere('routes', [
                  'stmt' => 'accounts_id = :id',
                  'params' => [':id' => $accountId]
            ]);
      }
      public function updateRoute(array $data): void
      {
            App::$db->update('routes', $data);
      }
      public function createRoute(array $data): void
      {
            App::$db->add('routes', $data);
      }
}
