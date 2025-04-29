<?php
$title = "Page de détail du compte n° " . $recordset['accounts_id'];
include_once __DIR__ . "/../../../template/header_template.php";
$table = "accounts";

$array_accepted_key = [
      'accounts_id',
      'accounts_fullname',
      'accounts_email',
      'accounts_birthday',
      'accounts_phone',
      'accounts_created_at',
];
?>

<body>
      <div class="container">

            <div class="crud__header">
                  <a href="index.php?page=accounts" class="crud__back">
                        <\Retour </a>
                              <h2><?= ucfirst($title) ?></h2>

            </div>
            <div class="crud__main">
                  <table class="crud__table">
                        <tr>
                              <td class=" crud__table-cell crud__table-cell-header ">Actions</td>
                              <?php foreach ($array_accepted_key as $key): ?>
                                    <td class=" crud__table-cell crud__table-cell-header "> <?= $key ?></td>
                              <?php endforeach ?>
                        </tr>
                              <tr>
                                    <td class="crud__table-cell">
                                          <div class="crud__table-cta">
                                                <a href="index.php?page=process&table=<?= $table ?>&mode=save&id=<?= $recordset[$table . '_id'] ?>" class="crud__table-btn crud__table-btn--edit">Voir le détail</a>
                                                <a href="index.php?page=process&table=<?= $table ?>&mode=remove&id=<?= $recordset[$table . '_id'] ?>" class="crud__table-btn crud__table-btn--delete">X</a>
                                          </div>
                                    </td>
                                    <?php foreach ($recordset as $key => $value): 
                                                if(in_array($key,$array_accepted_key)){
                                          ?>
                                          <td class="crud__table-cell"><?= $value ?></td>
                                          <?php }?>
                                    <?php endforeach ?>
                              </tr>
                  </table>
            </div>
      </div>
</body>

</html>