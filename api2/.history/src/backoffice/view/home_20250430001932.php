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
                        <?php foreach (TABLE_GROUP_NAME as $key => $value) : ?> 
                                    <ul class="accueil__group-item">
                                          <?= "<a href='/index.php?page=crud&table=" . $key . "'>" . $value . "</a>" ?>
                                    </ul>
                        <?php endforeach ?>
                  </div>


            </div>
      </div>
</body>

</html>