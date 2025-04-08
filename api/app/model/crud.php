<?php

use Core\Class\Auth;
use Core\Class\Database;

Auth::getInstance()->protect();
// TODO problème ici, il faudrait faire un appel au UserManager approprié à la table plutot pour ce genre de requete

if(isset($_GET['table'])){
      $table = str_replace('.php','', $_GET['table']);
      $recordset = Database::getInstance()->getAllFrom($table);
      $title = TABLE_CONFIG[$table];
      // TODO le include se fera du coté du manager du crud
      include_once "../template/crud_template.php";
}else{
      header("Location: index.php");
      exit();
}
?>

