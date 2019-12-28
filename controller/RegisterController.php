<?php
// echo(dirname(dirname(__FILE__)) . "\model\User.php" );
require (dirname(dirname(__FILE__)) . "\model\User.php"); //paths in PHP are always relative to the first file path
require ("DBController.php");

class RegisterController{
    var $user;
    var $db;
    var $registerID;

    function createUser($name,$password,$confirmPassword,$myPicture){
        //判断password与confirmPassword相等
        if($password == $confirmPassword){
            $this->user = new User($name,$password,$myPicture);
            $this->updateDB();
        }else{
            exit("password is not equal to confirm password!");
        }

    }

    function updateDB(){
        // echo("ss");
        $this->registerID = $this->db->register($this->user);
        // $this->db->disconnect();
    }

    function displayUserInfo($userID){
        $user = $this->db->getUserInfoById($userID);

        echo "Your registered use name is:<br>" . $user['name'] . "<br>";
        echo "Your password is:<br>" . $user['password'] . "<br>";
    }

}

$rc = new RegisterController();
$rc->db = new DBController();
$rc->db->connect();
$rc->createUser($_POST["userName"],$_POST["password"],$_POST["confirmPassword"],$_FILES['myPicture']['name']);

$rc->displayUserInfo($rc->registerID);

$rc->db->disconnect();

?>