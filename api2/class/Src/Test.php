<?php

namespace Src;

class Test
{
      public static function test()
      {
            $test = [
                  'email' => 'admin',
                  'password' => 1234,
            ];
            return json_encode($test);
      }
      public static function token()
      {
            return "eyJ0eXAiOiJKV1QiLCJraWQiOiJjYXJwb29sLWtleS1pZCIsImFsZyI6IlJTMjU2In0.eyJpc3MiOiJodHRwOi8vY2FycG9vbCIsImF1ZCI6Imh0dHA6Ly9sb2NhbGhvc3Q6NTE3MyIsImlhdCI6MTc0ODYxMTg5MiwiZXhwIjoxNzQ4NjE1NDkyLCJkYXRhIjp7ImlkIjoxfX0.wAzbv8k92GslS8HcXNJs7p8-XO1BFyW0XnZ-22SOFraxz7CCUYc5-b1Ek8nA9iUgnlXQIfnREbhvnLxpKVzpVC00SAVTod0HO3jywU0EqRg1UT0UM43We-xZSt-ASSzXe9v9orRkdByDO1vh_HFw5Om9OZjKpB6Kk2ri23ZiIvw-s7fdvSl20ymmurxuSVlS5YQj25zZQD4cWwruyru_xF3CQCDP7ZL2h_ek4PC9t0PmIkigZxzlv_tp3JpQYQpZDxbh9GY8QHzUzSzPZc2_-pwlhL8FJj3iM6Td9OHOMQntfdJWqDY2bsoLopubey3T_szmV6Cxr0o-dEMM1LuYOg";
      }
}