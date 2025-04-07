<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/autoloader.php";

if(isset($_POST['username']) && isset($_POST['password'])){
      Auth::getInstance()->verify($_POST['username'],$_POST['password']);
}

$title = "Connexion";
include "../template/login_template.php";
