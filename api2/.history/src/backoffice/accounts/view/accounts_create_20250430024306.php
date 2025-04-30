<?php

use Back\Accounts\Model\AccountsModel;

$title = "Page de création d'un compte";
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
            </div>
            <div class="crud__main">
                  <div class="form__main">
                        <form method="post" action="index.php?page=process&table=<?= $table ?>&mode=save">

                              <?php foreach (AccountsModel::array_accepted_key as $key => $value): 
                                    if($value['create_show']){?>
                                    <div class="form-group">
                                          <h5><?= $value['title'] ?></h5>
                                          <input
                                                type="<?= $value['create_show'] ? ($value['type'] ?? "text") : "hidden" ?>"
                                                name="<?= $key ?>"
                                                id="<?= $key ?>"
                                                value="<?= $recordset[$key] ?>"
                                                class="form-control"
                                                <?= $value['readonly'] ? "readonly='readonly'" : "" ?> />
                                    </div>
                                    <br>
                                    <?php }?>
                              <?php endforeach ?>

                              <!-- Gestion des clés étrangères -->
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
                              <input type="hidden" name="test" value="toto">
                              <!-- TODO gerer les trajets -->
                              <button type="submit" class="btn btn-primary">Envoyer</button>
                        </form>

                        </table>
                  </div>
            </div>
</body>

</html>