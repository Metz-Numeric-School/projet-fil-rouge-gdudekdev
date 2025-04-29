<?php

namespace Back\Model;

use Core\Model\Database;
use Core\Model\Crud;
use Observer\Accounts\AccountsObserver;

class ProcessModel extends Crud
{
      protected function save(string $table, array $data)
      {
            if (isset($data[$table . '_id'])) {
                  $this->update($table, $data);
            } else {
                  $this->add($table, $data);
                  $this->notify($table, 'add', null);
            }
      }
      public function handleProcess(array $params, array $data)
      {
            if (sizeof($data) == 0) {
                  // Modification Ajout ou Suppression
                  if ($params['mode'] == "remove" && isset($params['id'])) {
                        $this->notify($params['table'], 'delete', $params['id']);
                        $this->delete($params['table'], $params['id']);

                        header("Location: index.php?page="crud&table="" . $params['table']);
                        exit();
                  }
                  if ($_GET['mode'] == "save") {
                        if (isset($_GET['id'])) {
                              $recordset = Database::getInstance()->getOneFrom($params['table'], $params['table'] . '_id', $params['id']);
                        } else {
                              $recordset = Database::getInstance()->getBlankInput($params['table']);
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
                  header("Location: index.php?page=" . $params['table']);
                  exit();
            }
      }
      protected function notify($table, $action, $params)
      {
            switch ($table) {
                  case 'accounts':
                        AccountsObserver::getInstance()->notify($action, $params);
                        break;
            }
      }
}
