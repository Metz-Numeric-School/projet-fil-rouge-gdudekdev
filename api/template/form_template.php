<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/autoloader.php";

$form = new Form("/include/form_process.php","post",ucfirst($currentPage));

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