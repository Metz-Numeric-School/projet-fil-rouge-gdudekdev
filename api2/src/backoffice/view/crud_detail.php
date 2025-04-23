<?php

$title = "Page Crud";
include_once __DIR__ . "/../../../template/header_template.php";

?>

<body>
      <div class="container">

            <div class="crud__header">
                  <a href="javascript:history.back()" class="crud__back">
                        <\Retour </a>
                              <h2>Page de gestion des <?= strtolower($title) ?></h2>

            </div>
            <div class="crud__main">
                  <a href="index.php?page=process&table=<?= $table ?>&mode=save" class="crud__table-btn crud__table-btn--edit crud__main--add">Ajouter</a>
                  <table class="crud__table">
                        <tr>
                              <?php foreach ($recordset as $key => $value): ?>
                                    <td class=" crud__table-cell crud__table-cell-header "> <?= $key ?></td>
                              <?php endforeach ?>
                        </tr>

                        <tr>
                              <?php foreach ($recordset as $field): ?>
                                    <td class="crud__table-cell"><?=  in_array($field,['',null]) ? 'none': $field ?></td>
                              <?php endforeach ?>
                        </tr>

                  </table>
            </div>
      </div>
</body>

</html>