<?php 
include_once "../template/homepage_template.php";
?>
<body>
      <form action="login.php" method="post">
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