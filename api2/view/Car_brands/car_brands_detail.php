<?php

use Src\Entity\Car_models;
use Src\Entity\Car_brands;


$title = ucfirst($car_brand->name());
include_once ROOT . "/view/template/header_template.php";
?>

<body>
      <div class="container">

            <div class="crud__header">
                  <div class="crud__header-cta">
                        <a href="index.php?page=cars&sub=brands" class="crud__table-btn">
                              <\Retour </a>
                                    <a href="index.php?page=cars&sub=brands&mode=remove&id=<?= $car_brand->id() ?>"
                                          class="crud__table-btn crud__table-btn--delete">Supprimer</a>
                  </div>
                  <h2><?= ucfirst($title) ?></h2>
            </div>
            <div class="form__main">
                  <form method="post" action="index.php?page=cars&mode=up&sub=brands">
                        <?php foreach (Car_brands::$array_accepted_key as $key => $value): ?>
                              <?= $value['detail_show'] ? "<h5>" . $value['title'] . "</h5>" : '' ?>
                              <div class="form-group">
                                    <input type="<?= $value['detail_show'] ? ($value['type'] ?? "text") : "hidden" ?>"
                                    name="<?= 'car_brands_' . $key ?>" id="<?= $key ?>" value="<?= $car_brand->{$key}() ?>"
                                          class="form-control" <?= $value['readonly'] ? "readonly='readonly'" : "" ?>>

                              </div>
                        <?php endforeach ?>
                        <input type="submit" value="Mettre à jour" />
                  </form>
            </div>
            <div class="form__main">
                  <h5>Modeles de la marque</h5>
                  <form method="post" action="index.php?page=cars&sub=models&mode=add&car_brands_id=<?= $car_brand->id()?>">
                        <div class="form-group">
                              <input type="submit" value="Ajouter">
                              <input type="text" placeholder="Nom de la marque" name="car_models_name">
                              <input type="hidden" name="car_brands_id" value="<?= $car_brand->id()?>">
                        </div>
                  </form>
                  <div class="crud__main">
                        <table class="crud__table">
                              <tr>
                                    <td class=" crud__table-cell crud__table-cell-header ">Actions</td>
                                    <?php foreach (Car_models::$array_accepted_key as $field):
                                          if ($field['crud_show']) { ?>
                                                <td class=" crud__table-cell crud__table-cell-header "> <?= $field['title'] ?>
                                                </td>
                                          <?php } ?>
                                    <?php endforeach ?>
                              </tr>
                              <?php foreach ($models as $div):
                                    $div = new Car_models($div) ?>

                                    <tr>
                                          <td class="crud__table-cell">
                                                <div class="crud__table-cta">
                                                      <a href="index.php?page=cars&sub=models&mode=remove&id=<?= $div->id() ?>&car_brands_id=<?= $car_brand->id()?>"
                                                            class="crud__table-btn crud__table-btn--delete">X</a>
                                                </div>
                                          </td>
                                          <?php foreach (Car_models::$array_accepted_key as $key => $value):
                                                if ($value['crud_show']) {
                                                      $method = str_replace('car_models_', '', $key) ?>
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
      </div>
</body>

</html>