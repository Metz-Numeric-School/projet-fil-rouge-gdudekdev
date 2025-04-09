<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/template/header_template.php";
use Config\Config;
?>

<body>
      <h1>Accueil du Back-office Carpool</h1>

      <h2>Actions</h2>
      <div class="accueil__action">
            <?php foreach (Config::TABLE_CONFIG as $key => $value): ?>
                  <?= "<a href='/app/model/crud.php?table=" . $key . "'>" . $value . "</a>" ?>
                  <br />
            <?php endforeach ?>
            <a href="index.php?logout=true">Se déconnecter</a>
      </div>
</body>

</html>