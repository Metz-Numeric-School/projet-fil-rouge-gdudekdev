<?php

namespace Src\Model;

use App;



class Accounts_preferences extends Model
{
      public static $table = 'accounts_preferences';

      public static function delete($id, $bound = null)
      {
            $field = isset($id['accounts_id']) ? 'accounts_id' : 'preferences_id';
            App::$db->deleteFromWhere('accounts_preferences',['stmt'=>$field . '=:id', 'params'=>[':id'=>$id[$field]]]);
      }
}
