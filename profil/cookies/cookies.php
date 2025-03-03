<!DOCTYPE html>
<html lang="fr">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="cookies.css">
      <link rel="stylesheet" href="/styles/main.css">
      <title>Paramètres des Cookies</title>
</head>

<body>
      <header>
            <nav class="navbar">
                  <div class="navbar__header">
                        <div class="navbar__back">
                              <a href="/profil.php" class="navbar__back-cta">
                                    <img src="/img/profil/cta/right-arrow.svg" alt="Flèche gauche"
                                          style="transform: rotate(180deg);">
                              </a>
                        </div>
                  </div>
            </nav>
      </header>
      
      <main>
            <h2>Paramètres des Cookies</h2>
            <p>Gérez vos préférences en matière de cookies ici.</p>
            <form id="cookie-settings-form" class="cookies__form">
                  <div class="cookies__main">
                        <label class="cookies__item">
                              <h5>Cookies Essentiels</h5>
                              <p>Ces cookies sont nécessaires au bon fonctionnement du site.</p>
                              <input type="checkbox" checked disabled>
                        </label>
                        <label class="cookies__item">
                              <h5>Cookies de Performance</h5>
                              <p>Ces cookies nous permettent d’analyser le trafic et d'améliorer votre expérience.</p>
                              <input type="checkbox" id="performance-cookies">
                        </label>
                        <label class="cookies__item">
                              <h5>Cookies de Fonctionnalité</h5>
                              <p>Ces cookies permettent d’enregistrer vos préférences.</p>
                              <input type="checkbox" id="functionality-cookies">
                        </label>
                        <label class="cookies__item">
                              <h5>Cookies Publicitaires</h5>
                              <p>Nous n'affichons pas de publicités, mais certains cookies peuvent être utilisés pour des analyses anonymes.</p>
                              <input type="checkbox" id="advertising-cookies">
                        </label>
                  </div>
                  <input type="submit" value="Enregistrer mes préférences" class="cookies__form-submit">
            </form>
      </main>
</body>

</html>
