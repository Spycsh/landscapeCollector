<!-- single record detail page  -->
<!DOCTYPE html>
<html>

<meta name="viewport" charset="utf-8"
	content="width=device-width, initial-scale=1.0">
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/showRecord.js"></script>
<script src="../js/deleteRecord.js"></script>
<script src="../js/editRecord.js"></script>
<script src="../js/back.js"></script>
    <?php

    require_once "../controller/DBController.php";
    $db = new DBController();
    $db->connect();

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
<link href="../css/style.css" rel="stylesheet"
    type="text/css" />
<link href="../css/ShowRecordWindow.css" rel="stylesheet"
    type="text/css" />

<link rel="stylesheet" href="../css/font-awesome.min.css">
</head>
<body>
    <header id="header" class="site-header">
    <div class='logoDiv' onclick=back()>
		<img id="logo" src = '../css/img/logo.png'></img>
	</div>
	<div class='caption' onclick=back()>
		<h1 id="caption">LANDSCAPE COLLECTOR</h1>
	</div>
		<button id="logout" title="log out"
			onclick="location.href='../controller/logout.php'"></button>
		<span class="space"></span>
        <?php
        // get profile of current user
        $curID = $_SESSION['userID'];
        $curUser = $db->getUserInfoById($curID);
        if ($curUser['image'] != '') {
            $userProfileURL = '../uploads/userProfile/' . $curUser['image'];
        } else {
            $userProfileURL = '../uploads/userProfile/' . "default.jpg";
        }
        $db->disconnect();
        echo "<img src=$userProfileURL class='curProfile'></img>"?>
        
        
    </header>

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

    echo "<img src=$userProfileURL class='recordProfile'></img>";
    echo "<p class = 'curUserName'>" . $curUser['name'] . "</p>";
    
    echo "<i class='fa fa-arrow-circle-left fa-lg' id='back' onclick=back() aria-hidden='true'></i>";

    //only if the author of the record equals to the current user, then user can edit or delete
    if ($curID == $_SESSION['userID']) {
        echo "<i class='fa fa-edit fa-lg' id = 'edit' onclick = editRecord()></i>";
        echo "<i class='fa fa-trash fa-lg' id = 'delete' onclick = deleteRecord($recordID)></i>";
    }

    ?>
    
    
    </div>
		
		<div id='record'>
			<div id='location'>
				<i class="fa fa-location-arrow fa-x"></i>  <?php echo $record->getCountry()?>, <?php echo $record->getCity()?>
    		 
    	</div>
    	
    	<div id="starDiv">
    			<label id="re">recommendation:</label>
					<input type="hidden" value=<?php echo $record->getStar(); ?> name="edit_star" id="star">
					<span class="starScore"> 
					<span title="1" id="1" class></span> 
					<span title="2" id="2" class></span> 
					<span title="3" id="3" class></span>
					<span title="4" id="4" class></span>
					<span title="5" id="5" class></span>
					</span>
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
	<script src="../js/jquery.min.js"></script>
<script type="text/javascript">

	var stars = $(".starScore")[0].children;
	
	var initialStar = $("#star").val();
	
	for(var j=0;j<initialStar;j++){
        stars[j].setAttribute("class", "select");
    }
    for(var k=initialStar;k<stars.length;k++){
        stars[k].setAttribute("class","");
    }
    </script>

</body>
</html>