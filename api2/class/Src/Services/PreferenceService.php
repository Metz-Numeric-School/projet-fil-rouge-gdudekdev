<?php
namespace Src\Services;

use App;
use Core\Interfaces\ServiceInterface;

class PreferenceService implements ServiceInterface
{
      public AccountPreferencesService $accountPreferencesService;
      public function __construct()
      {
            $this->accountPreferencesService = new AccountPreferencesService();
      }
      public function deletePreference(int $preferenceId): void
      {
            $this->accountPreferencesService->deleteByPreferenceId($preferenceId);
            App::$db->delete('preferences', $preferenceId);
      }
      public function createPreference(array $data): void
      {
            App::$db->add('preferences', $data);
      }
      public function updatePreference(array $data): void
      {
            App::$db->update('preferences', $data);
      }

}
