<?php
require_once ("Record.php");
require_once ("DBController.php");
require_once ("EditRecordWindow.php");

class RecordController{
    
    var $rec;    
    var $db;
    
    function createRecord($country, $city,$pic,$comment,$star){
        $this->rec = new Record($country, $city,$pic,$comment,$star);
        $this->updateDB();
    }
    
    function editRecord($country, $city,$pic,$comment,$star){
        
        
        $this->db = new DBController();
        $this->db->connect();
        
        //change34
        $record = $this->db->selectRecord("Germany");
        
        
        $newRecord = new Record($country, $city,$pic,$comment,$star);
        $newRecord->setUserID($record->getUserID());
        $newRecord->setRecordID($record->getRecordID());
        
        $this->db->editRecord($record,$newRecord);
        
        $this->db->disconnect();
        
    }
    
    function updateDB(){
        $this->db = new DBController();
        $this->db->connect();
        $this->db->createRecord($this->rec);
        $this->db->disconnect();
    }
    
}

$crc = new RecordController();

if(!empty($_POST["create_country"])){
   
    $crc->createRecord($_POST["create_country"],$_POST["create_city"],$_POST["create_picture"],
        $_POST["create_comment"],$_POST["create_star"]);    
}

if(!empty($_POST["edit_country"])){
    
    $crc->editRecord($_POST["edit_country"],$_POST["edit_city"],$_POST["edit_picture"],
        $_POST["edit_comment"],$_POST["edit_star"]);
}



?>