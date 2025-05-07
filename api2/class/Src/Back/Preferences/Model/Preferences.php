<?php

namespace Src\Back\Preferences\Model;

use App;

class Preferences
{
      public function handle($url)
      {
            // Display accounts interfaces     
            if (isset($url['id'])) {
                  // Updating
                  $recordset = $this->update_show($url['id']);
            } else if (isset($url['add'])) {
                  // Creating
                  $recordset = $this->add_show();
            } else {
                  // Display all
                  $recordset = $this->all_show();
            }
            return $recordset;
      }
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
