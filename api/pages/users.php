<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/protect.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/class/Database.php";


$db = Database::getInstance();
$recordset = $db->getAllFrom('users');

?>

<!DOCTYPE html>
<html lang="fr">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Utilisateurs</title>
</head>
<body> 
      <a href="/pages/index.php"><\Retour </a>  
      <h2>Page de gestion des utilisateurs</h2>

      <div class="users__main">
            <table>
                  <tr>
                        <?php foreach($recordset[0] as $key=>$value):?>
                              <td><?= htmlspecialchars($key) ?></td>
                        <?php endforeach?>
                  </tr>

                  <?php foreach($recordset as $row):?>
                        <tr>
                              <?php foreach($row as $key=>$value):?>
                              <td><?= htmlspecialchars($value) ?></td>
                              <?php endforeach?>
                        </tr>
                  <?php endforeach?>

            </table>
      </div>
</body>
</html>