<?php

use Back\Preferences\PreferencesModel;

$title = "Page de détail de la preférence n° " . $recordset['preferences']['preferences_id'];
include_once $_SERVER['DOCUMENT_ROOT'] . "/../template/header_template.php";
?>
<!-- TODO mettre tous les champs dans une grid pour bien les espacer (enlever les br)-->

<body>
      <div class="container">

            <div class="crud__header">
                  <a href="index.php?page=preferences" class="crud__back">
                        <\Retour </a>
                              <h2><?= ucfirst($title) ?></h2>
                              <a href="index.php?page=process&table=<?= $table ?>&mode=remove&id=<?= $recordset[$table][$table . '_id'] ?>" class="crud__table-btn crud__table-btn--delete">Supprimer la préférence</a>
                              <a href="" style="text-decoration: underline">Faire une demande de récupération de mot de passe</a>
            </div>
            <a href="">Voir les préférences</a>
            <div class="form__main">

                  <div class="form__group">
                        <form method="post" action="index.php?page=process&table=<?= $table ?>&mode=save">
                              <?php foreach (PreferencesModel::array_accepted_key as $key => $value):
                                    if ($value['detail_show']) { ?>
                                          <!-- TODO regler le probleme de l'affichage pour les input hidden -->
                                          <h5><?= $value['title'] ?></h5>
                                    <?php } ?>
                                    <div class="form-group">
                                          <input
                                                type="<?= $value['detail_show'] ? ($value['type'] ?? "text") : "hidden" ?>"
                                                name="<?= $key ?>"
                                                id="<?= $key ?>"
                                                value="<?= $recordset[$table][$key] ?>"
                                                class="form-control"
                                                <?= $value['readonly'] ? "readonly='readonly'" : "" ?> />
                                    </div>
                                    <br>
                              <?php endforeach ?>
                        </form>
                  </div>



</body>

</html>