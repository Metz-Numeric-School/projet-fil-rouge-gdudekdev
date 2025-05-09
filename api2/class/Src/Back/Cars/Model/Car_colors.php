<?php

namespace Src\Back\Cars\Model;

use App;

class Car_colors
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
                        "colors" => App::$db->getAllFrom("car_colors"),
                  ];
      }
}
