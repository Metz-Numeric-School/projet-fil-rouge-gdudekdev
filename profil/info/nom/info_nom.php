<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="info_nom.css">
      <link rel="stylesheet" href="/styles/main.css">
      <title>Informations personnelles</title>
</head>

<body>
      <header>
            <nav class="navbar">
                  <div class="navbar__header">
                        <div class="navbar__back">
                              <a href="\profil\info\info.php" class="navbar__back-cta">
                                    <img src="/img/profil/cta/right-arrow.svg" alt="Flèche gauche"
                                          style="transform: rotate(180deg);">
                              </a>
                        </div>
                  </div>
            </nav>
      </header>
      <main>
            <h2>Votre prénom et nom</h2>
            <form action="#" method="post" class="nom__form" onsubmit="goBack(event)">
                  <label><input type="text" name="nom" value="Gauthier" minlength="2" class="nom__form-txt"></label>
                  <label><input type="text" name="prenom" value="DUDEK" minlength="2" class="nom__form-txt"></label>
                  <input type="submit" value="Mettre à jour" class="nom__form-submit">
            </form>
      </main>
      <script>
            function goBack(event) {
                  event.preventDefault(); // Empêche l'envoi du formulaire
                  history.back(); // Revient à la page précédente
            }
      </script>
</body>

</html>