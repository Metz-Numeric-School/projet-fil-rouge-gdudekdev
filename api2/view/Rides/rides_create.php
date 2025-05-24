<?php

use Src\Entity\Rides;
use Src\Entity\Routes;
use Src\Entity\Vehicules;

$title = "Ajout d'un trajet";
include_once ROOT . "/view/template/header_template.php";
?>

<body>
    <div class="container">

        <div class="crud__header">
            <div class="crud__header-cta">
                <a href="index.php?page=rides&accounts_id=<?= $account_id ?>" class="crud__table-btn">
                    <\Retour </a>
            </div>
            <h2><?= ucfirst($title) ?></h2>
        </div>
        <div class="form__main">
            <form method="post" action="index.php?page=rides&mode=add&accounts_id=<?= $account_id ?>">
                <div class="form-group">
                    <label><input type="checkbox" name="rides_position" value="driver"> Conducteur</label><br>
                    <!-- TODO changer le js pour que si c'est coché, on affiche le champ du nombre de place sinon on le cache -->

                    <?php foreach (Rides::$array_accepted_key as $key => $value): ?>
                        <?= $value['create_show'] ? "<h5>" . $value['title'] . "</h5>" : '' ?>
                        <div class="form-group">
                            <input type="<?= $value['create_show'] ? ($value['type'] ?? "text") : "hidden" ?>"
                                name="<?= 'rides_' . $key ?>" id="<?= $key ?>" value="<?= $ride->{$key}() ?>"
                                class="form-control" <?= $value['readonly'] ? "readonly='readonly'" : "" ?>
                                <?= $value['required'] ?? false ? 'required' : '' ?>>
                        </div>
                    <?php endforeach ?>
                </div>
                <h5>Vehicule</h5>
                <div class="form-group">
                    <select name="vehicules_id" id="vehicules" class="form-control">
                        <?php foreach ($vehicules as $index => $raw):
                            $vehicule = new Vehicules($raw);
                            ?>
                            <option value="<?= $vehicule->id() ?>">
                                <?= $brands[$index] ?>, <?= $models[$index] ?>, <?= $colors[$index] ?>, <?= $engines[$index] ?>,
                                <?= $vehicule->license_plate() ?>
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
                            <option value="<?= $route->id() ?>" <?= $route->id() === $ride->routes_id() ? 'selected' : '' ?>>
                                <?= $route->departure() ?> , <?= $route->destination() ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <h5>Planification</h5>
                <div class="form-group">
                    <label for="pattern_type">Type de planification</label>
                    <select name="pattern_type" id="pattern_type" class="form-control"
                        onchange="togglePlanningFields(this.value)">
                        <option value="none">Aucune (un seul trajet)</option>
                        <option value="daily">Tous les jours</option>
                        <option value="days">Jours spécifiques</option>
                    </select>
                </div>


                <div id="planning_fields" style="display: none;">
                    <div id="days_selector" style="display: none;">
                        <label>Jours de la semaine :</label><br>
                        <label><input type="checkbox" name="days_of_week[]" value="mon"> Lundi</label><br>
                        <label><input type="checkbox" name="days_of_week[]" value="tue"> Mardi</label><br>
                        <label><input type="checkbox" name="days_of_week[]" value="wed"> Mercredi</label><br>
                        <label><input type="checkbox" name="days_of_week[]" value="thu"> Jeudi</label><br>
                        <label><input type="checkbox" name="days_of_week[]" value="fri"> Vendredi</label><br>
                    </div>


                    <h5>Date de début</h5>
                    <div class="form-group">
                        <input type="date" name="planifications_start" class="form-control">
                    </div>

                    <h5>Date de fin</h5>
                    <div class="form-group">
                        <input type="date" name="planifications_end" class="form-control">
                    </div>
                </div>
                <div id="interval_weeks_group" style="display: none;">
                    <label>Répéter toutes les X semaines</label>
                    <input type="number" name="interval_weeks" class="form-control" value="1" min="1">
                </div>


                <input type="submit" value="Ajouter" />
            </form>
        </div>
    </div>
    </div>
    </div>
</body>
<script src="js/rides_create.js"></script>

</html>