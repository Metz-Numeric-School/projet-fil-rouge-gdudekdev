<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/protect.php";
// TODO faire la partie modifier un élément

// TODO voir si on fait une classe FORM pour gérer cette page , à méditer

// Ajout
if(isset($_GET['table'])){
      switch ($_GET['table']){
            case 'users':
                  if(isset($_GET['id'])){
                        $obj = Database::getInstance()->getOneFrom('users','id',$_GET['id']);
                  }else{
                        $obj = new User();
                        $obj = $obj->getData();
                        // TODO cas de l'ajout
                  } 
      }
}else{
      header("Location: /pages/index.php");
      exit();
}

$pages = ['users' => 'utilisateurs'];
$currentPage = $pages[$_GET['table']];

include_once '../template/form_template.php';
?>


