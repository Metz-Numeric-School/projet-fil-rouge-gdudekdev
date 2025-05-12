<?php

namespace Core\Interfaces;

interface HandlerInterface
{
      public function handle($url,$data);
}
// TODO possibilité de créer un middleware qui capte les données entrantes et les convertis en objet et les renvoie au Handler