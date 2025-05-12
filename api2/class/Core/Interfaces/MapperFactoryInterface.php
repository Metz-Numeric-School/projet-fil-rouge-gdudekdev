<?php 

namespace Core\Interfaces;

interface MapperFactoryInterface
{
    public function createMapper(string $entityType): MapperInterface;
}