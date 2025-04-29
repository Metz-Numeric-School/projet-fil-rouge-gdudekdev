<?php

$title = "Page de gestion des Utilisateurs";
include_once __DIR__ . "/../../../template/header_template.php";
$table = "accounts";

$array_accepted_key = [
      'accounts_id',
      'accounts_fullname',
      'accounts_email',
];
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
                              <?php foreach ($recordset[0] ?? [] as $key => $value): 
                                    if(in_array($key,$array_accepted_key)){;
                                    ?>
                                    <td class=" crud__table-cell crud__table-cell-header "> <?= $key ?></td>
                                    <?php }?>
                              <?php endforeach ?>
                        </tr>

                        <?php foreach ($recordset as $row): ?>
                              <tr>
                                    <td class="crud__table-cell">
                                          <div class="crud__table-cta">
                                                <a href="index.php?page=process&table=<?= $table ?>&mode=save&id=<?= $row[$table . '_id'] ?>" class="crud__table-btn crud__table-btn--edit">Voir le détail</a>
                                                <a href="index.php?page=process&table=<?= $table ?>&mode=remove&id=<?= $row[$table . '_id'] ?>" class="crud__table-btn crud__table-btn--delete">X</a>
                                          </div>
                                    </td>
                                    <?php foreach ($row as $key => $value): 
                                                if(in_array)
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