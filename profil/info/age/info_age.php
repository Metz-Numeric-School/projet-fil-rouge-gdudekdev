<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="info_age.css">
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
            <h2>Votre date de naissance</h2>
            <form action="#" method="post" class="age__form" onsubmit="goBack(event)">
                  <label><input type="date" name="date_naissance"  class="age__form-txt" value="2001-09-01"></label>
                  <input type="submit" value="Mettre à jour" class="age__form-submit">
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