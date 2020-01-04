<?php

//class record with detail information of the record
class Record {
    private $country;
    private $city;
    private $picture;
    private $comment;
    private $star;
    private $userID;
    private $recordID;
    

    //contruction function
    function __construct( $cou, $city,$pic,$comment,$star, $user ) {
        $this->country = $cou;
        $this->city = $city;
        $this->picture = $pic;
        $this->comment = $comment;
        $this->star = $star;
        $this->userID = $user;
        
    }
    
    function getUserID(){
        return $this->userID;
    }
    
    function setUserID($id){
        $this->userID = $id;
    }
    
    function getRecordID(){
        return $this->recordID;
    }
    
    function setRecordID($id){
        $this->recordID = $id;
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
    
    function setStar($star){
        $this->star = $star;
    }
    
    function getStar(){
        return $this->star;
    }
    
}
?>