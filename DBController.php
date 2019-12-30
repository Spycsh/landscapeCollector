<?php

class DBController{
   
    var $servername = "127.0.0.1:3301";
    var $username = "root";
    var $password = "";
    var $dbname = "landscapecollector";
    var $conn;
    
    function connect(){
        
        
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        
        if ($this->conn->connect_error) {
            die("connection fail: " . $this->conn->connect_error);
        }
//        echo "connection success<br>";
    }
    
    function disconnect(){
        $this->conn->close();
    }
    
    function createRecord($record){
         $stmt = "INSERT INTO Record (iduser,country, city, picture,comment, star ) 
         VALUES (1, '".$record->getCountry()."', '".$record->getCity()."','".$record->getPicture()."','".$record->getComment()."',".$record->getStar().")";
        if (mysqli_query($this->conn, $stmt)) {
            echo "<script> alert('Your record is stored.');</script>";
        }
    }
    
    //just for testing
    //should be deleted later
    function selectRecord($recordCountry){
        $record = new Record("", "","","",0);
        $stmt= "SELECT * FROM record WHERE country = '".$recordCountry."'";
       
        $result = mysqli_query($this->conn, $stmt);
        
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $record->setCountry($row["country"]);
                $record->setCity($row["city"]);
                $record->setPicture($row["picture"]);
                $record->setComment($row["comment"]);
                $record->setStar($row["star"]);
                $record->setUserID($row["iduser"]);
                $record->setRecordID($row["idrecord"]);
                
            
            }
        } else {
            echo "0 result";
        }
        
        return $record;
        
        
    }
    
    function editRecord($oldRecord,$newRecord){
       
        $stmt = "UPDATE record SET country='".$newRecord->getCountry()."', 
                                    city='".$newRecord->getCity()."',
                                    picture='".$newRecord->getPicture()."',
                                    comment='".$newRecord->getComment()."',
                                    star='".$newRecord->getStar()."' 
                                    WHERE idrecord=".$oldRecord->getRecordID()."";
            if(mysqli_query($this->conn, $stmt)) {
                echo "<script> alert('Your change is stored.');</script>";
            
            }
        
        
    }
    
}

?>