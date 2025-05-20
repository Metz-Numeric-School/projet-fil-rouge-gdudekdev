<?php

use Src\Entity\Car_brands;
use Src\Entity\Car_colors;
use Src\Entity\Car_engines;
use Src\Entity\Vehicules;

$title = "Détail du véhicule";
include_once ROOT . "/view/template/header_template.php";
?>
<body>
<script>
const allModels = <?= json_encode($models) ?>;
let brandId = <?= json_encode($vehicule_brand)?>;
const savedModelId = <?= $vehicule->car_models_id()?>;
</script>
      <div class="container">

            <div class="crud__header">
                  <div class="crud__header-cta">
                        <a href="index.php?page=vehicules&accounts_id=<?= $vehicule->accounts_id()?>" class="crud__table-btn">
                              <\Retour </a>
                  </div>
                              <h2><?= ucfirst($title) ?></h2>
            </div>
            <div class="form__main">
                  <form method="post" action="index.php?page=vehicules&mode=up&accounts_id=<?= $vehicule->accounts_id()?>">
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
                                                             <?= $brand->id() == $vehicule_brand ? 'selected' : '' ?>>
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
                                                             <option value="<?= $color->id()?>"
                                                             <?= $color->id() === $vehicule->car_colors_id() ? 'selected' : '' ?>>
                                                                        <?= $color->name() 
                                                                         ?>
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
                                                             <option value="<?= $engine->id()?>"
                                                             <?= $engine->id() === $vehicule->car_engines_id() ? 'selected' : '' ?>>
                                                                        <?= $engine->name() ?>
                                                                        </option>
                                                      <?php endforeach; ?>
                                                </select>
                        </div>
                        <input type="hidden" name="accounts_id" value="<?= $vehicule->accounts_id()?>">
                        <input type="submit" value="Enregistrer" />
                  </form>
            </div>
      </div>
      </div>
      </div>
</body>
<script src="/js/vehicules_detail.js" ></script>  
</html>