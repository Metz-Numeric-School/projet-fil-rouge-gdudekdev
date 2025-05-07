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
                  var_dump($url,$data);
                  if (isset($url['remove']) && isset($url['divisions_id']) && isset($url['entreprises_id'])) {
                        App::$db->delete('divisions',$url['divisions_id']);
                        header("Location: index.php?page=entreprises&id=" . $url['entreprises_id']);
                        exit();
                  }
            } else {
                  if(empty($data['divisions_id'])){
                        App::$db->add('divisions',$data);
                        header("Location: index.php?page=entreprises&id=" . $data['entreprises_id']);
                        exit();
                  }else{
                        // We get different datas related to the tables divisions and divisions, we now need to route them accordingly
                        $acc_data = [];
                        $acc_pref_data=[];
                        foreach($data as $key=>$value){
                              if(str_contains($key,'divisions') || in_array($key, ['roles_id','divisions_id'])){
                                    $acc_data[$key] = $value;
                              }else{
                                    $acc_pref_data[$key] = $value;
                              }
                        }
                        $acc_pref_data['divisions_id'] = $acc_data['divisions_id'];
                        // \Src\Handlers\Handlers::instance()->handle(['table'=>'divisions_preferences'],$acc_pref_data);
                        $this->save('divisions', $acc_data);
      
                        header("Location: index.php?page=divisions&id=" . $acc_data['divisions_id']);
                        exit();
                  }
            }
      }
      
}