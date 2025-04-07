<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/autoloader.php";
Auth::getInstance()->protect();


if(isset($_GET['table'])){
      // TODO enlever le switch et faire autrement , de préférnece faire un appel à une classe pour manager ce form
      switch ($_GET['table']){
            case 'users':
                  if(isset($_GET['id'])){
                        $obj = Database::getInstance()->getOneFrom('users','id',$_GET['id']);
                  }else{
                        // TODO le pb est ici plus précissement, il faut pouvoir init un nouvel Objet relatif a la BDD (cela implique de faire toutes les classes nécessaires au bon fonctionnement du tout)
                        $obj = new User();
                        $obj = $obj->getData();
                  } 
      }
}else{
      header("Location: /pages/index.php");
      exit();
}

$pages = ['users' => 'utilisateurs'];
$currentPage = $pages[$_GET['table']];

$title = "formulaire CRUD";
include_once '../template/form_template.php';
?>


