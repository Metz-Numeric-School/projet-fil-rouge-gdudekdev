<?php

namespace Src\Handlers\Back\Handlers;

use Core\Interfaces\HandlerInterface;
use Src\Services\EntrepriseService;

class Entreprises implements HandlerInterface
{
      private static $instance;
      private EntrepriseService $entrepriseService;
      public function __construct()
      {
            $this->entrepriseService = new EntrepriseService();
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
                  $this->handleDeleteEntreprise((int) $url['id']);
            }

            if (empty($data['entreprises_id'])) {
                  $this->handleCreateentreprise($data);
            } else {
                  $this->handleUpdateentreprise($data);
            }
      }

      private function handleDeleteEntreprise(int $entrepriseId): void
      {
            $this->entrepriseService->deleteEntreprise($entrepriseId);
            header("Location: index.php?page=entreprises");
            exit();
      }

      private function handleCreateEntreprise(array $data): void
      {
            $this->entrepriseService->createEntreprise($data);
            header("Location: index.php?page=entreprises");
            exit();
      }

      private function handleUpdateEntreprise(array $data): void
      {
            $this->entrepriseService->updateEntreprise($data);
            header("Location: index.php?page=entreprises&id=" . $data['entreprises_id']);
            exit();
      }
}
