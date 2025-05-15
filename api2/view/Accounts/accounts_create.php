<?php

use Src\Entity\Accounts;
use Src\Entity\Entreprises;
use Src\Entity\Roles;

$title = "Page de création d'un compte";
include_once ROOT . "/view/template/header_template.php";
?>
<script>
const allDivisions = <?= json_encode($divisions) ?>;
</script>
<body>
      <div class="container">

            <div class="crud__header">
                  <div class="crud__header-cta">
                        <a href="index.php?page=accounts" class="crud__table-btn">
                              <\Retour </a>
                  </div>
                              <h2><?= ucfirst($title) ?></h2>
            </div>
            <div class="form__main">
                  <form method="post" action="index.php?page=accounts&mode=add">
                        <?php foreach (Accounts::$array_accepted_key as $key => $value): ?>
                              <?= $value['create_show'] ? "<h5>" . $value['title'] . "</h5>" :''?>
                              <div class="form-group">
                                                <input type="<?= $value['create_show'] ? ($value['type'] ?? "text") : "hidden" ?>"
                                                      name="<?= 'accounts_' . $key ?>" id="<?= $key ?>" value="<?= $account->{$key}() ?>"
                                                      class="form-control" <?= $value['readonly'] ? "readonly='readonly'" : "" ?>
                                                      <?= $value['required'] ?? false ? 'required' : ''?>>
                              </div>
                        <?php endforeach ?>
                        <h5>Roles</h5>
                        <div class="form-group">
                        <select name="roles_id" id="roles" class="form-control">
                                                      <?php foreach ($roles as $raw):
                                                                  $role = new Roles($raw);
                                                            ?>
                                                             <option value="<?= $role->id()?>"
                                                                        <?= $role->id() === $account->roles_id() ? 'selected' : '' ?>>
                                                                        <?= $role->name() ?>
                                                                        </option>
                                                      <?php endforeach; ?>
                                                </select>
                        </div>
                        <h5>Entreprises</h5>
                        <div class="form-group">
                        <select id="account_entreprises" class="form-control" >
                                                      <?php foreach ($entreprises as $raw):
                                                                  $entreprise = new Entreprises($raw);
                                                            ?>
                                                             <option value="<?= $entreprise->id()?>"
                                                                        >
                                                                        <?= $entreprise->name() ?>
                                                                        </option>
                                                      <?php endforeach; ?>
                                                </select>
                        </div>
                        <h5>Divisions</h5>
                        <div class="form-group">
                        <select name="divisions_id" id="divisions" class="form-control" required></select>
                        </div>
                        <input type="submit" value="Mettre à jour" />
                  </form>
            </div>
      </div>
      </div>
      </div>
</body>
<script src="/js/accounts_create.js" ></script>  
</html>