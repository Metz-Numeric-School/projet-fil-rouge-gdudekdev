<?php

namespace Src\Mapper;

use Core\Abstract\Entity;
use Core\Interfaces\MapperInterface;
use Src\Entity\Accounts;

class AccountsMapper implements MapperInterface
{
      public function toArray(Entity $entity): array
      {
            if (!$entity instanceof Accounts) {
                  throw new \InvalidArgumentException('Expected an Accounts entity.');
            }
            return [
                  'accounts_id' => $entity->id(),
                  'accounts_fullname' => $entity->fullname(),
                  'accounts_email' => $entity->email(),
                  'accounts_birthday' => $entity->birthday(),
                  'accounts_phone' => $entity->phone(),
                  'accounts_created_at' => $entity->created_at(),
                  'accounts_password' => $entity->password(),
                  'roles_id' => $entity->roles_id(),
                  'divisions_id' => $entity->divisions_id(),
            ];
      }

      public function toEntity(array $data): Entity
      {
            return new Accounts($data);
      }
}
