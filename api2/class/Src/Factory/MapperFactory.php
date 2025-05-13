<?php
namespace Src\Factory;

use Core\Interfaces\MapperFactoryInterface;
use Src\Mapper\AccountsMapper;
use Core\Interfaces\MapperInterface;

class MapperFactory implements MapperFactoryInterface
{
      public function createMapper(string $entityType): MapperInterface
      {
          return match ($entityType) {
              'accounts' => new AccountsMapper(),
              default => throw new \InvalidArgumentException("Mapper not found for entity type: {$entityType}"),
          };
      }
}
