<?php
namespace Src\Services;

use App;

class AccountService
{
      private AccountPreferencesService $accountPreferencesService;
      private RouteService $routeService;
      private VehiculeService $vehiculeService;
      public function __construct()
      {
            $this->accountPreferencesService = new AccountPreferencesService();
            $this->vehiculeService = new VehiculeService();
            $this->routeService = new RouteService();
      }
      public function deleteAccount(int $accountId): void
      {
            $this->routeService->deleteByAccountId( $accountId);
            $this->vehiculeService->deleteByAccountId( $accountId);
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
