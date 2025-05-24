<?php

use Src\Entity\Entreprises;

include_once ROOT . "/view/template/header_template.php";
?>

<body>
      <div class="container">

            <div class="crud__header">
                  <div class="crud__header-cta">
                        <a href="index.php?page=home" class="crud__table-btn">
                              <\Retour </a>
                                    <a href="/index.php?page=entreprises&add" class="crud__table-btn crud__table-btn--edit">Ajouter</a>

                  </div>
                  <h2><?= ucfirst($title) ?></h2>

            </div>
            <div class="crud__main">
                  <table class="crud__table">
                        <tr>
                              <td class=" crud__table-cell crud__table-cell-header ">Actions</td>
                              <?php foreach (Entreprises::$array_accepted_key as $field):
                                    if ($field['crud_show']) { ?>
                                          <td class=" crud__table-cell crud__table-cell-header "> <?= $field['title'] ?></td>
                                    <?php } ?>
                              <?php endforeach ?>
                        </tr>
                        <?php foreach ($entreprises as $entreprise): 
                              $entreprise = new Entreprises($entreprise)?>
                              
                              <tr>
                                    <td class="crud__table-cell">
                                          <div class="crud__table-cta">
                                                <a href="index.php?page=entreprises&id=<?= $entreprise->id() ?>"
                                                      class="crud__table-btn crud__table-btn--edit">Voir le détail</a>
                                                <a href="index.php?page=entreprises&mode=remove&id=<?= $entreprise->id() ?>"
                                                      class="crud__table-btn crud__table-btn--delete">X</a>
                                          </div>
                                    </td>
                                    <?php foreach (Entreprises::$array_accepted_key as $key => $value):  
                                          if ($value['crud_show']) { 
                                                $method = str_replace('entreprises_' , '', $key)?>
                                                <td class="crud__table-cell"><?= $entreprise->$method() ?></td>
                                          <?php } ?>
                                    <?php endforeach ?>
                              </tr>
                        <?php endforeach ?>
                  </table>
            </div>
      </div>
</body>

</html>