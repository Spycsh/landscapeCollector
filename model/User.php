<?php
//class user with username, password and user image
class User{
    private $name;
    private $password;
    private $myPicture;

    //construction function
    function __construct($name,$password,$myPicture){
        $this->name = $name;
        $this->password = $password;
        $this->myPicture = $myPicture;
    }

    function setName($name){
        $this->name = $name;
    }

    function getName(){
        return $this->name;
    }

    function setPassword($password){
        $this->password = $password;
    }

    function getPassword(){
        return $this->password;
    }

    function setMyPicture($myPicture){
        $this->myPicture = $myPicture;
    }
    
    function getMyPicture(){
        return $this->myPicture;
    }

}