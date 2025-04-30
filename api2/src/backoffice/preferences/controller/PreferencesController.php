<?php

namespace Back\Preferences;

use Core\Model\Auth;

class PreferencesController
{

      public function handle($params)
      {
            Auth::getInstance()->protect();
            $table = 'preferences';
            $model = new PreferencesModel;
            $recordset = $model->handle($params);
            if(isset($params['id'])){
                  include __DIR__ .'/../view/preferences_detail.php';
            }else if(isset($params['mode'])&&$params['mode']=='create') {
                  include __DIR__ .'/../view/preferences_create.php';
            }else{      
                  include __DIR__ . '/../view/preferences.php';
            }
      }
}
