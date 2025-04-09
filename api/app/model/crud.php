<?php
require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use Core\Class\Auth;
use Core\Class\Database;
use Config\Config;

Auth::getInstance()->protect();

if(isset($_GET['table'])){
      $table = str_replace('.php','', $_GET['table']);
      $recordset = Database::getInstance()->getAllFrom($table);
      $title = Config::TABLE_CONFIG[$table];
      include_once "../view/crud_view.php";
}else{
      header("Location: index.php");
      exit();
}
?>

