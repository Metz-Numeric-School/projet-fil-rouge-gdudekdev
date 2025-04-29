<?php
$title = "Page de détail du compte n° " . $recordset['accounts_id'];
include_once __DIR__ . "/../../../template/header_template.php";
$table = "accounts";

$array_accepted_key = [
      'accounts_id' => [
            'title'=>'Numéro d\'identifiant',
            ''
      ],
      'accounts_fullname' => 'Nom complet',
      'accounts_email' => 'Email',
      'accounts_birthday' => 'Date d\'anniversaire',
      'accounts_phone' => 'Numéro de téléphone',
      'accounts_created_at' => 'Date de création',
];
?>

<body>
      <div class="container">

            <div class="crud__header">
                  <a href="index.php?page=accounts" class="crud__back">
                        <\Retour </a>
                              <h2><?= ucfirst($title) ?></h2>
                              <a href="index.php?page=process&table=<?= $table ?>&mode=remove&id=<?= $recordset[$table . '_id'] ?>" class="crud__table-btn crud__table-btn--delete">Supprimer le compte</a>
            </div>
            <div class="crud__main">
                  <table class="crud__table">
                        <tr>
                              <?php foreach ($array_accepted_key as $field): ?>
                                    <td class=" crud__table-cell crud__table-cell-header "> <?= $field ?></td>
                              <?php endforeach ?>
                        </tr>
                        <tr>
                              <?php foreach ($array_accepted_key as $key => $value): ?>
                                    <td class="crud__table-cell"><?= $recordset[$key] ?></td>
                              <?php endforeach ?>
                        </tr>
                  </table>
            </div>
      </div>
</body>

</html>