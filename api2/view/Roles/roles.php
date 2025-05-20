<?php

use Src\Entity\Roles;

$title = "Gestion des roles";
include_once ROOT . "/view/template/header_template.php";
?>

<body>
      <div class="container">

            <div class="crud__header">
                  <div class="crud__header-cta">
                        <a href="index.php?page=home" class="crud__table-btn">
                              <\Retour </a>
                  </div>
                  <h2><?= ucfirst($title) ?></h2>
            </div>
            <div class="crud__main">
                  <form method="post" action="index.php?page=roles&mode=add">
                        <div class="form-group">
                              <input type="submit" value="Ajouter">
                              <input type="text" placeholder="Nom du role" name="roles_name" required>
                              <input type="hidden" name="roles_id" value="0">
                        </div>
                  </form>
                  <table class="crud__table">
                        <tr>
                              <td class=" crud__table-cell crud__table-cell-header ">Actions</td>
                              <?php foreach (Roles::$array_accepted_key as $field):
                                    if ($field['crud_show']) { ?>
                                          <td class=" crud__table-cell crud__table-cell-header "> <?= $field['title'] ?>
                                          </td>
                                    <?php } ?>
                              <?php endforeach ?>
                        </tr>
                        <?php foreach ($roles as $div):
                              $div = new Roles($div) ?>

                              <tr>
                                    <td class="crud__table-cell">
                                          <div class="crud__table-cta">
                                                <a href="index.php?page=roles&mode=remove&id=<?= $div->id() ?>"
                                                      class="crud__table-btn crud__table-btn--delete">X</a>
                                          </div>
                                    </td>
                                    <?php foreach (Roles::$array_accepted_key as $key => $value):
                                          if ($value['crud_show']) {
                                                $method = str_replace('roles_', '', $key) ?>
                                                <td class="crud__table-cell"><?= $div->$method() ?></td>
                                          <?php } ?>
                                    <?php endforeach ?>
                              </tr>
                        <?php endforeach ?>
                  </table>
            </div>
      </div>
      </div>
      </div>
</body>

</html>