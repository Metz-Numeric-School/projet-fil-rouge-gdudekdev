<?php
require ROOT . '/view/template/header_template.php';
?>

<body>
      <div class="container">
            <div class="accueil__header">
                  <a href="index.php?page=home" class="crud__table-btn">
                        <\Retour </a>
                              <h1><?= $title ?></h1>
            </div>
            <div class="accueil__action">
                  <div class="accueil__group-list">
                        <div class="accueil__group-item">
                              <h4>Marques</h4>
                              <a href="/index.php?page=cars&sub=brands">Gérer les Marques et Modeles Associés</a>
                        </div>
                        <div class="accueil__group-item">
                              <h4>Couleurs</h4>
                              <a href="/index.php?page=cars&sub=colors">Gérer les Couleurs des véhicules</a>
                        </div>
                        <div class="accueil__group-item">
                              <h4>Motorisations</h4>
                              <a href="/index.php?page=cars&sub=engines">Gérer les Motorisations des véhicules</a>
                        </div>
                  </div>
            </div>
      </div>
</body>

</html>