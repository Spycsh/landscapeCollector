<?php

// require_once (dirname(dirname(__FILE__)) ."\window\EditRecordWindow.php");
require_once (dirname(dirname(__FILE__)) . "\model\Record.php");
require_once (dirname(dirname(__FILE__)) . "\controller\DBController.php");

// controller to control the behavior of create, select and edit record
class RecordController
{

    var $rec;

    var $db;

    // create record function and update database inside
    function createRecord($country, $city, $pic, $comment, $star)
    {
        session_start();

        $this->rec = new Record($country, $city, $pic, $comment, $star, $_SESSION['userID']);

        $this->updateDB();
    }

    // select record from the database
    function selectRecord($recordID)
    {
        $id = $recordID;

        $this->db = new DBController();
        $this->db->connect();

        $result = $this->db->selectRecord($id);

        $country = $result['country'];
        $city = $result['city'];
        $picture = $result['picture'];
        $comment = $result['comment'];
        $star = $result['star'];
        $iduser = $result['iduser'];
        $idrecord = $result['idrecord'];

        $record = new Record($country, $city, $picture, $comment, $star, $iduser);
        $record->setRecordID($idrecord);

        $this->db->disconnect();
        return $record;
    }

    //edit record according to the user input
    function editRecord($country, $city, $pic, $comment, $star, $id)
    {
        $this->db = new DBController();
        $this->db->connect();

        $result = $this->db->selectRecord($id);

        $result = $this->db->selectRecord($id);

        $oldCountry = $result['country'];
        $oldCity = $result['city'];
        $oldPicture = $result['picture'];
        $oldComment = $result['comment'];
        $oldStar = $result['star'];
        $oldIduser = $result['iduser'];
        $oldIdrecord = $result['idrecord'];

        $oldRecord = new Record($oldCountry, $oldCity, $oldPicture, $oldComment, $oldStar, $oldIduser);
        $oldRecord->setRecordID($oldIdrecord);

        $newRecord = new Record($country, $city, $pic, $comment, $star, $id);

        $this->db->editRecord($oldRecord, $newRecord);

        $this->db->disconnect();
    }

    // update record in the database
    function updateDB()
    {
        $this->db = new DBController();
        $this->db->connect();
        $this->db->createRecord($this->rec);
        $this->db->disconnect();
    }
}

$crc = new RecordController();

if(empty($_POST["create_star"])){
    echo "<script>
    var del=confirm('You have not set the recommendation star? You will by default give 5 stars to your landscape~');
    if(del==true){
         
    }else{
        window.location.href = '../window/createRecordWindow.php';
    }
    </script>";
    $_POST["create_star"] = 5;
}

// when post variable from create page is not empty
if (! empty($_POST["create_country"])) {

    $crc->createRecord($_POST["create_country"], $_POST["create_city"], $_FILES["create_picture"]["name"], $_POST["create_comment"], $_POST["create_star"]);
}

// when post variable from edit page is not empty
if (! empty($_POST["edit_country"])) {

    $crc->editRecord($_POST["edit_country"], $_POST["edit_city"], $_FILES["edit_picture"]["name"], $_POST["edit_comment"], $_POST["edit_star"], $_POST["edit_id"]);

}

?>
