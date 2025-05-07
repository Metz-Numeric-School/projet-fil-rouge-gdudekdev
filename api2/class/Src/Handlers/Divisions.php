<?php

namespace Src\Handlers;

use App;
use Core\Model\Handlers;

class Divisions extends Handlers
{
      private static $instance;
      public static function instance()
      {
            if (is_null(self::$instance)) {
                  self::$instance = new self;
            }
            return self::$instance;
      }
      public function handle($url, $data)
      {
            if (sizeof($data) == 0) {
                  var_dump($url, $data);
                  if (isset($url['remove']) && isset($url['divisions_id']) && isset($url['entreprises_id'])) {
                        App::$db->delete('divisions', $url['divisions_id']);
                        header("Location: index.php?page=entreprises&id=" . $url['entreprises_id']);
                        exit();
                  } else if (isset($url['entreprises_id'])) {
                        App::$db->deleteFromWhere(
                              'divisions',
                              ['stmt' => 'entreprises_id =:entreprises_id', 'params' => [':entreprises_id' => $url['entreprises_id']]]
                        );
                        header("Location: index.php?page=entreprises");
                        exit();
                  }
            } else {
                  if (empty($data['divisions_id'])) {
                        App::$db->add('divisions', $data);
                        header("Location: index.php?page=entreprises&id=" . $data['entreprises_id']);
                        exit();
                  } else {

                  }
            }
      }

}