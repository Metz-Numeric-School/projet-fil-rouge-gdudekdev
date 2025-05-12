<?php
namespace Src\Handlers\Back\Handlers;

use Core\Interfaces\HandlerInterface;
use Src\Factory\MapperFactory;
use Src\Factory\ServiceFactory;

class Accounts implements HandlerInterface
{
    private static $instance;
    private MapperFactory $mapperFactory;
    private ServiceFactory $serviceFactory;

    public function __construct()
    {
        $this->mapperFactory = new MapperFactory();
        $this->serviceFactory = new ServiceFactory();
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
        $service = $this->serviceFactory->createService('accounts');
        $service->deleteAccount($accountId);
        header("Location: index.php?page=accounts");
        exit();
    }

    private function handleCreateAccount(array $data): void
    {
        $service = $this->serviceFactory->createService('accounts');
        $mapper = $this->mapperFactory->createMapper('accounts');

        $service->createAccount($mapper->toEntity($data));
        header("Location: index.php?page=accounts");
        exit();
    }

    private function handleUpdateAccount(array $data): void
    {
        $account_data = $this->extractAccountData($data);
        $preference_data = [];
        if (isset($data['preferences'])) {
            $preference_data = $this->extractPreferencesData($data, $account_data['accounts_id']);
        }

        $accountService = $this->serviceFactory->createService('accounts');
        $accountPreferenceService = $this->serviceFactory->createService('accounts_preferences');

        $accountMapper = $this->mapperFactory->createMapper('accounts');

        $accountService->updateAccount($accountMapper->toEntity($account_data));
        $accountPreferenceService->updateAccountPreferences($preference_data, $account_data['accounts_id']);

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
        foreach ($data['preferences'] as $pref) {
            $preference_data[] = ['accounts_id' => $accountId, 'preferences_id' => $pref];
        }

        return $preference_data;
    }
}