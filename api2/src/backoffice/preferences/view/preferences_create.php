<?php

use Back\Preferences\PreferencesModel;

var_dump($recordset);
$title = "Page de création d'une préférence utilisateur";
include_once $_SERVER['DOCUMENT_ROOT'] . "/../template/header_template.php";
?>

<body>
      <div class="container">

            <div class="crud__header">
                  <a href="index.php?page=<?= $table ?>" class="crud__back">
                        <\Retour </a>
                              <h2><?= ucfirst($title) ?></h2>
            </div>
            <div class="crud__main">
                  <div class="form__main">
                        <form method="post" action="index.php?page=process&table=<?= $table ?>&mode=save">

                              <?php foreach (PreferencesModel::array_accepted_key as $key => $value):
                                    if ($value['create_show']) { ?>
                                          <h5><?= $value['title'] ?></h5>
                                    <?php } ?>
                                    <div class="form-group">
                                          <input
                                                type="<?= $value['create_show'] ? ($value['type'] ?? "text") : "hidden" ?>"
                                                name="<?= $key ?>"
                                                id="<?= $key ?>"
                                                value="<?= $recordset[$table][$key] ?>"
                                                class="form-control"
                                                <?= $value['readonly'] ? "readonly='readonly'" : "" ?> />
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