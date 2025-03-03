<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="info_pref.css">
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
            <h2>Préférences</h2>
            <form action="#" method="post" class="pref__form" onsubmit="goBack(event)">
                  <div class="pref__fumeur">
                        <h4>Je suis fumeur</h4>
                        <div class="pref__toggle-container" onclick="toggleSwitch()">
                              <div class="toggle-circle"></div>
                        </div>
                  </div>
                  <div class="pref__bavard">
                        <h4>Je suis bavard</h4>
                        <input type="range" min="0" max="5" step="1" name="bavardLevel" id="bavardLevel">
                  </div>
                  <div>
                        
                  </div>
                  <input type="hidden" name="toggleState" id="toggleState" value="off">
                  <input type="submit" value="Mettre à jour" class="pref__form-submit">
            </form>

      </main>
      <script src="info_pref.js"></script>
</body>

</html>