<?php

namespace Back\Controller;

use Back\Model\AccountsModel;
use Core\Model\Auth;

class AccountsController
{

      public function handle($params)
      {
            Auth::getInstance()->protect();
            $model = new AccountsModel;
            $recordset = $model->handle();
            if($id){

            }else{
                  include __DIR__ . '/../view/accounts.php';
            }
      }
}
