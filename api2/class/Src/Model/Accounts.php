<?php

namespace Src\Model;

use App;
class Accounts extends Model
{
      public static $table = 'accounts';
      // Dependencies order matterstatic 
      public static $dependencies = ['accounts_preferences', 'routes', 'vehicules'];
      public static function custom_update(array $data): void
      {
            App::$db->deleteFromWhere('accounts_preferences', ['stmt' => 'accounts_id=:id', 'params' => [':id' => $data['accounts_id']]]);
            if (isset($data['preferences'])) {
                  $preferences = $data['preferences'];
                  foreach ($preferences as $preference) {
                        App::$db->add('accounts_preferences', ['accounts_id' => $data['accounts_id'], 'preferences_id' => $preference]);
                  }
                  unset($data['preferences']);
            }
            App::$db->update(self::$table, $data);
      }
      protected static function update_show($id)
      {
            $account = self::newEntity(self::get($id));
            $roles = Roles::getAll();
            $entreprises = Entreprises::getAll();
            $division_entreprises = Divisions::get($account->divisions_id());
            if (!$division_entreprises) {
                  $division_entreprises = Divisions::getAll()[0];
            }
            $divisions = Divisions::getAll();
            $preferences = Preferences::getAll();
            $account_preferences = array_column(Accounts_preferences::getAllWhere('accounts_id', $account->id()), 'preferences_id');
            return
                  compact(["account", "roles", "entreprises", "divisions", "division_entreprises", "preferences", "account_preferences"]);
      }
      protected static function add_show(): array
      {
            $account = Accounts::newEntity();
            $roles = Roles::getAll();
            $entreprises = Entreprises::getAll();
            $divisions = Divisions::getAll();
            return
                  compact(["account", "roles", "entreprises", "divisions"]);

      }
      protected static function all_show(): array
      {
            return
                  [
                        "accounts" => self::getAll(),
                  ];
      }
}
