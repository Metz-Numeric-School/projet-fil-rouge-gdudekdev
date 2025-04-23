<?php
$title = "Page d'accueil";
include_once __DIR__ . "/../../template/header_template.php";

use Config\Config;
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
                        <?php foreach (Config::TABLE_GROUP as $key => $value) : ?> <li>
                                    <ul class="accueil__group-item">
                                          <h3><?= Config::TABLE_GROUP_NAME[$key] ?></h3>
                                          <?php foreach ($value as $table): ?>
                                                <li><?= "<a href='/index.php?page=crud&table=" . $table . "'>" . Config::TABLE_CONFIG[$table] . "</a>" ?></li>
                                          <?php endforeach ?>
                                    </ul>
                              </li>
                        <?php endforeach ?>
                  </ul>


            </div>
      </div>
</body>

</html>