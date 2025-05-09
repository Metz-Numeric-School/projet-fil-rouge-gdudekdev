<?php

namespace Src\Back\Vehicules\Model;

use App;

class Vehicules
{
      public function handle($url)
      {
            if (isset($url['add'])) {
                  $recordset = $this->add_show($url['accounts_id']);
            } else if (isset($url['id'])) {
                  $recordset = $this->update_show($url['id']);
            } else {
                  $recordset = $this->all_show($url['accounts_id']);
            }
            return $recordset;
      }
      private function update_show($id)
      {
            $vehicule = new \Src\Entity\Vehicules(App::$db->getOneFrom('vehicules', 'vehicules_id', $id));
            $vehicule_brand = App::$db->getOneFrom('car_models', 'car_models_id', $vehicule->car_models_id())['car_brands_id'];
            $colors = App::$db->getAllFrom('car_colors');
            $engines = App::$db->getAllFrom('car_engines');
            $brands = App::$db->getAllFrom('car_brands');
            $models = App::$db->getAllFrom('car_models');
            return
                  compact(["vehicule", "brands", "vehicule_brand", "models", "colors", "engines"], ["vehicule", "brands", "vehicule_brand", "models", "colors", "engines"]);
      }
      private function add_show($id)
      {
            $vehicule = new \Src\Entity\Vehicules();
            $account_id = htmlspecialchars($id);
            $colors = App::$db->getAllFrom('car_colors');
            $engines = App::$db->getAllFrom('car_engines');
            $brands = App::$db->getAllFrom('car_brands');
            $models = App::$db->getAllFrom('car_models');
            return
                  compact(["vehicule", "brands", "models", "colors", "engines", "account_id"], ["vehicule", "brands", "models", "colors", "engines", "account_id"]);

      }
      private function all_show($id)
      {
            $vehicules = App::$db->getAllFromWhere('vehicules', ['stmt' => 'accounts_id=:accounts_id', 'params' => [':accounts_id' => $id]]);
            $account_id = htmlspecialchars($id);
            return
                  compact(["vehicules", "account_id"], ["vehicules", "account_id"]);
      }
}
