<?php 
$title = "Login";
include_once __DIR__ . "/../../template/header_template.php";
?>
<body>
      <form action="/index.php?page=login" method="post">
            <fieldset>
                  <label for="username">Utilisateur</label>
                  <input type="text" id="username"  name="username" placeholder="Utilisateur">

                  <label for="password">Mot de passe</label>
                  <input type="text" id="password" name="password" placeholder="Mot de passe">

                  <input type="submit" value="Se connecter">
            </fieldset>
      </form>
</body>

</html>