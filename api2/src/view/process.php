<?php

$title = "Process";
include_once __DIR__ . "/../../template/header_template.php";
?>

<body>
      <div class="container">
            <div class="form__header">
                  <a href="index.php?page=crud&table=<?= $table ?>" class="crud__back">
                        <\ Retour
                              </a>
                              <h2>Formulaire pour la table <?= $table; ?></h2>
            </div>
            <div class="form__main">
                  <form method="post" action="index.php?page=process&table=<?= $table?>&mode=save">
                        <?php foreach ($recordset as $key => $value):
                              $label = ucwords(str_replace('_', ' ', preg_replace('/^accounts_/', '', $key)));

                              if (preg_match('/_at$/', $key)) {
                                    $type = 'datetime-local';
                                    $value = str_replace(' ', 'T', $value);
                              } elseif (preg_match('/_birthday$/', $key)) {
                                    $type = 'date';
                              } elseif (preg_match('/email/', $key)) {
                                    $type = 'email';
                              } elseif (preg_match('/password/', $key)) {
                                    $type = 'password';
                              } elseif (is_numeric($value) && strlen($value) < 10) {
                                    $type = 'number';
                              } else {
                                    $type = 'text';
                              }

                              if (preg_match('/_id$/', $key) && (int)$value === 0) {
                                    continue;
                              }
                        ?>
                              <div class="form-group">
                                    <label for="<?= $key ?>"><?= $label ?></label>
                                    <input
                                          type="<?= $type ?>"
                                          name="<?= $key ?>"
                                          id="<?= $key ?>"
                                          value="<?= htmlspecialchars($value) ?>"
                                          class="form-control">
                              </div>
                              <br>
                        <?php endforeach; ?>

                        <button type="submit" class="btn btn-primary">Envoyer</button>
                  </form>
            </div>
      </div>
</body>

</html>