<?php

use App\Controller\Manager;

include_once $_SERVER['DOCUMENT_ROOT'] . "/template/header_template.php";
?>
<!-- TODO on pourrait considérer que certaines informations ne sont pas censés passer par l'admin, des messages, informations trop personnelles ou innaproprié,
 il faut donc introduire un statut sur chaque donnée pour controler l'affichage de ces derniers, avec un affichage conditionnel sur le statut de l'admin (son role) -->

<body>
      <div class="container">

            <div class="crud__header">
                  <a href="/app/model/index.php" class="crud__back">
                        <\Retour </a>
                              <h2>Page de gestion des <?= strtolower($title) ?></h2>

            </div>
            <div class="crud__main">
                  <a href="form.php?table=<?= $table ?>&mode=save" class="crud__table-btn crud__table-btn--edit crud__main--add">Ajouter</a>
                  <table class="crud__table">
                        <tr>
                              <td class=" crud__table-cell crud__table-cell-header ">Actions</td>
                              <?php foreach ($recordset[0] ?? [] as $key => $value): ?>
                                    <td class=" crud__table-cell crud__table-cell-header "> <?= $key ?></td>
                              <?php endforeach ?>
                        </tr>

                        <?php foreach ($recordset as $row):
                              $class = Manager::getInstance()->createObj($table, $row);
                              $data = $class->getData();
                        ?>
                              <tr>
                                    <td class="crud__table-cell">
                                          <div class="crud__table-cta">

                                                <a href="form.php?table=<?= $table ?>&mode=save&id=<?= $class->{$table . '_id'}() ?>" class="crud__table-btn crud__table-btn--edit">Modifier</a>
                                                <a href="form.php?table=<?= $table ?>&mode=remove&id=<?= $class->{$table . '_id'}() ?> " class="crud__table-btn crud__table-btn--delete">Suppprimer</a>
                                          </div>
                                    </td>
                                    <?php foreach ($data as $key => $value):
                                          if (str_contains($key, $table)) {
                                          }
                                    ?>
                                          <td class="crud__table-cell"><?= $class->{$key}() ?></td>
                                    <?php endforeach ?>

                              </tr>
                        <?php endforeach ?>

                  </table>
            </div>
      </div>
</body>

</html>