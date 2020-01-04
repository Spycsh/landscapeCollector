<!-- single record detail page  -->
<!DOCTYPE html>
<html>

<meta name="viewport" charset="utf-8"
	content="width=device-width, initial-scale=1.0">
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/showRecord.js"></script>
<script src="../js/deleteRecord.js"></script>
<script src="../js/editRecord.js"></script>
    <?php

    // verify if the user has login
    session_start();

    // if session is empty, then go to login
    if (! isset($_SESSION['userName'])) {
        echo ($_SESSION['userName']);

        // header("Location:login_process.php");
        header("Location:../window/login.html");
        exit();
    }

    ?>
    
    <head>
<meta charset="utf-8">
<title>details of the record</title>
<link href="../css/ShowRecordWindow.css" rel="stylesheet"
	type="text/css" />
<link rel="stylesheet" href="../css/font-awesome.min.css">
</head>
<body>

	<div id="content">
		<div id="userInfo">
    
    
    
    <?php

    require_once "../controller/DBController.php";
    require_once '../controller/RecordController.php';

    $rc = new RecordController();

    // get id number of the record
    $recordID = $_COOKIE["rid"];

    // if(!empty($_POST["rid"])){
    // $recordID = $_POST["rid"];

    // echo $recordID;

    // }
    // echo "recordID".$recordID;

    // find record according to the record id
    $record = $rc->selectRecord($recordID);

    // find user who created the record
    $curID = $record->getUserID();
    $db = new DBController();
    $db->connect();
    $curUser = $db->getUserInfoById($curID);

    if ($curUser['image'] != '') {
        $userProfileURL = '../uploads/userProfile/' . $curUser['image'];
    } else {
        $userProfileURL = '../uploads/userProfile/' . "default.jpg";
    }

    $db->disconnect();

    echo "<img src=$userProfileURL class='curProfile'></img>";
    echo "<p class = 'curUserName'>" . $curUser['name'] . "</p>";

    //only if the author of the record equals to the current user, then user can edit or delete
    if ($curID == $_SESSION['userID']) {
        echo "<i class='fa fa-edit fa-lg' id = 'edit' onclick = editRecord()></i>";
        echo "<i class='fa fa-trash fa-lg' id = 'delete' onclick = deleteRecord($recordID)></i>";
    }

    ?>
    
    
    </div>
		<p id="test"></p>
		<div id='record'>
			<div id='location'>
				<i class="fa fa-location-arrow fa-x"></i>  <?php echo $record->getCountry()?>, <?php echo $record->getCity()?>
    		 
    	</div>
			<div id='image'>
    	<?php
    $imageURL = '../uploads/RecordImage/' . $record->getPicture();
    echo "<img src=$imageURL id='image'></img>";
    ?>
    	
    	
    	</div>
			<div id='comment'>
				<p><?php echo $record->getComment()?></p>

			</div>

		</div>

	</div>


</body>
</html>