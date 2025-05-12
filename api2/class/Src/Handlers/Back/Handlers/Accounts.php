<?php 
namespace Src\Handlers\Back\Handlers;

use Core\Interfaces\Handler;
use Src\Services\AccountService;
use Src\Services\AccountPreferencesService;

class Accounts implements Handler
{
    private static $instance;
    private AccountService $accountService;
    private AccountPreferencesService $accountPreferencesService;

    public function __construct()
    {
        $this->accountService = new AccountService();
        $this->accountPreferencesService = new AccountPreferencesService();
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
            $this->handleDeleteAccount((int) $url['id']);
        } 

        if (empty($data['accounts_id'])) {
            $this->handleCreateAccount($data);
        } else {
            $this->handleUpdateAccount($data);
        }
    }

    private function handleDeleteAccount(int $accountId): void
    {
        $this->accountService->deleteAccount($accountId);
        header("Location: index.php?page=accounts");
        exit();
    }

    private function handleCreateAccount(array $data): void
    {
        $this->accountService->createAccount($data);
        header("Location: index.php?page=accounts");
        exit();
    }

    private function handleUpdateAccount(array $data): void
    {
        var_dump($data);
        $account_data = $this->extractAccountData($data);
        $preference_data = [];
        if(isset($data['preferences'])){
              $preference_data = $this->extractPreferencesData($data, $account_data['accounts_id']);
        }
        $this->accountService->updateAccount($account_data);
        $this->accountPreferencesService->updateAccountPreferences($preference_data,$account_data['accounts_id']);

        header("Location: index.php?page=accounts&id=" . $account_data['accounts_id']);
        exit();
    }

    private function extractAccountData(array $data): array
    {
        $account_data = [];
        foreach ($data as $key => $value) {
            if (str_contains($key, 'accounts') || in_array($key, ['roles_id', 'divisions_id'])) {
                $account_data[$key] = $value;
            }
        }
        return $account_data;
    }

    private function extractPreferencesData(array $data, int $accountId): array
    {

        $preference_data = [];
        foreach($data['preferences'] as $pref){
            $preference_data[] = ['accounts_id'=>$accountId,'preferences_id'=>$pref];
        }
    
        return $preference_data;
    }
}