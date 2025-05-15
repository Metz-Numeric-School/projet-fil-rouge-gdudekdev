<?php

namespace Src\Back\Cars\Model;

use App;

class Car_engines
{
      public function handle($url)
      {

            $recordset = $this->all_show();
            return $recordset;
      }
      private function all_show()
      {
            return
                  [
                        "engines" => App::$db->getAllFrom("car_engines"),
                  ];
      }
}
