<?php

namespace Src\Handlers\Back\Handlers;

use App;
use Core\Interfaces\Handler;
use Core\Interfaces\HandlerInterface;
use Src\Services\PreferenceService;

class Preferences implements HandlerInterface
{
      private static $instance;
      private PreferenceService $preferenceService;
      public function __construct()
      {
            $this->preferenceService = new PreferenceService();
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
                  $this->handleDeletePreference((int) $url['id']);
            }
            if (empty($data['preferences_id'])) {
                  $this->handleCreatePreference($data);
            } else {
                  $this->handleUpdatePreference($data);
            }
      }
      private function handleDeletePreference(int $preferenceId): void
      {
            $this->preferenceService->deletePreference($preferenceId);
            header("Location: index.php?page=preferences");
            exit();
      }

      private function handleCreatePreference(array $data): void
      {
            $this->preferenceService->createPreference($data);
            header("Location: index.php?page=preferences");
            exit();
      }

      private function handleUpdatePreference(array $data): void
      {
            $this->preferenceService->updatePreference($data);
            header("Location: index.php?page=preferences");
            exit();
      }

}