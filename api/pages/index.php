<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/autoloader.php";
Auth::getInstance()->protect();

if (isset($_GET['logout']) && $_GET['logout'] == true) {
      Auth::getInstance()->disconnect();
}

$title = "Page d'accueil";
include_once '../template/homepage_template.php';
