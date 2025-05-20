<?php

use Src\Entity\Routes;


$title = "Ajout d'un itinéraire";
include_once ROOT . "/view/template/header_template.php";
?>
<body>
      <div class="container">

            <div class="crud__header">
                  <div class="crud__header-cta">
                        <a href="index.php?page=routes&accounts_id=<?= $account_id?>" class="crud__table-btn">
                              <\Retour </a>
                  </div>
                              <h2><?= ucfirst($title) ?></h2>
            </div>
            <div class="form__main">
                  <form method="post" action="index.php?page=routes&mode=add&accounts_id=<?= $account_id?>">
                        <?php foreach (Routes::$array_accepted_key as $key => $value): ?>
                              <?= $value['create_show'] ? "<h5>" . $value['title'] . "</h5>" :''?>
                              <div class="form-group">
                                                <input type="<?= $value['create_show'] ? ($value['type'] ?? "text") : "hidden" ?>"
                                                      name="<?= 'routes_' . $key ?>" id="<?= $key ?>" value="<?= $route->{$key}() ?>"
                                                      class="form-control" <?= $value['readonly'] ? "readonly='readonly'" : "" ?>
                                                      <?= $value['required'] ?? false ? 'required' : ''?>>
                              </div>
                        <?php endforeach ?>
                        <input type="hidden" name="accounts_id" value="<?= $account_id?>">
                        <input type="submit" value="Ajouter" />
                  </form>
            </div>
      </div>
      </div>
      </div>
</body>
</html>