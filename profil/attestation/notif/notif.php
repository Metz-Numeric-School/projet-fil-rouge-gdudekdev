<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="/styles/main.css">
      <link rel="stylesheet" href="notif.css">

      <title>Votre attestation</title>
</head>

<body>
      <head>
            <nav class="navbar">
                  <div class="navbar__header">
                        <div class="navbar__back">
                              <a href="/profil.php" class="navbar__back-cta">
                                    <img src="/img/profil/cta/right-arrow.svg" alt="Fleche gauche"
                                          style="transform: rotate(180deg);">
                              </a>
                        </div>
                  </div>
            </nav>
      </head>
      <main>
            <div class="notif">
                  <h2>Pour quelle période souhaitez-vous recevoir une attestation?</h2>
                  <div class="notif__content">
                        <div class="notif__content-info">
                              <div class="notif__content-info-img">
                                    <img src="/img/profil/icon/info.svg" alt="Info">
                              </div>
                              <p>Les trajets effectués au cours des dernières 72 heures n'apparaîtront pas dans
                                    votre attestation.</p>
                        </div>
                        <div class="notif__content-form">
                              <form action="#" method="get" class="notif__form">
                                    <label for="notif_debut">Du</label>
                                    <input type="date" id="notif_debut" name="notif_debut" placeholder="JJ/MM/AAAA"
                                          min="<?php echo date('d-m-Y'); ?>">
                                    <label for="notif_fin">Au</label>
                                    <input type="date" id="notif_fin" name="notif_fin" placeholder="JJ/MM/AAAA"
                                          min="<?php echo date('d-m-Y'); ?>">

                                    <input type="submit" value="Recevoir une attestation">
                              </form>
                        </div>
                  </div>
      </main>
</body>
<script src="notif.js"></script>

</html>