<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../../styles/main.css">
      <link rel="stylesheet" href="historique.css">
      <title>Historique des trajets</title>
</head>

<body>

      <head>
            <nav class="navbar">
                  <div class="navbar__header">
                        <div class="navbar__back">
                              <div class="navbar__back-cta">
                                    <img src="/img/profil/cta/right-arrow.svg" alt="Fleche gauche"
                                          style="transform: rotate(180deg);">
                              </div>
                              <a href="/profil.php">Retour</a>
                        </div>
                        <div class="navbar__title">
                              <h3>Historique des trajets</h3>
                        </div>
                  </div>
                  <div class="navbar__tab">
                        <div class="navbar__tab-passager active">
                              <span>Passager</span>
                        </div>
                        <div class="navbar__tab-conducteur">
                              <span>Conducteur</span>
                        </div>
                  </div>
            </nav>
      </head>
      <main>
            <div class="historique__content">
                  <p>Historique des trajets pour le passager.</p>
                  
            </div>


      </main>
      <?php include '../../footer.php' ?>
</body>
<script src="historique.js"></script>

</html>