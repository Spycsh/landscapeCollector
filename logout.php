<?php 
/*
 * 文件名：logout.php
 * 描　述：退出登录
*/
session_start();
unset($_SESSION['userName']);
// session_destroy();
// header("Location:login_process.php");
header("Location:index.html");
exit();
?>