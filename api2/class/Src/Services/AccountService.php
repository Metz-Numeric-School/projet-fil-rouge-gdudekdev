<?php
namespace Src\Services;

use App;
use Core\Abstract\Entity;
use Core\Interfaces\ServiceInterface;
use Src\Entity\Accounts;
use Src\Factory\MapperFactory;
use Src\Factory\ServiceFactory;

class AccountService implements ServiceInterface
{
      private MapperFactory $mapperFactory;
      private ServiceFactory $serviceFactory;

      public function __construct()
      {
            $this->mapperFactory = new MapperFactory();
            $this->serviceFactory = new ServiceFactory();
      }
      public function deleteAccount(int $accountId): void
      {
            $routeService = $this->serviceFactory->createService('routes');
            $vehiculeService = $this->serviceFactory->createService('accounts_preferences');
            $accountPreferenceService = $this->serviceFactory->createService('vehicules');

            $routeService->deleteByAccountId($accountId);
            $vehiculeService->deleteByAccountId($accountId);
            $accountPreferenceService->deleteByAccountId($accountId);
            App::$db->delete('accounts', $accountId);
      }

      public function createAccount(Entity $entity): void
      {
            if (!$entity instanceof Accounts) {
                  throw new \InvalidArgumentException('Expected an Accounts entity.');
            }
            $mapper = $this->mapperFactory->createMapper('accounts');
            App::$db->add('accounts', $mapper->toArray($entity));
      }

      public function updateAccount(Entity $entity): void
      {
            if (!$entity instanceof Accounts) {
                  throw new \InvalidArgumentException('Expected an Accounts entity.');
            }
            $mapper = $this->mapperFactory->createMapper('accounts');
           App::$db->update('accounts', $mapper->toArray($entity));
      }
}
