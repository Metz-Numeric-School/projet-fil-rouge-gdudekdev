<?php

namespace Src\Handlers\Back\Handlers;

use App;
use Core\Interfaces\HandlerInterface;
use Src\Services\RouteService;

class Routes implements HandlerInterface
{
      private static $instance;
      private RouteService $routeService;
      public function __construct()
      {
            $this->routeService = new RouteService();
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
                  $this->handleDeleteRoute((int) $url['id']);
            }
            if (empty($data['routes_id'])) {
                  $this->handleCreateRoute($data);
            } else {
                  $this->handleUpdateRoute($data);
            }
      }

      private function handleDeleteRoute(int $routeId): void
      {
            $accountId = App::$db->getOneFrom('routes','routes_id', $routeId)['accounts_id'];
            $this->routeService->deleteByrouteId($routeId);
            header("Location: index.php?page=routes&accounts_id=" . $accountId);
            exit();
      }

      private function handleCreateRoute(array $data): void
      {
            
            $this->routeService->createroute($data);
            header("Location: index.php?page=routes&accounts_id=" . $data['accounts_id']);
            exit();
      }
      private function handleUpdateRoute(array $data): void
      {
            $this->routeService->updateRoute($data);
            header("Location: index.php?page=routes&accounts_id=" . $data['accounts_id']);
            exit();
      }
}