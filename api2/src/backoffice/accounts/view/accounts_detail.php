<?php

use Back\Accounts\Model\AccountsModel;

$title = "Page de détail du compte n° " . $recordset['accounts']['accounts_id'];
include_once $_SERVER['DOCUMENT_ROOT'] . "/../template/header_template.php";
$table = "accounts";
$roles = $recordset['roles'];
$divisions = $recordset['divisions'];
$recordset = $recordset['accounts'];

?>
<!-- TODO mettre tous les champs dans une grid pour bien les espacer (enlever les br)-->

<body>
      <div class="container">

            <div class="crud__header">
                  <a href="index.php?page=accounts" class="crud__back">
                        <\Retour </a>
                              <h2><?= ucfirst($title) ?></h2>
                              <a href="index.php?page=process&table=<?= $table ?>&mode=remove&id=<?= $recordset[$table . '_id'] ?>" class="crud__table-btn crud__table-btn--delete">Supprimer le compte</a>
                              <a href="" style="text-decoration: underline">Faire une demande de récupération de mot de passe</a>
            </div>
            <div class="crud__main">
                  <div class="form__main">
                        <form method="post" action="index.php?page=process&table=<?= $table ?>&mode=save">
                              <?php foreach (AccountsModel::array_accepted_key as $key => $value):
                                    if ($value['detail_show']) { ?>

                                          <h5><?= $value['title'] ?></h5>
                                    <?php } ?>
                                    <div class="form-group">
                                          <input
                                                type="<?= $value['detail_show'] ? ($value['type'] ?? "text") : "hidden" ?>"
                                                name="<?= $key ?>"
                                                id="<?= $key ?>"
                                                value="<?= $recordset[$key] ?>"
                                                class="form-control"
                                                <?= $value['readonly'] ? "readonly='readonly'" : "" ?> />
                                    </div>
                                    <br>
                              <?php endforeach ?>
                              <h5>Role</h5>
                              <select name="roles_id" id="roles" class="form-control">
                                    <?php foreach ($roles as $role): ?>
                                          <option value="<?= htmlspecialchars($role['roles_id']) ?>" <?= ($role['roles_id'] === $recordset['roles_id']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($role['roles_name']) ?>
                                          </option>
                                    <?php endforeach; ?>
                              </select>
                              <br>
                              <h5>Département de travail</h5>
                              <select name="divisions_id" id="divisions" class="form-control">+
                                    <?php foreach ($divisions as $division): ?>
                                          <option value="<?= htmlspecialchars($division['divisions_id']) ?>" <?= ($division['divisions_id'] === $recordset['divisions_id']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($division['divisions_name']) ?>
                                          </option>
                                    <?php endforeach; ?>
                              </select>
                              <br>
                              <button type="submit" class="btn btn-primary">Envoyer</button>
                        </form>

                        </table>
                  </div>
            </div>
</body>

</html>