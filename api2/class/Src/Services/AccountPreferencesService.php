<?php
namespace Src\Services;

use App;

class AccountPreferencesService
{
      public function deleteByAccountId(int $accountId): void
      {
            App::$db->deleteFromWhere('accounts_preferences', [
                  'stmt' => 'accounts_id = :id',
                  'params' => [':id' => $accountId]
            ]);
      }

      public function deleteByPreferenceId(int $preferenceId): void
      {
            App::$db->deleteFromWhere('accounts_preferences', [
                  'stmt' => 'preferences_id = :id',
                  'params' => [':id' => $preferenceId]
            ]);
      }
      public function updateAccountPreferences(array $data): void
      {
            !empty($data) ? $accountId = $data[0]['accounts_id'] : exit();
            $this->deleteByAccountId($accountId);
            $this->createAccountPreferences($data);
      }
      public function createAccountPreferences(array $data): void
      {
            foreach ($data as $accountPreference) {
                  App::$db->add('accounts_preferences', $accountPreference);
            }
      }
}
