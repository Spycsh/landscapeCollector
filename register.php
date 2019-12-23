<?php
    global $conn;
    include_once("function/database.php");
    include_once("function/fileSystem.php");

    if(empty($_POST)){
        exit("Your upload exceed the max size!<br>");
    }

    // check if the input password is tha same as the verification password
    $password=$_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    if($password!=$confirmPassword){
        exit("password is different from the confirmed password!");
    }

    $userName = $_POST['userName'];

    // check if user name has been used
    $userNameSQL = "select * from user where name='$userName'";
    getConnect();
    $resultSet = $conn->query($userNameSQL);
    if($resultSet->num_rows>0){
        exit("User Name has been used, please change another");
    }

    // upload picture name
    $myPictureName = $_FILES['myPicture']['name'];
    // $registerSQL = "insert into user values(null, '$userName', '$password', '$myPictureName')";
    $passwordMD5 = md5($password);
    $stmt = $conn->prepare("INSERT INTO user (name,password, image) VALUES(?, ?, ?)");
    $stmt->bind_param("sss", $userName, $passwordMD5, $myPictureName);
    // $stmt->execute();


    $message = upload($_FILES['myPicture'], "uploads/userProfile");

    if($message == "upload successfully"||$message=="Not upload"){
        // $conn->query($registerSQL);
        //登陆成功则保存信息
        session_start();
        $_SESSION['userName'] = $userName;

        $stmt->execute();
        $userID = mysqli_insert_id($conn);
        // $userID = $conn->insert_id();
        
        echo "Register successfully";
    }else{
        exit($message);
    }

    $userSQL = "select * from user where iduser = '$userID'";
    $userResult = $conn->query($userSQL);
    if ($user = $userResult->fetch_array()) {
        echo "Your registered use name is" . $user['name'];
        echo "Your password is" . $user['password'];
    } else {
        exit("fail to register!");
    }

    closeConnect();


?>