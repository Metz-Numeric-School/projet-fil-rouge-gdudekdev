<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="/styles/main.css">
      <link rel="stylesheet" href="stats.css">
      <title>Statistiques de Covoiturage</title>
</head>

<body>
      <nav class="stats__navbar">
            <div class="stats__navbar-header">
                  <div class="stats__navbar-back">
                        <a href="/profil.php" class="stats__navbar-back-cta">
                              <img src="/img/profil/cta/right-arrow.svg" alt="Fleche gauche"
                                    style="transform: rotate(180deg);">
                        </a>
                  </div>
            </div>
      </nav>

      <div class="stats">
            <h2>Vos Statistiques de Covoiturage</h2>
            <div class="stats__content">
                  <p>Consultez vos statistiques personnelles de covoiturage.</p>
                  <div class="stats__main">
                        <div class="stats__main-item">
                              <h5>Nombre de trajets effectués</h5>
                              <p id="total-trips">0</p>
                        </div>
                        <div class="stats__main-item">
                              <h5>Distance totale parcourue</h5>
                              <p id="total-distance">0 km</p>
                        </div>
                        <div class="stats__main-item">
                              <h5>Nombre de passagers transportés</h5>
                              <p id="total-passengers">0</p>
                        </div>
                        <div class="stats__main-item">
                              <h5>Économies réalisées</h5>
                              <p id="total-savings">0 €</p>
                        </div>
                        <!-- Ajouter d'autres statistiques ici -->
                  </div>
            </div>
      </div>
      <script src="stats.js"></script>
</body>

</html>
