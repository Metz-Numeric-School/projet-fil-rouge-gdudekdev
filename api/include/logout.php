<?php 
session_start();
$_SESSION['is_logged']=false;
session_destroy();
header("Location: /pages/login.php");
exit();
