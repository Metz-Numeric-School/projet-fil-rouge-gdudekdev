<?php

$title = "Page de gestion des Utilisateurs";
include_once $_SERVER['DOCUMENT_ROOT'] . "/../template/header_template.php";
$table = "accounts";

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
                              <?php foreach (A as $field): ?>
                                    <td class=" crud__table-cell crud__table-cell-header "> <?= $field ?></td>
                              <?php endforeach ?>
                        </tr>
                        <?php foreach ($recordset as $row): ?>
                              <tr>
                                    <td class="crud__table-cell">
                                          <div class="crud__table-cta">
                                                <a href="index.php?page=accounts&id=<?= $row[$table . '_id']?>" class="crud__table-btn crud__table-btn--edit">Voir le détail</a>
                                                <a href="index.php?page=process&table=<?= $table ?>&mode=remove&id=<?= $row[$table . '_id'] ?>" class="crud__table-btn crud__table-btn--delete">X</a>
                                          </div>
                                    </td>
                                    <?php foreach ($array_accepted_key as $key=>$value): ?>
                                          <td class="crud__table-cell"><?= $row[$key] ?></td>
                                    <?php endforeach ?>
                              </tr>
                        <?php endforeach ?>
                  </table>
            </div>
      </div>
</body>

</html>