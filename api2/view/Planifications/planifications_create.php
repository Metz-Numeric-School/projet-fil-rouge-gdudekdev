<?php

use Src\Entity\Planifications;

$title = "Ajout d'une planification";
include_once ROOT . "/view/template/header_template.php";
?>
<script>
const allDivisions = <?= json_encode($divisions) ?>;
</script>
<body>
      <div class="container">

            <div class="crud__header">
                  <div class="crud__header-cta">
                        <a href="index.php?page=planifications" class="crud__table-btn">
                              <\Retour </a>
                  </div>
                              <h2><?= ucfirst($title) ?></h2>
            </div>
            <div class="form__main">
                  <form method="post" action="index.php?page=handlers&table=planifications">
                        <!-- TODO dans l'input pour le mappage, faire des checkboxs pour pouvoir séléctionner les jours de la semaine puis calculer le mappage en conséquence -->
                        <?php foreach (Planifications::$array_accepted_key as $key => $value): ?>
                              <?= $value['create_show'] ? "<h5>" . $value['title'] . "</h5>" :''?>
                              <div class="form-group">
                                                <input type="<?= $value['create_show'] ? ($value['type'] ?? "text") : "hidden" ?>"
                                                      name="<?= 'planifications_' . $key ?>" id="<?= $key ?>"
                                                      class="form-control" <?= $value['readonly'] ? "readonly='readonly'" : "" ?>
                                                      <?= $value['required'] ?? false ? 'required' : ''?>>
                              </div>
                        <?php endforeach ?>
                        <input type="submit" value="Ajouter">
                  </form>
            </div>
      </div>
      </div>
      </div>
</body>
<script src="/js/planifications_create.js" ></script>  
</html>