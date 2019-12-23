<?php
    include_once("function/database.php");
    // $userName = $_POST['userName'];
    $userName = addslashes($_POST['userName']);
    $password = addslashes($_POST['password']);
    $passwordMD5 = md5($password);
    getConnect();
    $loginSQL = "select * from user where name='$userName' and password='$passwordMD5'";

    
    echo $loginSQL;
    global $conn;
    $resultLogin = $conn->query($loginSQL);
    if ($resultLogin->num_rows > 0) {
        $url = "mainPage.php";
        echo "login successfully!";
        echo "<script type='text/javascript'>";
        echo "window.location.href='$url'";
        echo "</script>";
    } else {
        $url = "index.html";
        echo "login Fail!";
        echo "<script type='text/javascript'>";
        echo "window.location.href='$url'";
        echo "</script>";
    }
    closeConnect();

?>