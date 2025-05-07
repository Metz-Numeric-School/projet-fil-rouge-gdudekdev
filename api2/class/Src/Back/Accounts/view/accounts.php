<?php

use Src\Entity\Accounts;
include_once ROOT . "/view/template/header_template.php";
?>

<body>
      <div class="container">

            <div class="crud__header">
                  <div class="crud__header-cta">
                        <a href="index.php?page=home" class="crud__back">
                              <\Retour </a>
                                    <a href="/index.php?page=accounts&add" class="crud__back">Ajouter</a>

                  </div>
                  <h2><?= ucfirst($title) ?></h2>

            </div>
            <div class="crud__main">
                  <table class="crud__table">
                        <tr>
                              <td class=" crud__table-cell crud__table-cell-header ">Actions</td>
                              <?php foreach (Accounts::$array_accepted_key as $field):
                                    if ($field['crud_show']) { ?>
                                          <td class=" crud__table-cell crud__table-cell-header "> <?= $field['title'] ?></td>
                                    <?php } ?>
                              <?php endforeach ?>
                        </tr>
                        <?php foreach ($accounts as $account): 
                              $account = new Accounts($account)?>
                              
                              <tr>
                                    <td class="crud__table-cell">
                                          <div class="crud__table-cta">
                                                <a href="index.php?page=accounts&id=<?= $account->id() ?>"
                                                      class="crud__table-btn crud__table-btn--edit">Voir le détail</a>
                                                <a href="index.php?page=handlers&table=accounts&remove&id=<?= $account->id() ?>"
                                                      class="crud__table-btn crud__table-btn--delete">X</a>
                                          </div>
                                    </td>
                                    <?php foreach (Accounts::$array_accepted_key as $key => $value):  
                                          if ($value['crud_show']) { 
                                                $method = str_replace('accounts_' , '', $key)?>
                                                <td class="crud__table-cell"><?= $account->$method() ?></td>
                                          <?php } ?>
                                    <?php endforeach ?>
                              </tr>
                        <?php endforeach ?>
                  </table>
            </div>
      </div>
</body>

</html>