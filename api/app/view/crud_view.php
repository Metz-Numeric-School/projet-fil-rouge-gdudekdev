<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/app/class/User.php";
use App\Controller\Manager;

include_once $_SERVER['DOCUMENT_ROOT'] . "/template/header_template.php";
?>

<!-- supososns qu'on ait une table, quel quelle soit, on veut afficher cela : 
donner en PDO::FETCH_ASSOC a priori ,il faudrait changer le nom du fichier et passer une variable pour remplir le fichier
$recordset puisqu'il s'agit d'une lecture de la base de données 
Potentiellement créer un fichier config avec le nom de toutes les tables plus les jointures associés à des noms pour les titres idk
-->
<!-- TODO on pourrait considérer que certaines informations ne sont pas censés passer par l'admin, des messages, informations trop personnelles ou innaproprié,
 il faut donc introduire un statut sur chaque donnée pour controler l'affichage de ces derniers, avec un affichage conditionnel sur le statut de l'admin (son role) -->

<body>
      <a href="/app/model/index.php">
            <\Retour </a>
                  <!-- il faudrait que le Manager gère le code d'ici , avec $table a priori -->
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
                                                $key = str_replace($table.'_','',$key);
                                          }
                                          ?>
                                                <td><?= $class->{$key}() ?></td>
                                          <?php endforeach ?>
                                          <td>
                                                <a href="form.php?table=<?= $table ?>&mode=save&id=<?= $class->id()?>">Modifier</a>
                                                <a href="form.php?table=<?= $table ?>&mode=remove&id=<?= $class->id()?>">Suppprimer</a>
                                          </td>
                                    </tr>
                              <?php endforeach ?>

                        </table>
                  </div>
                  <!-- jusqu'ici -->
</body>

</html>