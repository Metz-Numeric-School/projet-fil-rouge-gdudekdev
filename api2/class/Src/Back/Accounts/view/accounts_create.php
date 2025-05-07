<?php

use Src\Entity\Accounts;

$title = "Page de création d'un compte";
include_once ROOT . "/view/template/header_template.php";
var_dump($account->created_at());

?>

<body>
      <div class="container">

            <div class="crud__header">
                  <a href="index.php?page=accounts" class="crud__back">
                        <\Retour </a>
                              <h2><?= ucfirst($title) ?></h2>
            </div>
            <div class="form__main">
                  <form method="post" action="index.php?page=handlers&table=accounts">
                        <?php foreach (Accounts::$array_accepted_key as $key => $value): ?>
                              <?= $value['create_show'] ? "<h5>" . $value['title'] . "</h5>" :''?>
                              <div class="form-group">
                                          <?php if (str_contains($key, "_id") && $key !=='preferences_id') { ?>
                                                <select name="<?= $key?>" id="<?= $key?>" class="form-control">
                                                      <?php $key = str_replace('_id', '', $key);
                                                            foreach ($$key as $value):
                                                                  $class = '\Src\Entity\\' . ucfirst($key);
                                                                  $obj = new $class($value);
                                                            ?>
                                                             <option value="<?= $obj->id()?>"
                                                                        <?= ($obj->id() === $account->{$key .'_id'}()) ? 'selected' : '' ?>>
                                                                        <?= $obj->name() ?>
                                                                        </option>
                                                      <?php endforeach; ?>
                                                </select>
                                          <?php } else { ?>
                                                <input type="<?= $value['create_show'] ? ($value['type'] ?? "text") : "hidden" ?>"
                                                      name="<?= 'accounts_' . $key ?>" id="<?= $key ?>" value="<?= $account->{$key}() ?>"
                                                      class="form-control" <?= $value['readonly'] ? "readonly='readonly'" : "" ?>
                                                      <?= $value['required'] ?? false ? 'required' : ''?>>
                                          <?php } ?>
                              </div>
                        <?php endforeach ?>
                        <input type="submit" value="Mettre à jour" />
                  </form>
            </div>
      </div>
      </div>
      </div>
</body>

</html>