<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/protect.php";

$recordset = Database::getInstance()->getAllFrom('users');

?>

<!DOCTYPE html>
<html lang="fr">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Utilisateurs</title>
</head>

<body>
      <a href="/pages/index.php">
            <\Retour </a>
                  <h2>Page de gestion des utilisateurs</h2>
                  <a href="form.php?table=users">Ajouter un utilisateur</a>
                  <div class="users__main">
                        <table>
                              <tr>
                                    <td>id</td>
                                    <td>name</td>
                                    <td>username</td>
                                    <td>password</td>
                                    <td>created_at</td>
                              </tr>

                              <?php foreach ($recordset as $row):
                                    $user = new User($row);
                              ?>
                                    <tr>
                                          <?php foreach ($row as $key => $value): 
                                                ?>
                                                <td><?= $user->{$key}() ?></td>
                                          <?php endforeach ?>
                                          <td>
                                                <a href="form.php?table=users&id=<?= $user->id()?>">Modifier</a>
                                                <a href="delete.php?table=users&id=<?= $user->id() ?>">Suppprimer</a>
                                          </td>
                                    </tr>
                              <?php endforeach ?>

                        </table>
                  </div>
</body>

</html>