<!DOCTYPE html>
<html lang="fr">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="/styles/main.css">
      <link rel="stylesheet" href="vehicule.css">

      <title>Confirmation</title>
</head>

<body>
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
      <main>
            <!-- Formulaire multi-étapes -->
            <form action="#" method="post">
                  <!-- Etape 1 : modèle du vehicule -->

                  <div class="form__etape" id="marque">
                        <h2>Quelle est la marque de votre véhicule?</h2>
                        <div class="form__etape-choix">
                              <div class="form__choix">
                                    <div class="form__choix-item">
                                          <div class="form__choix-img">
                                                <img src="#" alt="">
                                          </div>
                                          <div class="form__choix-libelle">
                                                <p>CITROEN</p>
                                          </div>
                                    </div>
                                    <div class="form__choix-cta">
                                          <img src="/img/profil/cta/right-arrow.svg" alt="Fleche vers la droite">
                                    </div>
                              </div>
                              <div class="form__choix">
                                    <div class="form__choix-item">
                                          <div class="form__choix-img">
                                                <img src="#" alt="">
                                          </div>
                                          <div class="form__choix-libelle">
                                                <p>PEUGEOT</p>
                                          </div>
                                    </div>
                                    <div class="form__choix-cta">
                                          <img src="/img/profil/cta/right-arrow.svg" alt="Fleche vers la droite">
                                    </div>
                              </div>
                        </div>

                  </div>
                  <div class="form__etape" id="modele" style="display: none;">
                        <h2>Quelle est le modele de votre véhicule?</h2>
                        <div class="form__etape-choix">
                              <div class="form__choix">
                                    <div class="form__choix-item">
                                          <div class="form__choix-img">
                                                <img src="#" alt="">
                                          </div>
                                          <div class="form__choix-libelle">
                                                <p>CITROEN</p>
                                          </div>
                                    </div>
                                    <div class="form__choix-cta">
                                          <img src="/img/profil/cta/right-arrow.svg" alt="Fleche vers la droite">
                                    </div>
                              </div>
                              <div class="form__choix">
                                    <div class="form__choix-item">
                                          <div class="form__choix-img">
                                                <img src="#" alt="">
                                          </div>
                                          <div class="form__choix-libelle">
                                                <p>PEUGEOT</p>
                                          </div>
                                    </div>
                                    <div class="form__choix-cta">
                                          <img src="/img/profil/cta/right-arrow.svg" alt="Fleche vers la droite">
                                    </div>
                              </div>
                        </div>

                  </div>
                  <!-- Étape 3 : Récapitulatif -->
                  <div class="form__etape" id="recap" style="display: none;">
                        <h2>Récapitulatif</h2>
                        <div class="form__recap-content">
                              
                        </div>
                        <button type="submit" class="form__submit">Valider</button>
                  </div>


            </form>
      </main>
      <script src="vehicule.js"></script>
</body>


</html>