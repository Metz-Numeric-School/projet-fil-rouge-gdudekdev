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
                  <ul class="accueil__group-list">
                        <?php foreach (TABLE_GROUP_NAME as $key => $value) : ?> <li>
                                    <ul class="accueil__group-item">
                                                <li><?= "<a href='/index.php?page=crud&table=" . $key . "'>" . $value . "</a>" ?></li>
                                    </ul>
                              </li>
                        <?php endforeach ?>
                  </ul>


            </div>
      </div>
</body>

</html>