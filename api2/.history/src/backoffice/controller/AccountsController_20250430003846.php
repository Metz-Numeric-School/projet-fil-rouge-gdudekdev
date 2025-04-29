<?php 

namespace Back\Controller;

use Back\Model\AccountsModel;

class AccountsController{

      public function handle(){
           $model = new AccountsModel;
           $model->handle();

           
      }     
}