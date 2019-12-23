<?php
    
    include_once("function/database.php");
    global $conn;
    // $userName = $_POST['userName'];
    if(empty($_POST['userName'])||empty($_POST['password'])){
        echo "<br /><div style='width:275px; color:red; margin:auto'>用户名或密码为空，请重新输入！</div>";
    }
    $userName = addslashes($_POST['userName']);
    $password = addslashes($_POST['password']);
    getConnect();
    $loginSQL = "select * from user where name='$userName' and password='$password'";

    echo $loginSQL;
    
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
        // echo "<script type='text/javascript'>";
        // echo "window.location.href='$url'";
        // echo "</script>";
        echo "<br /><div style='width:275px; color:red; margin:auto'>用户名或密码输入错误，请重新输入！</div>";
    }
    closeConnect();

?>