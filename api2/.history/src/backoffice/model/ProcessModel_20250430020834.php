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
            var_dump($params);
            var_dump($data);
            if (sizeof($data) == 0) {
                  if ($params['mode'] == "remove" && isset($params['id'])) {
                        $this->delete($params['table'], $params['id']);

                        header("Location: index.php?page=" . $params['table']);
                        exit();
                  }
            } else {
                  $this->save($params['table'], $data);
                  // header("Location: index.php?page=" . $params['table']);
                  // exit();
            }
      }

}
