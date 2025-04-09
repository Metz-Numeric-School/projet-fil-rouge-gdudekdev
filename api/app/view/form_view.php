<?php 
use Core\Class\Form;

$form = new Form("form.php?table={$_GET['table']}","POST",ucfirst($currentPage));
var_dump($obj);
 foreach($obj as $key=>$value){
      $form->input("text",$key,$value,(str_contains($key,'_id') ||str_contains($key,'created_at')) ? true : false);
 }
 $form->submit("Envoyer");
 $content = $form->render();

 include_once $_SERVER['DOCUMENT_ROOT'] . "/template/header_template.php";
?>

<style>
      input[readonly]:read-only{
            background-color: lightgray;
      }
</style>

<body>
      <h3>Formulaire pour les <?= $currentPage; ?></h3>    
      <?php echo $content ?>
</body>

</html>