<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/template/header_template.php";

use Config\Config;
?>

<body>
      <div class="container">
            <div class="accueil__header">
                  <h1>Accueil du Back-office Carpool</h1>
                  <div class="accueil__header-links">

                        <a href="index.php?logout=true" class="accueil__header-link">
                              <p>Se déconnecter</p>
                        </a>
                        <a href="/test.php" class="accueil__header-link">
                              <p>Test</p>
                        </a>
                  </div>

            </div>
            <!-- TODO faire un système pour ranger les classes plus proprement sur l'index, genre les vehicules ensembles , les comptens ensembles , les trajets ... -->
            <div class="accueil__action">
                  <ul class="accueil__group-list">
                        <?php foreach (Config::TABLE_GROUP as $key => $value) : ?> <li>
                                    <ul class="accueil__group-item">
                                          <h3><?= Config::TABLE_GROUP_NAME[$key] ?></h3>
                                          <?php foreach ($value as $table): ?>
                                                <li><?= "<a href='/app/model/crud.php?table=" . $table . "'>" . Config::TABLE_CONFIG[$table] . "</a>" ?></li>
                                          <?php endforeach ?>
                                    </ul>
                              </li>

                        <?php endforeach ?>
                  </ul>


            </div>
      </div>
</body>

</html>