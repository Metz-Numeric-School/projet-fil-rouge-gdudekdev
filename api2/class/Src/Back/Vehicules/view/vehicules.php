<?php 

// faire la page qui affiche les vehicules de l\utilsaiteur, a voir si on va fetch les données relatives aux identifiants (name) de chaque marque couelur ... pour s'y retrouver plus facilement<?php

use Src\Entity\Vehicules;
include_once ROOT . "/view/template/header_template.php";
?>

<body>
      <div class="container">

            <div class="crud__header">
                  <div class="crud__header-cta">
                        <a href="index.php?page=accounts&id=<?= $account_id?>" class="crud__table-btn">
                              <\Retour </a>
                                    <a href="/index.php?page=vehicules&accounts_id=<?= $account_id?>&add" class="crud__table-btn crud__table-btn--edit">Ajouter</a>

                  </div>
                  <h2><?= ucfirst($title) ?></h2>

            </div>
            <div class="crud__main">
                  <table class="crud__table">
                        <tr>
                              <td class=" crud__table-cell crud__table-cell-header ">Actions</td>
                              <?php foreach (Vehicules::$array_accepted_key as $field):
                                    if ($field['crud_show']) { ?>
                                          <td class=" crud__table-cell crud__table-cell-header "> <?= $field['title'] ?></td>
                                    <?php } ?>
                              <?php endforeach ?>
                        </tr>
                        <?php foreach ($vehicules as $vehicule): 
                              $vehicule = new Vehicules($vehicule)?>
                              
                              <tr>
                                    <td class="crud__table-cell">
                                          <div class="crud__table-cta">
                                                <a href="index.php?page=vehicules&accounts_id=<?= $account_id?>&id=<?= $vehicule->id() ?>"
                                                      class="crud__table-btn crud__table-btn--edit">Voir le détail</a>
                                                <a href="index.php?page=handlers&table=vehicules&remove&id=<?= $vehicule->id() ?>"
                                                      class="crud__table-btn crud__table-btn--delete">X</a>
                                          </div>
                                    </td>
                                    <?php foreach (Vehicules::$array_accepted_key as $key => $value):  
                                          if ($value['crud_show']) { 
                                                $method = str_replace('vehicules_' , '', $key)?>
                                                <td class="crud__table-cell"><?= $vehicule->$method() ?></td>
                                          <?php } ?>
                                    <?php endforeach ?>
                              </tr>
                        <?php endforeach ?>
                  </table>
            </div>
      </div>
</body>

</html>