<?php
require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
use Core\Class\Auth;


if(isset($_POST['username']) && isset($_POST['password'])){
      Auth::getInstance()->verify($_POST['username'],$_POST['password']);
}

$title = "Connexion";
include "../view/login_view.php";
