<?php 
$title = "Connexion";
include_once ROOT . "/view/template/header_template.php";
?>
<body>
      <form action="/index.php?page=authenticate" method="post">
            <fieldset>
                  <label for="email">Utilisateur</label>
                  <input type="text" id="email"  name="email" placeholder="Utilisateur">

                  <label for="password">Mot de passe</label>
                  <input type="text" id="password" name="password" placeholder="Mot de passe">
                  <input type="submit" value="Se connecter">
            </fieldset>
      </form>
</body>
</html>