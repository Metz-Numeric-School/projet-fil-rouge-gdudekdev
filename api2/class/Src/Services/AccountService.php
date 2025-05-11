<?php
namespace Src\Services;

use App;

class AccountService
{
      private AccountPreferencesService $accountPreferencesService;
      // private RouteService $routeService;
      // private VehicleService $vehicleService;
      public function __construct()
      {
            $this->accountPreferencesService = new AccountPreferencesService();
      }
      public function deleteAccount(int $accountId): void
      {
            // App::$db->deleteFromWhere('routes', ['stmt' => 'accounts_id =:id', 'params' => [':id' => $accountId]]);
            // App::$db->deleteFromWhere('vehicules', ['stmt' => 'accounts_id =:id', 'params' => [':id' => $accountId]]);
            $this->accountPreferencesService->deleteByAccountId( $accountId);
            App::$db->delete('accounts', $accountId);
      }

      public function createAccount(array $data): void
      {
            $data['accounts_created_at'] = date("Y-m-d h:i:s");
            App::$db->add('accounts', $data);
      }

      public function updateAccount(array $data): void
      {
            App::$db->update('accounts', $data);
      }
}
