<?php
// echo(dirname(dirname(__FILE__)) . "\model\User.php" );
require_once (dirname(dirname(__FILE__)) . "\model\User.php");
require_once "DBController.php";

// controller to control the register behavior
class RegisterController
{

    var $user;

    var $db;

    var $registerID;

    //create a user
    function createUser($name, $password, $confirmPassword, $myPicture)
    {
        
        // check if password equals or not
        if ($password == $confirmPassword) {
            
            $this->user = new User($name, $password, $myPicture);
            $this->updateDB();
            $this->displayUserInfo($this->registerID);
        } else {
            // exit("password is not equal to confirm password!");
            // header("Location:../index.html");
            echo "<script type='text/javascript'>";
            echo "alert('password is not equal to confirm password!')";
            // echo "window.location.href='../register.html'";
            echo "</script>";
        }
    }

    //update database
    function updateDB()
    {
        
         echo($this->user->getName());
        $this->registerID = $this->db->register($this->user);
        // $this->db->disconnect();
    }

    //display information in the alert window
    function displayUserInfo($userID)
    {
        $user = $this->db->getUserInfoById($userID);

        $userName = $user['name'];
        $password = $user['password'];
        // echo "Your registered use name is:<br>" . $user['name'] . "<br>";
        // echo "Your password is:<br>" . $user['password'] . "<br>";
        echo "<script type='text/javascript'>";
        echo "alert('Your registered use name is: $userName\\nYou are our No: $userID user to use lanscape collector')";
        // echo "alert('Your registered use name is:<br>$userName')";
        // echo "alert('Your password is:<br>$password')";
        echo "</script>";

        echo "<script type='text/javascript'>";
        echo "window.location.href='../window/login.html'";
        echo "</script>";

        // header("Location:../index.html");
    }
}

$rc = new RegisterController();
$rc->db = new DBController();
$rc->db->connect();

if(isset($_POST['userName'])){
    echo "aacc";
    $rc->createUser($_POST["userName"], $_POST["password"], $_POST["confirmPassword"], $_FILES['myPicture']['name']);
}


// $rc->displayUserInfo($rc->registerID);

$rc->db->disconnect();

?>