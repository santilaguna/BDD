<?php 
session_start();
$_SESSION['loggedin'] = FALSE;
header('Location: ../index.php'); 
exit(); 
?>
