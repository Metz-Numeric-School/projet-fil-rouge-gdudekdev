<?php

namespace Back\Accounts\Controller;

use Back\Accounts\Model\AccountsModel;
use Core\Model\Auth;

class AccountsController
{

      public function handle($params)
      {
            Auth::getInstance()->protect();
            $model = new AccountsModel;
            $recordset = $model->handle($params);
            if(isset($params['id'])){
                  include __DIR__ .'/../view/accounts_detail.php';
            }else if(isset($params['mode'])&&$params['mode']=='create') {
                  include __DIR__ .'/../view/accounts_create.php';
            }
            else if(){
                  else{      
                  include __DIR__ . '/../view/accounts.php';
            }
      }
}
