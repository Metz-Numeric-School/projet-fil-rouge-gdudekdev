<?php

use Src\Entity\Car_brands;
use Src\Entity\Car_colors;
use Src\Entity\Car_engines;
use Src\Entity\Vehicules;

$title = "Page d'ajout d'un véhicule";
include_once ROOT . "/view/template/header_template.php";
?>
<script>
const allModels = <?= json_encode($models) ?>;
</script>
<body>
      <div class="container">

            <div class="crud__header">
                  <div class="crud__header-cta">
                        <a href="index.php?page=vehicules&accounts_id=<?= $account_id?>" class="crud__table-btn">
                              <\Retour </a>
                  </div>
                              <h2><?= ucfirst($title) ?></h2>
            </div>
            <div class="form__main">
                  <form method="post" action="index.php?page=vehicules&accounts_id=<?= $account_id?>&mode=add">
                        <?php foreach (Vehicules::$array_accepted_key as $key => $value): ?>
                              <?= $value['create_show'] ? "<h5>" . $value['title'] . "</h5>" :''?>
                              <div class="form-group">
                                                <input type="<?= $value['create_show'] ? ($value['type'] ?? "text") : "hidden" ?>"
                                                      name="<?= 'vehicules_' . $key ?>" id="<?= $key ?>" value="<?= $vehicule->{$key}() ?>"
                                                      class="form-control" <?= $value['readonly'] ? "readonly='readonly'" : "" ?>
                                                      <?= $value['required'] ?? false ? 'required' : ''?>>
                              </div>
                        <?php endforeach ?>
                        
                      
                        <h5>Marques</h5>
                        <div class="form-group">
                        <select id="brands" class="form-control" >
                                                      <?php foreach ($brands as $raw):
                                                                  $brand = new Car_brands($raw);
                                                            ?>
                                                             <option value="<?= $brand->id()?>"
                                                                        >
                                                                        <?= $brand->name() ?>
                                                                        </option>
                                                      <?php endforeach; ?>
                                                </select>
                        </div>
                        <h5>Modeles</h5>
                        <div class="form-group">
                        <select name="car_models_id" id="models" class="form-control" required></select>
                        </div>
                        <h5>Couleurs</h5>
                        <div class="form-group">
                        <select name="car_colors_id" id="car_colors" class="form-control">
                                                      <?php foreach ($colors as $raw):
                                                                  $color = new Car_colors($raw);
                                                            ?>
                                                             <option value="<?= $color->id()?>">
                                                                        <?= $color->name() ?>
                                                                        </option>
                                                      <?php endforeach; ?>
                                                </select>
                        </div>
                        <h5>Motorisations</h5>
                        <div class="form-group">
                        <select name="car_engines_id" id="car_engines" class="form-control">
                                                      <?php foreach ($engines as $raw):
                                                                  $engine = new Car_engines($raw);
                                                            ?>
                                                             <option value="<?= $engine->id()?>">
                                                                        <?= $engine->name() ?>
                                                                        </option>
                                                      <?php endforeach; ?>
                                                </select>
                        </div>
                        <input type="hidden" name="accounts_id" value="<?= $account_id?>">
                        <input type="submit" value="Enregistrer" />
                  </form>
            </div>
      </div>
      </div>
      </div>
</body>
<script src="/js/vehicules_create.js" ></script>  
</html>