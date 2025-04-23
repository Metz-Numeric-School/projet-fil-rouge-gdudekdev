<?php

namespace Model;

use Core\Class\Database;

class ProcessModel
{

      public function handleProcess(array $params, array $data)
      {
            if (sizeof($data) == 0) {
                  // Modification Ajout ou Suppression
                  if ($params['mode'] == "remove" && isset($params['id'])) {
                        Database::getInstance()->delete($params['table'], $params['id']);
                        header("Location: index.php?page=crud&table=" . $params['table']);
                        exit();
                  }
                  if ($_GET['mode'] == "save") {
                        if (isset($_GET['id'])) {
                              $recordset = Database::getInstance()->getOneFrom($params['table'], $params['table'] . '_id', $params['id']);
                        } else {
                              $formFields = Database::getInstance()->getFields($params['table']);
                              $recordset = [];
                              foreach ($formFields as $field) {
                                    $recordset[$field['COLUMN_NAME']] = $this->defaultValue($field['COLUMN_TYPE']);
                              }
                        }
                        return $recordset;
                  }
            } else {
                  // Traitement du Formulaire
                        echo 'traitement';
                        date_default_timezone_set('Europe/Paris');
                        foreach ($data as $k => $v) {
                              // permet, dans le cas où on veut passer une valeur null à notre champ, de bien renvoyer cette donnée et non une chaine vide
                              if (str_contains($k, '_at')) {
                                    $data[$k] = date('Y-m-d h:m:s');
                              } else {
                                    $data[$k] = $v;
                              }
                        }
                        $this->save($params['table'], $data);
                        header("Location: index.php?page=crud&table=" . $params['table']);
                        exit();
            }
      }
      private function save(string $table, array $data)
      {
            if (isset($data[$table . '_id'])) {
                  $this->update($table, $data);
            } else {
                  $this->add($table, $data);
            }
      }

      private function update($table, $data)
      {
            Database::getInstance()->update($table, $data);
      }

      private function add($table, $data)
      {
            Database::getInstance()->add($table, $data);
      }
      private function defaultValue(string $type)
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

            return '';
      }
}
