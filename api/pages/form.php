<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/protect.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/class/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/class/Database.php";
// TODO faire la partie modifier un élément

// TODO faire la partie ajouter ensuite, si dans le $_GET['id] is not set alors on sait que c'est pour ajouter un élément .
// TODO voir si on fait une classe FORM pour gérer cette page , à méditer
// TODO faire l'autoloader

// Ajout
if(isset($_GET['table'])){
      switch ($_GET['table']){
            case 'users':
                  if(isset($_GET['id'])){
                        $obj = Database::getInstance()->getOneFrom('users','id',$_GET['id']);
                  }else{
                        $obj = new User();
                        $obj = $obj->getData();
                        // TODO cas de l'ajout
                  } 
      }
}else{
      header("Location: /pages/index.php");
      exit();
}

$pages = ['users' => 'utilisateurs'];
$currentPage = $pages[$_GET['table']];

?>


<!DOCTYPE html>
<html lang="fr">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Formulaire CRUD <?= $currentPage; ?></title>
</head>
<style>
      input[readonly]:read-only{
            background-color: lightgray;
      }
</style>

<body>
      <h3>Formulaire pour les <?= $currentPage; ?></h3>    


      <fieldset>
            <form action="/include/form_process.php" method="post">
                  <?php foreach($obj as $key=>$value):?>
                  <label for="<?= $key;?>">
                        <?= ucfirst($key) .':   '?>
                        <br>
                        <input type="text" id="<?= $key;?>" value="<?= $value;?>" name='<?= $key; ?>' <?= ($key=='id' ||$key=='created_at') ? "readonly='readonly'" : '' ?>>
                  </label>
                  <br>
                  <?php endforeach?>
                  <input type="hidden" name="form" value="<?= $_GET['table']; ?>">
                  <input type="submit" value="Envoyer">
            </form>
      </fieldset>
</body>

</html>