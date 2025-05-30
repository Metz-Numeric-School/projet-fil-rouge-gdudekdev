<?php

namespace Src;

class Test
{
      public static function test()
      {
            $test = [
                  'email' => 'admin',
                  'password'=>1234,      
            ];
            return json_encode($test);
      }
}