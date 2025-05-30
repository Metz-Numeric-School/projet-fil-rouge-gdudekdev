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
            return "eyJ0eXAiOiJKV1QiLCJraWQiOiJjYXJwb29sLWtleS1pZCIsImFsZyI6IlJTMjU2In0.eyJpc3MiOiJodHRwOi8vY2FycG9vbCIsImF1ZCI6Imh0dHA6Ly9sb2NhbGhvc3Q6NTE3MyIsImlhdCI6MTc0ODYwODI3OSwiZXhwIjoxNzQ4NjExODc5LCJkYXRhIjp7ImlkIjoxfX0.tuVuGl2fr_9ahX5_3ck4zjhjWeWcY7FB4vnu1lqSIp7L1F1k0rH4utaak-GT-xEpIHKdQALSli9dmz6LeKVLif_VSYR2qlvGKUtr0Y4ORQYP3m0t-rBNIlOZcvqeYJ21HYyjafXLMQUg1GUv-SpSQRN2tEm6uiMJ0ZVWG6jNWobPp5NyTXF41B6SO55dW_HQglcINEbYeO4apIPKXNeVufYGR0pF5XdnWglyCaAA6owLBTahWqKJjRAbPqE-wvG25B3aqa-7yL7mSiXEeBNxnVxbcFQ7Wn9DpiLiHZLecwW6KLjbM6yiarBxPe_MBDgSYgh6VWb3HhV-ZsXRzwC8FQ";
      }
}