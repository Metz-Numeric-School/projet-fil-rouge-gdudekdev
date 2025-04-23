<?php

$title = "Page Crud";
include_once __DIR__ . "/../../../template/header_template.php";

?>

<body>
      <div class="container">

            <div class="crud__header">
                  <a href="index.php?page=home" class="crud__back">
                        <\Retour </a>
                              <h2>Page de gestion des <?= strtolower($title) ?></h2>

            </div>
            <div class="crud__main">
                  <a href="index.php?page=process&table=<?= $table ?>&mode=save" class="crud__table-btn crud__table-btn--edit crud__main--add">Ajouter</a>
                  <table class="crud__table">
                        <tr>
                              <td class=" crud__table-cell crud__table-cell-header ">Actions</td>
                              <?php foreach ($recordset[0] ?? [] as $key => $value): ?>
                                    <td class=" crud__table-cell crud__table-cell-header "> <?= $key ?></td>
                              <?php endforeach ?>
                        </tr>

                        <?php foreach ($recordset as $row): ?>
                              <tr>
                                    <td class="crud__table-cell">
                                          <div class="crud__table-cta">

                                                <a href="index.php?page=process&table=<?= $table ?>&mode=save&id=<?= $row[$table . '_id'] ?>" class="crud__table-btn crud__table-btn--edit">Modifier</a>
                                                <a href="index.php?page=process&table=<?= $table ?>&mode=remove&id=<?= $row[$table . '_id'] ?>" class="crud__table-btn crud__table-btn--delete">Suppprimer</a>
                                          </div>
                                    </td>
                                    <?php foreach ($row as $key => $value):
                                    ?>
                                          <td class="crud__table-cell"><?= $value ?></td>
                                    <?php endforeach ?>
                              </tr>
                        <?php endforeach ?>

                  </table>
            </div>
      </div>
</body>

</html>