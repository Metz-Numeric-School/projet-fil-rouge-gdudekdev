<?php
require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
use Core\Class\Auth;
Auth::getInstance()->protect();


if (isset($_GET['logout']) && $_GET['logout'] == true) {
      Auth::getInstance()->disconnect();
}


$title = "Page d'accueil";
include_once '../view/index_view.php';
