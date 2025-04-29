<?php
$title = "Page d'accueil";
include_once __DIR__ . "/../../../template/header_template.php";

const TABLE_GROUP_NAME = [
      'accounts' => 'Utilisateurs',
      'rides' => 'Trajets',
      'messages' => 'Conversations',
      'vehicules' => 'Vehicules',
      'others' => 'Autres',
];

?>

<body>
      <div class="container">
            <div class="accueil__header">
                  <h1>Accueil du Back-office Carpool</h1>
                  <div class="accueil__header-links">

                        <a href="index.php?page=logout" class="accueil__header-link">
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
                                          <a href="/index.php?page=crud&table=accounts">Gérer les Utilisateurs</a>
                                          <a href="/index.php?page=process&table=accounts&mode=save">Ajouter un Utilisateur</a>
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
                                          <h4>Utilisateurs</h4>
                                          <a href="">Gérer les Utilisateurs</a>
                                          <a href="">Ajouter un Utilisateur</a>
                                    </div>
                  </div>


            </div>
      </div>
</body>

</html>