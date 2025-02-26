<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="/styles/main.css">
      <link rel="stylesheet" href="attestation.css">
      <title>Attestation de covoiturage</title>
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

      <body>
            <div class="attestation">
                  <h2>Recevez votre attestation de covoiturage par email</h2>
                  <div class="attestation__content">
                        <p>Cette attestation justifie vos trajets dans le cadre du Forfait Mobilités Durables. Elle vous
                              sera transmise à monadresse@email.com</p>
                        <div class="attestation__main">
                              <div class="attestation__main-item">
                                    <div class="attestation__item-icon">
                                          <img src="/img/profil/icon/mail.svg" alt="Email">
                                    </div>
                                    <div class="attestation__item-content">
                                          <h5>Recevez votre attestation automatiquement chaque mois</h5>
                                          <p>Envoyée le 6 du mois</p>
                                    </div>
                                    <div class="attestation__item-cta">
                                          <div class="attestation__notif-container" onclick="toggleSwitch()">
                                                <div class="toggle-circle"></div>
                                          </div>
                                    </div>
                              </div>
                              <a href="notif/notif.php" class="attestation__main-item">
                                    <div class="attestation__item-icon">
                                          <img src="/img/profil/icon/car-side-svgrepo-com.svg" alt="Voiture">
                                    </div>
                                    <div class="attestation__item-content">
                                          <h5>Recevez votre attestation pour une période précise</h5>
                                    </div>
                                    <div class="attestation__item-cta">
                                          <img src="/img/profil/cta/right-arrow.svg" alt="Flèche vers la droite">
                                    </div>
                              </a>
                        </div>
                  </div>
      </body>
      <script src="attestation.js"></script>
</body>

</html>