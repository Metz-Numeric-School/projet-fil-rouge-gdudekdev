<?php

namespace Src\Handlers;

use App;
use Core\Model\Handlers;

class Accounts_Preferences extends Handlers
{
      private static $instance;
      public static function instance()
      {
            if (is_null(self::$instance)) {
                  self::$instance = new self;
            }
            return self::$instance;
      }
      public function handle($url,$data){
           App::$db->deleteFromWhere('accounts_preferences',['stmt'=>'accounts_id = :accounts_id','params'=>[':accounts_id'=>$data['accounts_id']]]);
           if(isset($data['preferences'])){
                 foreach($data['preferences'] as $pref){
                  App::$db->add('accounts_preferences', ['accounts_id'=>$data['accounts_id'], 'preferences_id'=>$pref]);
                 }
           }
      }
}