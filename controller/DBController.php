<?php

class DBController{
   
    var $servername = "127.0.0.1:3307"; // 端口号记得改！
    var $username = "root";
    var $password = "";
    var $dbname = "landscapecollector";
    var $conn;
    
    function connect(){
       $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        
        if ($this->conn->connect_error) {
            die("connection fail: " . $this->conn->connect_error);
        }
        echo "connection success<br>";
    }
    
    function disconnect(){
        $this->conn->close();
    }

    function login($userName,$passwordMD5){
        $loginSQL = "select * from user where name='$userName' and password='$passwordMD5'";
        $resultLogin = $this->conn->query($loginSQL);
        // 成功登陆则保存用户名，跳转到主页面
        if ($resultLogin->num_rows > 0) {
            session_start();
            $_SESSION['userName'] = $userName;
            $url = "mainPage.php";
            echo "login successfully!";
            echo "<script type='text/javascript'>";
            echo "window.location.href='$url'";
            echo "</script>";
        } else {    //未成功则跳回登陆界面
            $url = "index.html";
            echo "login Fail!";
            echo "<script type='text/javascript'>";
            echo "window.location.href='$url'";
            echo "</script>";
        }
    }
    
    // 将记录写进数据库
    function createRecord($record){
         $stmt = "INSERT INTO Record (iduser,country, city, picture,comment, star ) 
         VALUES (1, '".$record->country."', '".$record->city."','".$record->picture."','".$record->comment."',".$record->star.")";
        if (mysqli_query($this->conn, $stmt)) {
            echo "insert success";
        }
    }

    // 将用户信息写入数据库
    function register($user){
        
        // echo($user->name);
        // echo($user->myPicture);
        // echo($user->password);
        $userName = $user->getName();
        $myPictureName = $user->getMyPicture();
        $password = $user->getPassword();
        
        $passwordMD5 = md5($password);  // 加密密码到数据库

        // 判断没有用户名被用过
        $userNameSQL = "select * from user where name='$userName'";
        $resultSet = $this->conn->query($userNameSQL);
        if($resultSet->num_rows>0){
            exit("User Name has been used, please change another<br>");
        }

        // $myPictureName = $_FILES['myPicture']['name'];
        // $registerSQL = "insert into user values(null, '$userName', '$password', '$myPictureName')";
        
        // 插入数据
        $stmt = $this->conn->prepare("INSERT INTO user (name,password, image) VALUES(?, ?, ?)");
        $stmt->bind_param("sss", $userName, $passwordMD5, $myPictureName);

        $message = $this->upload($_FILES['myPicture']);

        if($message == "upload successfully"||$message=="Not upload"){
            // $conn->query($registerSQL);
            //登陆成功则保存信息
            session_start();
            $_SESSION['userName'] = $userName;

            $stmt->execute();
            $userID = mysqli_insert_id($this->conn);
            
            echo "Register successfully<br>";
            echo("You are our No: " . $userID . " user to use lanscape collector!<br>");
            return $userID;
        }else{
            exit($message);
        }
    }


    // 上传头像
    function upload($file) {
        $error = $file['error'];
        $filePath = dirname(dirname(__FILE__)) . "\uploads\userProfile";
        switch ($error) {
            case 0:
                $fileName = $file['name'];
                $fileTemp = $file['tmp_name']; // 缓存名
                // echo($fileName);
                // echo($fileTemp);
                $destination = $filePath . "/" . $fileName;
                move_uploaded_file($fileTemp, $destination);
                return "upload successfully";
            case 1:
                return "exceed upload_max_filesize";
            case 2:
                return "exceed form MAX_FILE_SIZE";
            case 3:
                return "enclose part upload";
            case 4:
                return "Not upload";
        }
    }

    // 通过id查user信息,返回一个关联数组
    function getUserInfoById($userID){
        $userSQL = "select * from user where iduser = '$userID'";
        $userResult = $this->conn->query($userSQL);

        if($user = $userResult->fetch_array()){
            return $user;
        }
        else{
            exit("fail to register!");
        }
    }


}

?>