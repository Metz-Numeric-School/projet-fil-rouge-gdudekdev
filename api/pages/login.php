<?php 
// TODO voir si on peut faire le login en full poo genre avec une class SESSION ou LOgin idk
if(isset($_POST['id']) && isset($_POST['password'])){
      $row = Database::getInstance()->getOneFrom('users','id',$_POST['id']);
      var_dump($row);
      if($row){
            if($row['password'] == $_POST['password']){ //password_verify plus tard
                  session_start();
                  $_SESSION['is_logged'] = true;
                  header("Location: index.php");
                  exit();
            }else{
                  echo "Utilisateur ou mot de passe incorrect";
            }
      }else{
            echo "Utilisateur ou mot de passe incorrect";
      }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=
      , initial-scale=1.0">
      <title>Connexion</title>
</head>

<body>
      <form action="login.php" method="post">
            <fieldset>
                  <label for="id">Utilisateur</label>
                  <input type="text" id="id"  name="id" placeholder="Utilisateur">

                  <label for="password">Mot de passe</label>
                  <input type="text" id="password" name="password" placeholder="Mot de passe">

                  <input type="submit" value="Se connecter">
            </fieldset>
      </form>
</body>

</html>