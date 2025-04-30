<?php
namespace Core\Model;

use Core\Model\Database;

class Crud
{
      protected function save(string $table, array $data)
      {     if(isset($data[$table . '_id'])){

      }
            if ($data[$table .'_id'] == 0) {
                  $this->update($table, $data);
            } else {
                  $this->add($table, $data);
            }
      }
      
      protected function update($table, $data)
      {
            Database::getInstance()->update($table, $data);
      }

      protected function add($table, $data)
      {
            Database::getInstance()->add($table, $data);
      }
      protected function delete($table, $id)
      {
            Database::getInstance()->delete($table, $id);
      }
      public static function defaultValue(string $type,$table=null)
      {
            date_default_timezone_set('Europe/Paris');
            $type = strtolower($type);

            if (strpos($type, 'int') !== false) {
                  return 0;
            }

            if (strpos($type, 'varchar') !== false || strpos($type, 'text') !== false) {
                  return '';
            }

            if ($type === 'date') {
                  return date('Y-m-d');
            }

            if ($type === 'datetime' || $type === 'timestamp') {
                  return date('Y-m-d H:i:s');
            }
            
            if($type ==='json' ){
                  if($table){
                        switch($table){
                              case 'plannings':
                                    return json_encode(DEFAULT_PLANNING);
                        }
                  }
                  return null;
            }

            return '';
      }
      
}
