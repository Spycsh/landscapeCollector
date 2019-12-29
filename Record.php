<?php
class Record {
    private $country;
    private $city;
    private $picture;
    private $comment;
    private $user;
    private $star;
    private $userID;
    private $recordID;
    
    function __construct( $cou, $city,$pic,$comment,$user,$star ) {
        $this->country = $cou;
        $this->city = $city;
        $this->picture = $pic;
        $this->comment = $comment;
        $this->user = $user;
        $this->star = $star;
    }
    
    function getRecordID(){
        return $this->recordID;
    }
    
    function setRecordID($id){
        $this->recordID = $id;
    }
    
    function getUserID(){
        return $this->userID;
    }
    
    function setUserID($id){
         $this->userID = $id;
    }
    
    function setCountry($cou){
        $this->country = $cou;
    }
    
    function getCountry(){
        return $this->country;
    }
    
    function setCity($city){
        $this->city = $city;
    }
    
    function getCity(){
        return $this->city;
    }
    
    function setPicture($pic){
        $this->picture = $pic;
    }
    
    function getPicture(){
        return $this->picture;
    }
    
    function setComment($com){
        $this->comment = $com;
    }
    
    function getComment(){
        return $this->comment;
    }
    
    function setUser($user){
        $this->user = $user;
    }
    
    function getUser(){
        return $this->user;
    }
    
    function setStar($star){
        $this->star = $star;
    }
    
    function getStar(){
        return $this->star;
    }
    
}
?>
