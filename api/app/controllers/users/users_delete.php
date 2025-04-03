<?php

use App\Models\Users;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && is_numeric($_POST['id'])) {
    $users = new Users();
    $users->delete((int)$_POST['id']);
    
    header('Location: ../index.php?page=users');
    exit();
} else {
    header('Location: ../index.php?page=users');
    exit();
}
