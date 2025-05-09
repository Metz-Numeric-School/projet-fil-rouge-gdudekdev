<?php

use Src\Entity\Car_colors;

$title = "Gestion des couleurs des véhicules";
include_once ROOT . "/view/template/header_template.php";
?>

<body>
      <div class="container">

            <div class="crud__header">
                  <div class="crud__header-cta">
                        <a href="index.php?page=cars" class="crud__table-btn">
                              <\Retour </a>
                  </div>
                  <h2><?= ucfirst($title) ?></h2>
            </div>
            <div class="crud__main">
                  <form method="post" action="index.php?page=handlers&table=cars&sub=colors">
                        <div class="form-group">
                              <input type="submit" value="Ajouter">
                              <input type="text" placeholder="Nom de la couleur" name="car_colors_name" required>
                              <input type="text" placeholder="Hexa de la couleur" name="car_colors_hexa" required>
                              <input type="hidden" name="car_colors_id" value="0">
                        </div>
                  </form>
                  <table class="crud__table">
                        <tr>
                              <td class=" crud__table-cell crud__table-cell-header ">Actions</td>
                              <?php foreach (Car_colors::$array_accepted_key as $field):
                                    if ($field['crud_show']) { ?>
                                          <td class=" crud__table-cell crud__table-cell-header "> <?= $field['title'] ?>
                                          </td>
                                    <?php } ?>
                              <?php endforeach ?>
                        </tr>
                        <?php foreach ($colors as $div):
                              $div = new Car_colors($div) ?>

                              <tr>
                                    <td class="crud__table-cell">
                                          <div class="crud__table-cta">
                                                <a href="index.php?page=handlers&table=cars&sub=colors&remove&id=<?= $div->id() ?>"
                                                      class="crud__table-btn crud__table-btn--delete">X</a>
                                          </div>
                                    </td>
                                    <?php foreach (Car_colors::$array_accepted_key as $key => $value):
                                          if ($value['crud_show']) {
                                                $method = str_replace('car_colors_', '', $key) ?>
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