<?php

use Src\Entity\Routes;
include_once ROOT . "/view/template/header_template.php";
?>

<body>
      <div class="container">

            <div class="crud__header">
                  <div class="crud__header-cta">
                        <a href="index.php?page=accounts&id=<?= $account_id ?>" class="crud__table-btn">
                              <\Retour </a>
                                    <a href="/index.php?page=routes&accounts_id=<?= $account_id ?>&add"
                                          class="crud__table-btn crud__table-btn--edit">Ajouter</a>

                  </div>
                  <h2><?= ucfirst($title) ?></h2>

            </div>
            <div class="crud__main">
                  <table class="crud__table">
                        <tr>
                              <td class=" crud__table-cell crud__table-cell-header ">Actions</td>
                              <?php foreach (Routes::$array_accepted_key as $field):
                                    if ($field['crud_show']) { ?>
                                          <td class=" crud__table-cell crud__table-cell-header "> <?= $field['title'] ?></td>
                                    <?php } ?>
                              <?php endforeach ?>
                        </tr>
                        <?php foreach ($routes as $route):
                              $route = new Routes($route) ?>

                              <tr>
                                    <td class="crud__table-cell">
                                          <div class="crud__table-cta">
                                                <a href="index.php?page=routes&id=<?= $route->id() ?>"
                                                      class="crud__table-btn crud__table-btn--edit">Voir le détail</a>
                                                <a href="index.php?page=routes&mode=remove&id=<?= $route->id() ?>&accounts_id=<?= $account_id?>"
                                                      class="crud__table-btn crud__table-btn--delete">X</a>
                                          </div>
                                    </td>
                                    <?php foreach (Routes::$array_accepted_key as $key => $value):
                                          if ($value['crud_show']) {
                                                $method = str_replace('routes_', '', $key) ?>
                                                <td class="crud__table-cell"><?= $route->$method() ?></td>
                                          <?php } ?>
                                    <?php endforeach ?>
                              </tr>
                        <?php endforeach ?>
                  </table>
            </div>
      </div>
</body>

</html>