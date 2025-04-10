<?php
use App\Controller\Manager;

include_once $_SERVER['DOCUMENT_ROOT'] . "/template/header_template.php";
?>
<!-- TODO on pourrait considérer que certaines informations ne sont pas censés passer par l'admin, des messages, informations trop personnelles ou innaproprié,
 il faut donc introduire un statut sur chaque donnée pour controler l'affichage de ces derniers, avec un affichage conditionnel sur le statut de l'admin (son role) -->
<!-- TODO faire en sorte que ça remarche et essaie de debug le champ id du formulaire qui ne passe pas en readonly -->
<body>
      <a href="/app/model/index.php">
            <\Retour </a>
                  <h2>Page de gestion des <?= strtolower($title) ?></h2>
                  <a href="form.php?table=<?= $table ?>&mode=save">Ajouter</a>
                  <div class="users__main">
                        <table>
                              <tr>
                                    <?php foreach ($recordset[0]??[] as $key=>$value): ?>
                                          <td> <?= $key ?></td>
                                    <?php endforeach ?>
                              </tr>

                              <?php foreach ($recordset as $row):
                                    $class = Manager::getInstance()->createObj($table,$row);
                                    $data = $class->getData();
                              ?>
                                    <tr>
                                          <?php foreach ($data as $key => $value):
                                          if(str_contains($key,$table)){
                                          }
                                          ?>
                                                <td><?= $class->{$key}() ?></td>
                                          <?php endforeach ?>
                                          <td>
                                                <a href="form.php?table=<?= $table ?>&mode=save&id=<?= $class->{$table . '_id'}()?>">Modifier</a>
                                                <a href="form.php?table=<?= $table ?>&mode=remove&id=<?= $class->{$table . '_id'}()?>">Suppprimer</a>
                                          </td>
                                    </tr>
                              <?php endforeach ?>

                        </table>
                  </div>
</body>

</html>