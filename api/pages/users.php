<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/autoloader.php";
Auth::getInstance()->protect();
// TODO problème ici, il faudrait faire un appel au UserManager plutot pour ce genre de requete
$recordset = Database::getInstance()->getAllFrom('users');

$title = "Utilisateurs";
include_once "../template/users_template.php";
?>

