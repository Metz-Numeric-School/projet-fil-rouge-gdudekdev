<?php

use App\class\User;
use App\Controller\UserManager;
use Core\Class\Auth;

Auth::getInstance()->protect();
//  TODO mettre le tout dans un Manager et renvoyer le Post sur lui meme

// Processus d'ajout et de modification
if (isset($_POST['form'])) {
      // TODO lorsqu'il y aura plus de table à gerer, il faudrait pouvoir récupérer des données d'autres formulaires et donc éviter de mettre des if partout 
      if ($_POST['form'] == 'users') {
            $user = new User(User::setData($_POST));
            UserManager::getInstance()->save($user);
            header("Location: /pages/users.php");
            exit();
      }
}

// Processus de suppresion d'un élément d'une table
if (isset($_GET['delete']) && isset($_GET['id']) && isset($_GET['table']) && $_GET['delete'] == true) {
      // TODO faire un appel à <Obj>Manager de manière dynamique
      if ($_GET['table'] == 'users') {
            if ($_GET['table'] == 'users') {
                  UserManager::getInstance()->delete($_GET['id']);
            }
            header("Location: /pages/users.php");
            exit();
      }
      header("Location: /pages/index.php");
      exit();
}

header("Location: /pages/index.php");
exit();
