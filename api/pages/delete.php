<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/protect.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/class/UserManager.php";

// TODO faire l'autoload
if (isset($_GET['id']) && isset($_GET['table'])) {
      if ($_GET['table'] == 'users') {
            UserManager::getInstance()->delete($_GET['id']);
            echo 'Suppression du compte utilisateur:' . $_GET['id'];
      }
      header("Location: /pages/users.php");
      exit();
}
header("Location: /pages/index.php");
exit();