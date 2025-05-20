<?php

use Src\Entity\Car_brands;

$title = "Ajout d'une marque";
include_once ROOT . "/view/template/header_template.php";
?>

<body>
      <div class="container">
            <div class="crud__header">
                  <div class="crud__header-cta">
                        <a href="index.php?page=cars&sub=brands" class="crud__table-btn">
                              <\Retour </a>
                  </div>
                              <h2><?= ucfirst($title) ?></h2>
            </div>
            <div class="form__main">
                  <form method="post" action="index.php?page=cars&sub=brands&mode=add">
                        <?php foreach (Car_brands::$array_accepted_key as $key => $value): ?>
                              <?= $value['create_show'] ? "<h5>" . $value['title'] . "</h5>" :''?>
                              <div class="form-group">
                                          <?php if (str_contains($key, "_id")) { ?>
                                                <select name="<?= $key?>" id="<?= $key?>" class="form-control">
                                                      <?php $key = str_replace('_id', '', $key);
                                                            foreach ($$key as $value):
                                                                  $class = '\Src\Entity\\' . ucfirst($key);
                                                                  $obj = new $class($value);
                                                            ?>
                                                             <option value="<?= $obj->id()?>"
                                                                        <?= ($obj->id() === $car_brand->{$key .'_id'}()) ? 'selected' : '' ?>>
                                                                        <?= $obj->name() ?>
                                                                        </option>
                                                      <?php endforeach; ?>
                                                </select>
                                          <?php } else { ?>
                                                <input type="<?= $value['create_show'] ? ($value['type'] ?? "text") : "hidden" ?>"
                                                      name="<?= 'car_brands_' . $key ?>" id="<?= $key ?>" value="<?= $car_brand->{$key}() ?>"
                                                      class="form-control" <?= $value['readonly'] ? "readonly='readonly'" : "" ?>
                                                      <?= $value['required'] ?? false ? 'required' : ''?>>
                                          <?php } ?>
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