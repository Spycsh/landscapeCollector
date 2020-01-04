<?php 
//not a controller. It defines the process of logout.
session_start();
unset($_SESSION['userName']);
unset($_SESSION['userID']);
// session_destroy();
// header("Location:login_process.php");
header("Location:../window/login.html");
exit();
?>