<?php

namespace Src\Model;

use App;

class Preferences extends Model
{
      public static $table = 'preferences';
      // Dependencies order matterstatic 
      public static $dependencies = ['accounts_preferences'];
     
      private function update_show($id)
      {
            $preference = new \Src\Entity\Preferences(App::$db->getOneFrom('preferences', 'preferences_id', $id));
            $preferences = App::$db->getAllFrom('preferences');
            return
                  compact([ "preferences","preference"], [ "preferences","preference"]);
      }
      private function add_show()
      {
            $preference = new \Src\Entity\Preferences();
            return
                  compact(["preference"], ["preference"]);
            
      }
      private function all_show()
      {
            return
                  [
                        "preferences" => App::$db->getAllFrom("preferences"),
                  ];
      }
}
