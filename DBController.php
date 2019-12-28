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
        echo "connection success<br>";
    }
    
    function disconnect(){
        $this->conn->close();
    }
    
    function createRecord($record){
         $stmt = "INSERT INTO Record (iduser,country, city, picture,comment, star ) 
         VALUES (1, '".$record->getCountry()."', '".$record->getCity()."','".$record->getPicture()."','".$record->getComment()."',".$record->getStar().")";
        if (mysqli_query($this->conn, $stmt)) {
            echo "insert success";
        }
    }
}

?>