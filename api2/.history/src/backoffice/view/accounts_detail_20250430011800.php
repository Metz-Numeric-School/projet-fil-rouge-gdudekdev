<?php
$title = "Page de détail du compte n° " . $recordset['accounts_id'];
include_once __DIR__ . "/../../../template/header_template.php";
$table = "accounts";

$array_accepted_key = [
      'accounts_id' => [
            'title' => 'Numéro d\'identifiant',
            'readonly' => true,
      ],
      'accounts_fullname' => [
            'title' => 'Nom complet',
            'readonly' => false,
      ],
      'accounts_email' => [
            'title' => 'Email',
            'readonly' => true,
      ],
      'accounts_birthday' => [
            'title' => 'Date d\'anniversaire',
            'readonly' => true,
      ],
      'accounts_phone' => [
            'title' => 'Numéro de téléphone',
            'readonly' => true,
      ],
      'accounts_created_at' => [
            'title' => 'Date de création',
            'readonly' => true,
      ],
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
                  <div class="form__main">
                        <form method="post" action="index.php?page=process&table=<?= $table ?>&mode=save">
                              <?php foreach ($array_accepted_key as $key => $value): ?>
                                    <div class="form-group">
                                          <h5><?= $value['title']?></h5>
                                          <input
                                                name="<?= $key ?>"
                                                id="<?= $key ?>"
                                                value="<?= $recordset[$key] ?>"
                                                class="form-control"
                                                readonly=<?=  $value['readonly'] ? "readonly" : "false"?> />
                                    </div>
                                    <br>
                              <?php endforeach ?>
                              <button type="submit" class="btn btn-primary">Envoyer</button>
                        </form>

                        </table>
                  </div>
            </div>
</body>

</html>