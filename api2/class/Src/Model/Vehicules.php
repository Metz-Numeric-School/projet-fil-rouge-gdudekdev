<?php

namespace Src\Model;

use App;

class Vehicules extends Model
{
      public static $table = 'vehicules';
      // TODO refacto sur les models pour utiliser les methodes statiques liées a leurs models
      protected static function update_show()
      {
            $id = isset($_GET['id']) ? $_GET['id'] : 0 ; 
            $vehicule = new \Src\Entity\Vehicules(App::$db->getOneFrom('vehicules', 'vehicules_id', $id));
            $vehicule_brand = App::$db->getOneFrom('car_models', 'car_models_id', $vehicule->car_models_id())['car_brands_id'];
            $colors = App::$db->getAllFrom('car_colors');
            $engines = App::$db->getAllFrom('car_engines');
            $brands = App::$db->getAllFrom('car_brands');
            $models = App::$db->getAllFrom('car_models');
            return
                  compact(["vehicule", "brands", "vehicule_brand", "models", "colors", "engines"], ["vehicule", "brands", "vehicule_brand", "models", "colors", "engines"]);
      }
      protected static function add_show()
      {
            $id = isset($_GET['accounts_id']) ? $_GET['accounts_id'] : 0 ; 
            $vehicule = new \Src\Entity\Vehicules();
            $account_id = htmlspecialchars($id);
            $colors = App::$db->getAllFrom('car_colors');
            $engines = App::$db->getAllFrom('car_engines');
            $brands = App::$db->getAllFrom('car_brands');
            $models = App::$db->getAllFrom('car_models');
            return
                  compact(["vehicule", "brands", "models", "colors", "engines", "account_id"], ["vehicule", "brands", "models", "colors", "engines", "account_id"]);

      }
      protected static function all_show()
      {
            $id = isset($_GET['accounts_id']) ? $_GET['accounts_id'] : 0 ; 
            $vehicules = App::$db->getAllFromWhere('vehicules', ['stmt' => 'accounts_id=:accounts_id', 'params' => [':accounts_id' => $id]]);
            $account_id = htmlspecialchars($id);
            $models = [];
            $brands = [];
            $colors = [];
            $engines = [];
            foreach ($vehicules as $vehicule) {
                  $vehicule = new \Src\Entity\Vehicules($vehicule);
                  $models[] = App::$db->getOneFrom('car_models', 'car_models_id', $vehicule->car_models_id())['car_models_name'];
                  $brandId = App::$db->getOneFrom('car_models', 'car_models_id', $vehicule->car_models_id())['car_brands_id'];
                  $brands[] = App::$db->getOneFrom('car_brands', 'car_brands_id', $brandId)['car_brands_name'];
                  $colors[] = App::$db->getOneFrom('car_colors', 'car_colors_id', $vehicule->car_colors_id())['car_colors_name'];
                  $engines[] = App::$db->getOneFrom('car_engines', 'car_engines_id', $vehicule->car_engines_id())['car_engines_name'];
            }
            return
                  compact(["vehicules", "models", "brands", "colors", "engines", "account_id"], ["vehicules", "models", "brands", "colors", "engines", "account_id"]);
      }
}
