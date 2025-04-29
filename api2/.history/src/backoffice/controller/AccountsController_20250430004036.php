<?php 

namespace Back\Controller;

use Back\Model\AccountsModel;

class AccountsController{

      public function handle(){
           $model = new AccountsModel
           Auth::getInstance()->protect();
           $recordset = $model->handle();

           include __DIR__ .'/../view/accounts.php';
      }     
}