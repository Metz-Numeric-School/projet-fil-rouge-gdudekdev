<?php

use Src\Entity\Accounts;

$title = "Page de détail du compte n° " . $account->id();
include_once ROOT . "/view/template/header_template.php";
?>

<body>
      <div class="container">

            <div class="crud__header">
                  <a href="index.php?page=accounts" class="crud__back">
                        <\Retour </a>
                              <h2><?= ucfirst($title) ?></h2>
                              <a href="index.php?page=handlers&table=accounts&remove&id=<?= $account->id()?>" 
                                    class="crud__table-btn crud__table-btn--delete">Supprimer le compte</a>
                              <a href="" style="text-decoration: underline">Faire une demande de récupération de mot de
                                    passe</a>
            </div>
            <div class="form__main">
                  <form method="post" action="index.php?page=handlers&table=accounts">
                        <?php foreach (Accounts::$array_accepted_key as $key => $value): ?>
                              <?= $value['detail_show'] ? "<h5>" . $value['title'] . "</h5>" :''?>
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
                                                <input type="<?= $value['detail_show'] ? ($value['type'] ?? "text") : "hidden" ?>"
                                                      name="<?= 'accounts_' . $key ?>" id="<?= $key ?>" value="<?= $account->{$key}() ?>"
                                                      class="form-control" <?= $value['readonly'] ? "readonly='readonly'" : "" ?>>
                                          <?php } ?>
                                          
                              </div>
                        <?php endforeach ?>
                        <h5>Preferences</h5>
                        <div class="form-group">
                        <?php foreach($preferences as $preference):?>
                                                <div>
                                                      <input type="checkbox" 
                                                             id="<?= $preference['preferences_id']?>" 
                                                             name="preferences[]" 
                                                             value = "<?= $preference['preferences_id']?>"
                                                             <?= in_array($preference['preferences_id'],$account_preferences) ? 'checked' :''?> />
                                                      <label for="<?= $preference['preferences_id']?>"><?= $preference['preferences_name']?></label>
                                                </div>
                                                <?php endforeach;?>
                        </div>
                        <input type="submit" value="Mettre à jour" />
                  </form>
            </div>
      </div>
      </div>
      </div>
</body>

</html>