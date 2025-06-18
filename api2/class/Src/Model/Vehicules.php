<?php

namespace Src\Model;


class Vehicules extends Model
{
      public static $table = 'vehicules';
      protected static function update_show()
      {
            $id = $_GET['id'] ?? 0;
            $vehicule = self::newEntity(self::get($id));
            $vehicule_brand = Car_models::get($vehicule->car_models_id())['car_brands_id'];
            $colors = Car_colors::getAll();
            $engines = Car_engines::getAll();
            $brands = Car_brands::getAll();
            $models = Car_models::getAll();
            return
                  compact(["vehicule", "brands", "vehicule_brand", "models", "colors", "engines"]);
      }
      protected static function add_show()
      {
            $id = $_GET['accounts_id'] ?? 0;
            $vehicule = self::newEntity();
            $account_id = htmlspecialchars($id);
            $colors = Car_colors::getAll();
            $engines = Car_engines::getAll();
            $brands = Car_brands::getAll();
            $models = Car_models::getAll();
            return
                  compact(["vehicule", "brands", "models", "colors", "engines", "account_id"]);

      }
      protected static function all_show()
      {
            $id = $_GET['accounts_id'] ?? 0;
            $vehicules = self::getAllWhere('accounts_id', $id);
            $account_id = htmlspecialchars($id);
            $models = [];
            $brands = [];
            $colors = [];
            $engines = [];
            foreach ($vehicules as $vehicule) {
                  $vehicule = self::newEntity($vehicule);
                  $colors[] = Car_Colors::get($vehicule->car_colors_id())['car_colors_name'];
                  $engines[] = Car_engines::get($vehicule->car_engines_id())['car_engines_name'];
                  $model = Car_models::get($vehicule->car_models_id());
                  $models[] = $model['car_models_name'];
                  $brands[] = Car_brands::get($model['car_brands_id'])['car_brands_name'];
            }
            return
                  compact(["vehicules", "models", "brands", "colors", "engines", "account_id"]);
      }
}
