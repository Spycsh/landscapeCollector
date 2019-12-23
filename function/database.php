<?php
$conn = null;
function getConnect(){
    $servername = "127.0.0.1:3307";
    $username = "root";
    $password = "";
    $dbname = "landscapecollector";
    
    // 创建连接
    global $conn;
    $conn = new mysqli($servername, $username, $password,$dbname);
    
    // 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    } 
    // echo "连接成功";

}

function closeConnect(){
    global $conn;
    if($conn){
        mysqli_close($conn);
    }
}
?>