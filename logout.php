<?php 
/*
 * 文件名：logout.php
 * 描　述：退出登录
*/
session_start();
unset($_SESSION['userName']);
header("Location:login_process.php");
exit();
?>