<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/protect.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/class/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/class/UserManager.php";

 if(isset($_POST['form'])){
      // TODO lorsqu'il y aura plus de table à gerer, il faudrait pouvoir récupérer des données d'autres formulaires et donc éviter de mettre des if partout 
      if($_POST['form'] == 'users'){
            $user = new User(User::setData($_POST));
            if($_POST['id'] == 0){
                  UserManager::getInstance()->add($user);
            }else{
                  UserManager::getInstance()->update($user);
            }
            header("Location: /pages/users.php");
            exit();
      }
 }
 header("Location: /pages/index.php");
 exit();

