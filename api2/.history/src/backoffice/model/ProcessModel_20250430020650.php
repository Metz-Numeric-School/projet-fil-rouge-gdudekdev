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
            }
      }
      public function handleProcess(array $params, array $data)
      {
            var_dump($params)
            if (sizeof($data) == 0) {
                  if ($params['mode'] == "remove" && isset($params['id'])) {
                        $this->delete($params['table'], $params['id']);

                        header("Location: index.php?page=" . $params['table']);
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
                  date_default_timezone_set('Europe/Paris');
                  foreach ($data as $k => $v) {
                        if (str_contains($k, '_at')) {
                              $data[$k] = date('Y-m-d h:m:s');
                        } else {
                              $data[$k] = $v;
                        }
                  }
                  $this->save($params['table'], $data);
                  // header("Location: index.php?page=" . $params['table']);
                  // exit();
            }
      }

}
