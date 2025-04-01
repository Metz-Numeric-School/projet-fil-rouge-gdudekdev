
<?php 
require 'vendor/autoload.php';
$router = new App\Router\Router($_GET['url']);
$router->get('/',function(){echo "Homepage";});
$router->get('/post',function(){echo 'Tous les articles';});
$router->get('/post/:id',function($id){echo 'Afficher l\'article',$id;});
$router->post('/post/:id',function($id){echo 'Poster pour l\'article',$id;});

$router->run();