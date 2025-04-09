<?php
require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use Core\Class\Auth;
use Core\Class\Database;
use Config\Config;

Auth::getInstance()->protect();
// TODO problème ici, il faudrait faire un appel au UserManager approprié à la table plutot pour ce genre de requete

if(isset($_GET['table'])){
      $table = str_replace('.php','', $_GET['table']);
      $recordset = Database::getInstance()->getAllFrom($table);
      $title = Config::TABLE_CONFIG[$table];
      // TODO le include se fera du coté du manager du crud
      include_once "../view/crud_view.php";
}else{
      header("Location: index.php");
      exit();
}
?>

