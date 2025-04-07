<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/protect.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/class/UserManager.php";

// TODO faire l'autoload
var_dump($_GET);
if (isset($_GET['id']) && isset($_GET['table'])) {
      if ($_GET['table'] == 'users') {
            // TODO enlever le commentaire en dessous apres la création de la fonction d'ajout puis test
            // UserManager::getInstance()->delete($_GET['id']);
            echo 'Suppression du compte utilisateur:' . $_GET['id'];
      }
      header("Location: /pages/users.php");
      exit();
}
header("Location: /pages/index.php");
exit();