<!DOCTYPE html>
<html lang="fr">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Formulaire CRUD <?= $currentPage; ?></title>
</head>
<style>
      input[readonly]:read-only{
            background-color: lightgray;
      }
</style>

<body>
      <h3>Formulaire pour les <?= $currentPage; ?></h3>    


      <fieldset>
            <form action="/include/form_process.php" method="post">
                  <?php foreach($obj as $key=>$value):?>
                  <label for="<?= $key;?>">
                        <?= ucfirst($key) .':   '?>
                        <br>
                        <input type="text" id="<?= $key;?>" value="<?= $value;?>" name='<?= $key; ?>' <?= ($key=='id' ||$key=='created_at') ? "readonly='readonly'" : '' ?>>
                  </label>
                  <br>
                  <?php endforeach?>
                  <input type="hidden" name="form" value="<?= $_GET['table']; ?>">
                  <input type="submit" value="Envoyer">
            </form>
      </fieldset>
</body>

</html>