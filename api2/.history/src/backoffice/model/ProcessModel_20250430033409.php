<?php

namespace Back\Model;

use Core\Model\Crud;

class ProcessModel extends Crud
{
      public function handleProcess(array $params, array $data)
      {
            if (sizeof($data) == 0) {
                  if ($params['mode'] == "remove" && isset($params['id'])) {
                        $this->delete($params['table'], $params['id']);

                        header("Location: index.php?page=" . $params['table']);
                        exit();
                  }
            } else {
                  $this->save($params['table'], $data);
                  var_dump($params);
                  var_dump($data);
                  header("Location: index.php?page=" . $params['table']);
                  exit();
            }
      }

}
