<?php

use Src\Entity\Divisions;
use Src\Entity\Entreprises;


$title = "Page de détail de l'entreprise " . $entreprise->name();
include_once ROOT . "/view/template/header_template.php";
?>

<body>
      <div class="container">

            <div class="crud__header">
                  <div class="crud__header-cta">
                        <a href="index.php?page=entreprises" class="crud__table-btn">
                              <\Retour </a>
                                    <a href="index.php?page=entreprises&remove&id=<?= $entreprise->id() ?>"
                                          class="crud__table-btn crud__table-btn--delete">Supprimer</a>
                  </div>
                  <h2><?= ucfirst($title) ?></h2>
            </div>
            <div class="form__main">
                  <form method="post" action="index.php?page=entreprises&mode=up">
                        <?php foreach (Entreprises::$array_accepted_key as $key => $value): ?>
                              <?= $value['detail_show'] ? "<h5>" . $value['title'] . "</h5>" : '' ?>
                              <div class="form-group">
                                    <input type="<?= $value['detail_show'] ? ($value['type'] ?? "text") : "hidden" ?>"
                                    name="<?= 'entreprises_' . $key ?>" id="<?= $key ?>" value="<?= $entreprise->{$key}() ?>"
                                          class="form-control" <?= $value['readonly'] ? "readonly='readonly'" : "" ?>>

                              </div>
                        <?php endforeach ?>
                        <input type="submit" value="Mettre à jour" />
                  </form>
            </div>
            <div class="form__main">
                  <h5>Divisions de l'entreprise</h5>
                  <form method="post" action="index.php?page=divisions&mode=add&id=<?= $entreprise->id()?>">
                        <div class="form-group">
                              <input type="submit" value="Ajouter">
                              <input type="text" placeholder="Nom de la nouvelle division" name="divisions_name">
                              <input type="hidden" name="entreprises_id" value="<?= $entreprise->id()?>">
                        </div>
                  </form>
                  <div class="crud__main">
                        <table class="crud__table">
                              <tr>
                                    <td class=" crud__table-cell crud__table-cell-header ">Actions</td>
                                    <?php foreach (Divisions::$array_accepted_key as $field):
                                          if ($field['crud_show']) { ?>
                                                <td class=" crud__table-cell crud__table-cell-header "> <?= $field['title'] ?>
                                                </td>
                                          <?php } ?>
                                    <?php endforeach ?>
                              </tr>
                              <?php foreach ($division as $div):
                                    $div = new Divisions($div) ?>

                                    <tr>
                                          <td class="crud__table-cell">
                                                <div class="crud__table-cta">
                                                      <a href="index.php?page=divisions&mode=remove&id=<?= $div->id() ?>&entreprises_id=<?= $entreprise->id()?>"
                                                            class="crud__table-btn crud__table-btn--delete">X</a>
                                                </div>
                                          </td>
                                          <?php foreach (Divisions::$array_accepted_key as $key => $value):
                                                if ($value['crud_show']) {
                                                      $method = str_replace('divisions_', '', $key) ?>
                                                      <td class="crud__table-cell"><?= $div->$method() ?></td>
                                                <?php } ?>
                                          <?php endforeach ?>
                                    </tr>
                              <?php endforeach ?>
                        </table>
                  </div>
            </div>
      </div>
      </div>
      </div>
</body>

</html>