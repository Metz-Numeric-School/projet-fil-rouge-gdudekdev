<?php

namespace Src\Handlers;

use App;
use Core\Model\Handlers;

class Entreprises extends Handlers
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
                  if (isset($url['remove']) && isset($url['id'])) {
                        $this->delete('entreprises', $url['id']);
                        // \Src\Handlers\Handlers::instance()->handle(['table'=>'entreprises_preferences'],['entreprises_id'=>$url['id']]);
                        header("Location: index.php?page=" . 'entreprises');
                        exit();
                  }
            } else {
                  if(empty($data['entreprises_id'])){
                        App::$db->add('entreprises',$data);
                        header("Location: index.php?page=entreprises");
                        exit();
                  }else{
                        // We get different datas related to the tables entreprises and divisions, we now need to route them accordingly
                        $acc_data = [];
                        $acc_pref_data=[];
                        foreach($data as $key=>$value){
                              if(str_contains($key,'entreprises') || in_array($key, ['roles_id','divisions_id'])){
                                    $acc_data[$key] = $value;
                              }else{
                                    $acc_pref_data[$key] = $value;
                              }
                        }
                        $acc_pref_data['entreprises_id'] = $acc_data['entreprises_id'];
                        // \Src\Handlers\Handlers::instance()->handle(['table'=>'entreprises_preferences'],$acc_pref_data);
                        $this->save('entreprises', $acc_data);
      
                        header("Location: index.php?page=entreprises&id=" . $acc_data['entreprises_id']);
                        exit();
                  }
            }
      }
      
}