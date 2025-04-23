<?php

namespace Back\Model;

use Core\Model\Database;
use Core\Model\Crud;

class ProcessModel extends Crud
{

      public function handleProcess(array $params, array $data)
      {
            if (sizeof($data) == 0) {
                  // Modification Ajout ou Suppression
                  if ($params['mode'] == "remove" && isset($params['id'])) {
                        $this->delete($params['table'],$params['id']);
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
}
