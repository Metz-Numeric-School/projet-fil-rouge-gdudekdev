<?php

use Core\Class\Form;

$form = new Form("form.php?table={$_GET['table']}", "POST", ucfirst($currentPage));
foreach ($obj as $key => $value) {
      $form->input("text", $key, $value, ($key == 'id' || str_contains($key, '_at') || str_contains($key, '_id')) ? true : false);
}
$form->submit("Envoyer");
$content = $form->render();

include_once $_SERVER['DOCUMENT_ROOT'] . "/template/header_template.php";
?>

<body>
      <div class="container">
            <div class="form__header">
                  <a href="/app/model/crud.php?table=<?= $_GET['table'] ?>" class="crud__back">
                        <\Retour </a>
                              <h2>Formulaire pour les <?= $currentPage; ?></h2>
            </div>
            <div class="form__main">
                  <?php echo $content ?>
            </div>
      </div>
</body>

</html>