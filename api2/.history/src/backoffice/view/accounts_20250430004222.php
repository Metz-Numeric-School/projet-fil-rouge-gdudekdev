<?php

$title = "Page de gestion Des Utilisateurs";
include_once __DIR__ . "/../../../template/header_template.php";
$table = "accounts"
?>

<body>
      <div class="container">

            <div class="crud__header">
                  <a href="index.php?page=home" class="crud__back">
                        <\Retour </a>
                              <h2><?= ucfirst($title) ?></h2>

            </div>
            <div class="crud__main">
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
                                          if (str_contains($key, '_id') &&  $value !=0 && str_replace('_id', '', $key) != $table) {
                                                $currentTable = str_replace('_id', '', $key);
                                    ?>
                                                <td class="crud__table-cell"><a href="index.php?page=crud-detail&table=<?= $currentTable ?>&id=<?= $value ?>" style="text-decoration : underline"><?= $value ?></a></td>
                                          <?php   } else { ?>
                                                <td class="crud__table-cell"><?= $value ?></td>
                                    <?php
                                          }

                                    endforeach ?>
                              </tr>
                        <?php endforeach ?>

                  </table>
            </div>
      </div>
</body>

</html>