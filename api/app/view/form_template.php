<?php 
use Core\Class\Form;

$form = new Form("/pages/crud.php?table={$_GET['table']}","post",ucfirst($currentPage));

 foreach($obj as $key=>$value){
      $form->input("text",$key,$value,($key=='id' ||$key=='created_at') ? true : false);
 }
 $form->hidden("form",$_GET['table']);
 $form->submit("Envoyer");
 $content = $form->render();

 include_once "../template/header_template.php";
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