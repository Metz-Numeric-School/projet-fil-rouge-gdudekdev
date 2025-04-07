<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/autoloader.php";
Auth::getInstance()->protect();
// TODO problème ici, il faudrait faire un appel au UserManager plutot pour ce genre de requete

if(isset($_GET['table'])){
      $table = str_replace('.php','', $_GET['table']);
      $recordset = Database::getInstance()->getAllFrom($table);
      $title = TABLE_CONFIG[$table];
      
      include_once "../template/crud_template.php";
}else{
      header("Location: index.php");
      exit();
}
?>

