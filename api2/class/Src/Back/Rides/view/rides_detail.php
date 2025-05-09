<?php

use Src\Entity\Rides;
use Src\Entity\Rides_recurrence_type;
use Src\Entity\Routes;
use Src\Entity\Vehicules;

$title = "Ajout d'un trajet";
include_once ROOT . "/view/template/header_template.php";
?>
<script>
const allDivisions = <?= json_encode($divisions) ?>;
</script>
<body>
      <div class="container">

            <div class="crud__header">
                  <div class="crud__header-cta">
                        <a href="index.php?page=rides&accounts_id=<?= $account_id?>" class="crud__table-btn">
                              <\Retour </a>
                  </div>
                              <h2><?= ucfirst($title) ?></h2>
            </div>
            <div class="form__main">
                  <form method="post" action="index.php?page=handlers&table=rides">
                        <?php foreach (Rides::$array_accepted_key as $key => $value): ?>
                              <?= $value['create_show'] ? "<h5>" . $value['title'] . "</h5>" :''?>
                              <div class="form-group">
                                                <input type="<?= $value['create_show'] ? ($value['type'] ?? "text") : "hidden" ?>"
                                                      name="<?= 'rides_' . $key ?>" id="<?= $key ?>" value="<?= $ride->{$key}() ?>"
                                                      class="form-control" <?= $value['readonly'] ? "readonly='readonly'" : "" ?>
                                                      <?= $value['required'] ?? false ? 'required' : ''?>>
                              </div>
                        <?php endforeach ?>
                        <h5>Vehicule</h5>
                        <div class="form-group">
                        <select name="vehicules_id" id="vehicules" class="form-control">
                                                      <?php foreach ($vehicules as $index=>$raw):
                                                                  $vehicule = new vehicules($raw);
                                                            ?>
                                                             <option value="<?= $vehicule->id()?>" 
                                                             <?= $ride->vehicules_id() == $vehicule->id() ? 'selected' : '' ?>>
                                                                        <?= $brands[$index]?>, <?=$models[$index]?>, <?=$colors[$index]?>, <?=$engines[$index]?>, <?=$vehicule->license_plate() ?>
                                                                        </option>
                                                      <?php endforeach; ?>
                                                </select>
                        </div>
                        <h5>Trajets</h5>
                        <div class="form-group">
                        <select name="routes_id" id="routes" class="form-control">
                                                      <?php foreach ($routes as $raw):
                                                                  $route = new Routes($raw);
                                                            ?>
                                                             <option value="<?= $route->id()?>"
                                                                        <?= $route->id() === $ride->routes_id() ? 'selected' : '' ?>>
                                                                        <?= $route->departure() ?> , <?= $route->destination() ?>
                                                                        </option>
                                                      <?php endforeach; ?>
                                                </select>
                        </div>
                        <h5>Type de planification</h5>
                        <div class="form-group">
                        <select name="rides_recurrence_type_id" id="rides_recurrence_type" class="form-control">
                                                      <?php foreach ($rides_recurrence_type as $raw):
                                                                  $ride_recurrence_type= new Rides_recurrence_type($raw);
                                                            ?>
                                                             <option value="<?= $ride_recurrence_type->id()?>"
                                                                        <?= $ride_recurrence_type->id() === $ride->rides_recurrence_type_id() ? 'selected' : '' ?>>
                                                                        <?= $ride_recurrence_type->name() ?>
                                                                        </option>
                                                      <?php endforeach; ?>
                                                </select>
                        </div>
                        
                        <input type="submit" value="Mettre à jour" />
                  </form>
            </div>
      </div>
      </div>
      </div>
</body>
<script src="/js/rides_create.js" ></script>  
</html>