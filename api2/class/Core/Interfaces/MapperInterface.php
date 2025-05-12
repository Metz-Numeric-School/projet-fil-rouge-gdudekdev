<?php 

namespace Core\Interfaces;

use Core\Abstract\Entity;
interface MapperInterface{
      public function toArray(Entity $entity): array;
      public function toEntity(array $array): Entity;
}