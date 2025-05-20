<?php
namespace Src\Model;

use App;
abstract class Model
{
      public function handle($url, $data)
      {
            if (isset($url['id'])) {
                  $recordset = get_called_class()::update_show($url['id']);
            } else if (isset($url['add'])) {
                  $recordset = get_called_class()::add_show();
            } else {
                  $recordset = get_called_class()::all_show();
            }
            return $recordset;
      }
      public static function delete($id, $bound = null)
      {
            if (self::has_dependencies()) {
                  self::delete_dependencies($id);
            }
            if ($bound) {
                  App::$db->deleteFromWhere(get_called_class()::$table, $bound);
            } else {

                  App::$db->delete(get_called_class()::$table, $id);
            }
            return true;
      }
      public static function create(array $data)
      {
            App::$db->add(get_called_class()::$table, $data);
            return true;
      }
      public static function update(array $data)
      {
            if (self::own_method(get_called_class(), 'custom_' . __FUNCTION__)) {
                  $method_name = 'custom_' . __FUNCTION__;
                  get_called_class()::$method_name($data);
            } else {
                  App::$db->update(get_called_class()::$table, $data);
            }
            return true;
      }
      public static function process($url, $data)
      {
            return match ($url['mode']) {
                  'up' => !empty($data) ? self::update($data) : get_called_class()::all_show(),
                  'add' => !empty($data) ? self::create($data) : get_called_class()::add_show(),
                  'remove' => isset($url['id']) ? self::delete($url['id']) : get_called_class()::all_show(),
            };
      }

      private static function own_method($class_name, $method_name)
      {
            if (method_exists($class_name, $method_name)) {
                  $parent_class = get_parent_class($class_name);
                  if ($parent_class !== false)
                        return in_array($method_name, get_class_methods(get_called_class()));
            } else
                  return false;
      }
      private static function has_dependencies()
      {
            return in_array('dependencies', array_keys(get_class_vars(get_called_class())));
      }
      public static function delete_dependencies($id)
      {
            foreach (get_called_class()::$dependencies as $dependecy) {
                  App::$db->deleteFromWhere($dependecy, ['stmt' => get_called_class()::$table . '_id=:id', 'params' => [':id' => $id]]);
            }
            App::$db->delete(get_called_class()::$table, $id);
      }
      public static function get($id, $field = null)
      {
            $field = $field ?? get_called_class()::$table . '_id';
            return App::$db->getOneFrom(get_called_class()::$table, $field, $id);
      }
      public static function getAll($field = null)
      {
            return App::$db->getAllFrom(get_called_class()::$table);
      }
      public static function getAllWhere($closure, $value)
      {
            return App::$db->getAllFromWhere(get_called_class()::$table, ['stmt' => $closure . '=:id', 'params' => [':id' => $value]]);
      }
}