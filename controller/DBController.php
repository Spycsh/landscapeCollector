<?php
//controller of database behaviors
class DBController
{
    // remember to change the port number!
    var $servername = "127.0.0.1:3307";

   
    var $username = "root";

    var $password = "";

    var $dbname = "landscapecollector";

    var $conn;

    //connect to the database
    function connect()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("connection fail: " . $this->conn->connect_error);
        }
        // echo "connection success<br>";
    }

    
    //disconnect from the database
    function disconnect()
    {
        $this->conn->close();
    }

    //login
    //to check whether the user already exists in the database and set the session variable
    function login($userName, $passwordMD5)
    {
        $loginSQL = "select * from user where name='$userName' and password='$passwordMD5'";
        $resultLogin = $this->conn->query($loginSQL);

        $result = $resultLogin->fetch_array();
        $userID = $result['iduser'];

        // if login successfully, then jump to the main page
        if ($resultLogin->num_rows > 0) {
            session_start();
            $_SESSION['userName'] = $userName;
            $_SESSION['userID'] = $userID;

            $url = "../window/mainPage.php";
            // echo $url;
            echo "login successfully!";
            echo "<script type='text/javascript'>";
            echo "window.location.href='$url'";
            echo "</script>";
        } else { // if not login yet, then jump to the login page
            $url = dirname(dirname(__FILE__)) . "\window\login.php";
            echo "login Fail!";
            echo "<script type='text/javascript'>";
            echo "window.location.href='$url'";
            echo "</script>";
        }
    }

    // write data into database
    function createRecord($record)
    {
        $country = $record->getCountry();
        $city = $record->getCity();
        $picture = $record->getPicture();
        $comment = $record->getComment();
        $user = $record->getUserID();
        $star = $record->getStar();

        // exit($_FILES['myPicture']['name']);
        $this->uploadRecordImage($_FILES['create_picture']);

        $stmt = "INSERT INTO Record (iduser,country, city, picture,comment, star ) 
         VALUES ($user, '" . $country . "', '" . $city . "','" . $picture . "','" . $comment . "'," . $star . ")";

        if (mysqli_query($this->conn, $stmt)) {
            // echo "insert success";
            echo "<script type='text/javascript'>";
            echo "alert('Upload successfully')";
            // echo "alert('Your registered use name is:<br>$userName')";
            // echo "alert('Your password is:<br>$password')";
            echo "</script>";

            echo "<script type='text/javascript'>";
            echo "window.location.href='../window/mainPage.php'";
            echo "</script>";
        }
    }

    // write user info. into database
    function register($user)
    {

        // echo($user->name);
        // echo($user->myPicture);
        // echo($user->password);
        $userName = $user->getName();
        $myPictureName = $user->getMyPicture();
        $password = $user->getPassword();

        $passwordMD5 = md5($password); // write encrypted password into database
                                       // check the user name exist or not
        $userNameSQL = "select * from user where name='$userName'";
        $resultSet = $this->conn->query($userNameSQL);
        if ($resultSet->num_rows > 0) {
            exit("User Name has been used, please change another<br>");
        }

        // $myPictureName = $_FILES['myPicture']['name'];
        // $registerSQL = "insert into user values(null, '$userName', '$password', '$myPictureName')";

        // insert data
        $stmt = $this->conn->prepare("INSERT INTO user (name,password, image) VALUES(?, ?, ?)");
        $stmt->bind_param("sss", $userName, $passwordMD5, $myPictureName);

        $message = $this->upload($_FILES['myPicture']);

        if ($message == "upload successfully" || $message == "Not upload") {
            // $conn->query($registerSQL);
            // if login successfully then keep the info in the session
            session_start();
            $_SESSION['userName'] = $userName;

            $stmt->execute();
            $userID = mysqli_insert_id($this->conn);

            $_SESSION['userID'] = $userID;

            // echo "Register successfully<br>";
            // echo("You are our No: " . $userID . " user to use lanscape collector!<br>");
            return $userID;
        } else {
            exit($message);
        }
    }

    // upload the user image
    function upload($file)
    {
        $error = $file['error'];
        $filePath = dirname(dirname(__FILE__)) . "\uploads\userProfile";
        switch ($error) {
            case 0:
                $fileName = $file['name'];
                $fileTemp = $file['tmp_name'];
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

    // upload the record image in the project folder
    function uploadRecordImage($file)
    {
        $filePath = dirname(dirname(__FILE__)) . "\uploads\RecordImage";

        $fileName = $file['name'];
        $fileTemp = $file['tmp_name'];

        // echo($fileName);
        // echo($fileTemp);
        $destination = $filePath . "/" . $fileName;
        // echo $fileName;
        // echo $fileTemp;
        // echo $destination;
        // exit();
        // exit($fileName);
        move_uploaded_file($fileTemp, $destination);
    }

    // find user info. by user id, and return a associated array
    function getUserInfoById($userID)
    {
        // echo($userID);

        // $sql = "select * from user where `userid` = $userID";
        // $result = mysqli_query($this->conn, $sql);

        // if (mysqli_num_rows($result) > 0) {

        // while($user = mysqli_fetch_assoc($result)) {
        // return $user;
        // }

        // } else {

        // echo "0 result; fail to register";

        // }
        $userSQL = "select * from user where iduser = '$userID'";
        $userResult = $this->conn->query($userSQL);
        // echo($userResult->num_rows."<br>");
        if ($user = $userResult->fetch_array()) {
            // echo(count($user)."<br>");
            // for($i=0;$i<count($user);$i++){
            // echo $user['name'];
            // echo $user['password'];
            // }

            // exit();
            return $user;
        } else {
            exit("fail to register!");
        }
    }

    // get all records
    function getRecords()
    {
        $stmt = "select * from record";
        $result = $this->conn->query($stmt);

        $resultList = array();
        $num = 0;
        while ($row = $result->fetch_array()) {

            $resultList[$num] = $row;
            $num = $num + 1;
        }

        return $resultList;
    }

    // vague search
    // search username, country or city are possible
    function searchRecordsWithKeyword($keyword)
    {
        $stmt = "select * from record where country like '%$keyword%' 
        UNION select * from record where city like '%$keyword%'
        UNION select * from record where iduser in (select iduser from user where name like '%$keyword%')";
        $result = $this->conn->query($stmt);

        $resultList = array();
        $num = 0;
        while ($row = $result->fetch_array()) {

            $resultList[$num] = $row;
            $num = $num + 1;
        }

        return $resultList;
    }

    // find all record of current user
    // function getRecordsByID($userID){
    // $stmt = "select * from record where name = '$userID'";
    // $result = $this->conn->query($stmt);

    // $records = $result->fetch_array();
    // return $records;

    // }

    // return selected page
    function searchRecordsByPage($pageNum)
    {
        // each page has 6 records
        $offset = ($pageNum - 1) * 6;

        $stmt = "select * from record limit 6 offset $offset";
        // echo($stmt);
        // exit();
        $result = $this->conn->query($stmt);

        $resultList = array();
        $num = 0;
        while ($row = $result->fetch_array()) {

            $resultList[$num] = $row;
            $num = $num + 1;
        }

        return $resultList;
    }

    // return page number
    function getPageNum()
    {
        $stmt = "select count(*) as recordNum from landscapecollector.record";

        $result = $this->conn->query($stmt);
        $row = $result->fetch_array();
        $pageNum = ceil($row['recordNum'] / 6);

        return $pageNum;
    }

    
    //eidt the records
    function editRecord($oldRecord, $newRecord)
    {
        if($newRecord->getPicture() == ""){
            $stmt = "UPDATE record SET country='" . $newRecord->getCountry() . "',
                                    city='" . $newRecord->getCity() . "',
                                    comment='" . $newRecord->getComment() . "',
                                    star='" . $newRecord->getStar() . "'
                                    WHERE idrecord=" . $oldRecord->getRecordID() . "";
        }else{
        $stmt = "UPDATE record SET country='" . $newRecord->getCountry() . "',
                                    city='" . $newRecord->getCity() . "',
                                    picture='" . $newRecord->getPicture() . "',
                                    comment='" . $newRecord->getComment() . "',
                                    star='" . $newRecord->getStar() . "'
                                    WHERE idrecord=" . $oldRecord->getRecordID() . "";
        }
        
        $this->uploadRecordImage($_FILES['edit_picture']);

        if (mysqli_query($this->conn, $stmt)) {
            echo "<script> alert('Your change is stored.');</script>";

            echo "<script>window.location.href='../window/mainPage.php';</script>";
        }
    }

    //select one record according to record id
    function selectRecord($recordID)
    {
        $stmt = "select * from record where idrecord = $recordID";

        $result = mysqli_query($this->conn, $stmt);

        if ($record = mysqli_fetch_assoc($result)) {

            return $record;
        } else {
            exit('find no record');
        }

        if (! $result) {
            printf("Error: %s\n", mysqli_error($this->conn));
            exit();
        }
    }

    //delete one record from database according to record id
    function deleteRecord($recordID)
    {
        $stmt = "DELETE FROM record WHERE idrecord = " . $recordID;
        $result = mysqli_query($this->conn, $stmt);

        if ($result) {
            echo "<script> alert('Delete successfully.');</script>";
        }

        //delete cookie (make cookie invalid in 0.5 seconds)
        setcookie("delete_rid", "", time() - 0.5);
    }
    
    //register function for initialization.php (without upload picture)
    function iniRegister($user)
    {
        
        // echo($user->name);
        // echo($user->myPicture);
        // echo($user->password);
        $userName = $user->getName();
        $myPictureName = $user->getMyPicture();
        $password = $user->getPassword();
        
        $passwordMD5 = md5($password); // write encrypted password into database
        // check the user name exist or not
        $userNameSQL = "select * from user where name='$userName'";
        $resultSet = $this->conn->query($userNameSQL);
        if ($resultSet->num_rows > 0) {
            exit("User Name has been used, please change another<br>");
        }
        
       
        // insert data
        $stmt = $this->conn->prepare("INSERT INTO user (name,password, image) VALUES(?, ?, ?)");
        $stmt->bind_param("sss", $userName, $passwordMD5, $myPictureName);
        

            session_start();
            $_SESSION['userName'] = $userName;
            
            $stmt->execute();
            $userID = mysqli_insert_id($this->conn);
            
            $_SESSION['userID'] = $userID;
            
          
            return $userID;

    }
    
    //create record function for initialization.php (without upload picture)
    function iniCreateRecord($record)
    {
        $country = $record->getCountry();
        $city = $record->getCity();
        $picture = $record->getPicture();
        $comment = $record->getComment();
        $user = $record->getUserID();
        $star = $record->getStar();
        
        $stmt = "INSERT INTO Record (iduser,country, city, picture,comment, star )
         VALUES ($user, '" . $country . "', '" . $city . "','" . $picture . "','" . $comment . "'," . $star . ")";
        
        if (mysqli_query($this->conn, $stmt)) {
            echo "create success;<br>";
        }
    }
    
    
}


?>