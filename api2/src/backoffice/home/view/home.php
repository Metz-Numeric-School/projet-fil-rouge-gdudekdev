<?php
$title = "Page d'accueil";
include_once $_SERVER['DOCUMENT_ROOT'] . "/../template/header_template.php";
?>

<body>
      <div class="container">
            <div class="accueil__header">
                  <h1>Accueil du Back-office Carpool</h1>
                  <div class="accueil__header-links">

                        <a href="index.php?page=authentificate&logout=true" class="accueil__header-link">
                              <p>Se déconnecter</p>
                        </a>
                        <a href="/test.php" class="accueil__header-link">
                              <p>Test</p>
                        </a>
                  </div>

            </div>
            <div class="accueil__action">
                  <div class="accueil__group-list">
                                    <div class="accueil__group-item">
                                          <h4>Utilisateurs</h4>
                                          <a href="/index.php?page=accounts">Gérer les Utilisateurs</a>
                                          <a href="/index.php?page=accounts&mode=create">Ajouter un Utilisateur</a>
                                    </div>
                                    <div class="accueil__group-item">
                                          <h4>Vehicules</h4>
                                          <a href="">Gérer les Utilisateurs</a>
                                          <a href="">Ajouter un Utilisateur</a>
                                    </div>
                                    <div class="accueil__group-item">
                                          <h4>Entreprises</h4>
                                          <a href="">Gérer les Utilisateurs</a>
                                          <a href="">Ajouter un Utilisateur</a>
                                    </div>
                                    <div class="accueil__group-item">
                                          <h4>Preferences</h4>
                                          <a href="/index.php?page=preferences">Gérer les Préférences</a>
                                          <a href="/index.php?page=preferences&mode=create">Ajouter une Préférence</a>
                                    </div>
                                    <div class="accueil__group-item">
                                          <h4>Reactions</h4>
                                          <a href="">Gérer les Utilisateurs</a>
                                          <a href="">Ajouter un Utilisateur</a>
                                    </div>
                  </div>
            </div>
      </div>
</body>

</html>