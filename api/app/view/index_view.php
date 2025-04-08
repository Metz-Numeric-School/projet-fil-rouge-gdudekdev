<?php
include_once "../template/header_template.php";
?>

<body>
      <h1>Accueil du Back-office Carpool</h1>

      <h2>Actions</h2>
      <div class="accueil__action">
            <?php foreach (TABLE_CONFIG as $key => $value): ?>
                  <?= "<a href='/pages/crud.php?table=" . $key . "'>" . $value . "</a>" ?>
                  <br />
            <?php endforeach ?>
            <a href="index.php?logout=true">Se déconnecter</a>
      </div>
</body>

</html>