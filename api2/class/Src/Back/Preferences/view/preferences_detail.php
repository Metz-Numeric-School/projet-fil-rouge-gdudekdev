<?php

use Src\Entity\Preferences;
use Src\Entity\Entreprises;
use Src\Entity\Roles;

$title = "Page de détail de la preférence n° " . $preference->id();
include_once ROOT . "/view/template/header_template.php";
?>
<body>
      <div class="container">
            <div class="crud__header">
                  <div class="crud__header-cta">
                        <a href="index.php?page=preferences" class="crud__table-btn">
                              <\Retour </a>
                              <a href="index.php?page=handlers&table=preferences&remove&id=<?= $preference->id()?>" 
                              class="crud__table-btn crud__table-btn--delete">Supprimer</a>
                        </div>
                        <h2><?= ucfirst($title) ?></h2>
            </div>
            <div class="form__main">
                  <form method="post" action="index.php?page=handlers&table=preferences">
                        <?php foreach (Preferences::$array_accepted_key as $key => $value): ?>
                              <?= $value['detail_show'] ? "<h5>" . $value['title'] . "</h5>" :''?>
                              <div class="form-group">
                                                <input type="<?= $value['detail_show'] ? ($value['type'] ?? "text") : "hidden" ?>"
                                                      name="<?= 'preferences_' . $key ?>" id="<?= $key ?>" value="<?= $preference->{$key}() ?>"
                                                      class="form-control" <?= $value['readonly'] ? "readonly='readonly'" : "" ?>>
                              </div>
                        <?php endforeach ?>
                        <input type="submit" value="Mettre à jour" />
                  </form>
            </div>
      </div>
      </div>
      </div>
</body>
</html>