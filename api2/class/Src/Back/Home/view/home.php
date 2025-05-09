<?php
$title = "Page d'accueil";
require ROOT . '/view/template/header_template.php';
?>
<body>
      <div class="container">
            <div class="accueil__header">
                  <h1>Accueil du Back-office Carpool</h1>
                  <div class="accueil__header-links">

                        <a href="index.php?page=authenticate&logout=true" class="accueil__header-link">
                              <p>Se déconnecter</p>
                        </a>
                        
                  </div>

            </div>
            <div class="accueil__action">
                  <div class="accueil__group-list">
                                    <div class="accueil__group-item">
                                          <h4>Utilisateurs</h4>
                                          <a href="/index.php?page=accounts">Gérer les Utilisateurs</a>
                                          <a href="/index.php?page=accounts&add">Ajouter un Utilisateur</a>
                                    </div>
                                    <div class="accueil__group-item">
                                          <h4>Entreprises</h4>
                                          <a href="/index.php?page=entreprises">Gérer les Entreprises</a>
                                          <a href="/index.php?page=entreprises&add">Ajouter une Entreprise</a>
                                    </div>
                                    <div class="accueil__group-item">
                                          <h4>Vehicules</h4>
                                          <a href="/index.php?page=cars">Gérer les Véhicules</a>
                                    </div>
                                    <div class="accueil__group-item">
                                          <h4>Preferences</h4>
                                          <a href="/index.php?page=preferences">Gérer les Préférences</a>
                                          <a href="/index.php?page=preferences&add">Ajouter une Préférence</a>
                                    </div>
                                    <div class="accueil__group-item">
                                          <h4>Instances de trajet</h4>
                                          <a href="">Gérer les Utilisateurs</a>
                                          <a href="">Ajouter un Utilisateur</a>
                                    </div>
                                    <div class="accueil__group-item">
                                          <h4>Reservations</h4>
                                          <a href="">Gérer les Utilisateurs</a>
                                          <a href="">Ajouter un Utilisateur</a>
                                    </div>
                                    <div class="accueil__group-item">
                                          <h4>Planifications</h4>
                                          <a href="">Gérer les Utilisateurs</a>
                                          <a href="">Ajouter un Utilisateur</a>
                                    </div>
                                    <div class="accueil__group-item">
                                          <h4>Reactions</h4>
                                          <a href="">Gérer les Utilisateurs</a>
                                          <a href="">Ajouter un Utilisateur</a>
                                    </div>
                                    <!-- TODO on peut considérer que les reccurecne communes et pré enristré on un nom (e.g : Tous les lundis) et ceux qui ne le sont pas sont enregistrés à la volée si il n'existe pas, on peut créer un champ de paramètrage sous la forme d'un tablleau et les comparer au moment de la création d'un trajet pour trouver l'identifiant de la récurrence -->
                              </div>
            </div>
      </div>
</body>

</html>