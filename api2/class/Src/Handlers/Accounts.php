<?php

namespace Src\Handlers;

use App;
use Core\Model\Handlers;

class Accounts extends Handlers
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
                        $this->delete('accounts', $url['id']);
                        \Src\Handlers\Handlers::instance()->handle(['table'=>'accounts_preferences'],['accounts_id'=>$url['id']]);
                        \Src\Handlers\Handlers::instance()->handle(['table'=>'vehicules'],['account_id'=>$url['id']]);
                        header("Location: index.php?page=" . 'accounts');
                        exit();
                  }
            } else {
                  if(empty($data['accounts_id'])){
                        $data['accounts_created_at'] = date("Y-m-d h:m:s");
                        App::$db->add('accounts',$data);
                        header("Location: index.php?page=accounts");
                        exit();
                  }else{
                        // We get different datas related to the tables accounts and accounts_preferences, we now need to route them accordingly
                        $acc_data = [];
                        $acc_pref_data=[];
                        foreach($data as $key=>$value){
                              if(str_contains($key,'accounts') || in_array($key, ['roles_id','divisions_id'])){
                                    $acc_data[$key] = $value;
                              }else{
                                    $acc_pref_data[$key] = $value;
                              }
                        }
                        $acc_pref_data['accounts_id'] = $acc_data['accounts_id'];
                        \Src\Handlers\Handlers::instance()->handle(['table'=>'accounts_preferences'],$acc_pref_data);
                        $this->save('accounts', $acc_data);
                        var_dump($acc_data);
                        header("Location: index.php?page=accounts&id=" . $acc_data['accounts_id']);
                        exit();
                  }
            }
      }
      
}