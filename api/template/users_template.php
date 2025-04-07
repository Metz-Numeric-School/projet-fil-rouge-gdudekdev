<?php 
include_once "../template/header_template.php";
// TODO chercher à afficher l'interface crud pour n'importe quel table.
?>
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
                                                <a href="form.php?table=users&id=<?= $user->id() ?>">Modifier</a>
                                                <a href="../include/form_process.php?delete=true&table=users&id=<?= $user->id() ?>">Suppprimer</a>
                                          </td>
                                    </tr>
                              <?php endforeach ?>

                        </table>
                  </div>
</body>

</html>