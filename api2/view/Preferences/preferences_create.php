<?php

use Src\Entity\Preferences;

$title = "Page de création d'une préférence";
include_once ROOT . "/view/template/header_template.php";
?>
<body>
      <div class="container">

            <div class="crud__header">
                  <div class="crud__header-cta">
                        <a href="index.php?page=preferences" class="crud__table-btn">
                              <\Retour </a>
                  </div>
                              <h2><?= ucfirst($title) ?></h2>
            </div>
            <div class="form__main">
                  <form method="post" action="index.php?page=handlers&table=account_preferences">
                        <?php foreach (preferences::$array_accepted_key as $key => $value): ?>
                              <?= $value['create_show'] ? "<h5>" . $value['title'] . "</h5>" :''?>
                              <div class="form-group">
                                                <input type="<?= $value['create_show'] ? ($value['type'] ?? "text") : "hidden" ?>"
                                                      name="<?= 'preferences_' . $key ?>" id="<?= $key ?>" value="<?= $preference->{$key}() ?>"
                                                      class="form-control" <?= $value['readonly'] ? "readonly='readonly'" : "" ?>
                                                      <?= $value['required'] ?? false ? 'required' : ''?>>
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