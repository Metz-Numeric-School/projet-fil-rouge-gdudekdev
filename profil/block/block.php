<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="/styles/main.css">
      <link rel="stylesheet" href="block.css">
      <title>Membres Bloqués</title>
</head>

<body>
      <nav class="block__navbar">
            <div class="block__navbar-header">
                  <div class="block__navbar-back">
                        <a href="/profil.php" class="block__navbar-back-cta">
                              <img src="/img/profil/cta/right-arrow.svg" alt="Fleche gauche"
                                    style="transform: rotate(180deg);">
                        </a>
                  </div>
            </div>
      </nav>

      <div class="block">
            <h2>Liste des membres bloqués</h2>
            <div class="block__content">
                  <p>Vous pouvez gérer les membres que vous avez bloqués ici.</p>
                  <div class="block__main">
                        <div class="block__main-item">
                              <div class="block__item-icon">
                                    <img src="/img/profil/icon/user-block.svg" alt="Membre Bloqué">
                              </div>
                              <div class="block__item-content">
                                    <h5>Nom du membre</h5>
                                    <p>Date de blocage: 01/01/2023</p>
                              </div>
                              <div class="block__item-cta">
                                    <button class="block__unblock-button">Débloquer</button>
                              </div>
                        </div>
                        <!-- Ajouter d'autres membres bloqués ici -->
                  </div>
            </div>
      </div>
      <script src="block.js"></script>
</body>

</html>
