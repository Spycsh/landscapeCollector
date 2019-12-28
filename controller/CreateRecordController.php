<?php
require ("Record.php");
require ("DBController.php");

class CreateRecordController{
    
    var $rec;    
    var $db;
    
    function createRecord($cou, $city,$pic,$comment,$star){
        $this->rec = new Record($cou, $city,$pic,$comment,1,$star);
        $this->updateDB();
    }
    
    function updateDB(){
        $this->db = new DBController();
        $this->db->connect();
        $this->db->createRecord($this->rec);
        $this->db->disconnect();
        
    }
    
}

$crc = new CreateRecordController();
$crc->createRecord($_POST["country"],$_POST["city"],$_POST["picture"],
    $_POST["comment"],$_POST["star"]);

?>