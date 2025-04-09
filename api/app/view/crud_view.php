<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/app/class/User.php";
use App\class\User;

include_once $_SERVER['DOCUMENT_ROOT'] . "/template/header_template.php";
// TODO chercher à afficher l'interface crud pour n'importe quel table.
?>

<!-- supososns qu'on ait une table, quel quelle soit, on veut afficher cela : 
donner en PDO::FETCH_ASSOC a priori ,il faudrait changer le nom du fichier et passer une variable pour remplir le fichier
$recordset puisqu'il s'agit d'une lecture de la base de données 
Potentiellement créer un fichier config avec le nom de toutes les tables plus les jointures associés à des noms pour les titres idk
-->

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
                              // TODO changer le new pour matcher la class qui se fait Manager
                                    $user = new User($row);
                              ?>
                                    <tr>
                                          <?php foreach ($row as $key => $value):
                                          if(str_contains($key,$table)){
                                                $key = str_replace($table.'_','',$key);
                                          }
                                          ?>
                                                <td><?= $user->{$key}() ?></td>
                                          <?php endforeach ?>
                                          <td>
                                                <a href="form.php?table=<?= $table ?>&mode=save&id=<?= $user->id()?>">Modifier</a>
                                                <a href="form.php?table=<?= $table ?>&mode=remove&id=<?= $user->id()?>">Suppprimer</a>
                                          </td>
                                    </tr>
                              <?php endforeach ?>

                        </table>
                  </div>
                  <!-- jusqu'ici -->
</body>

</html>