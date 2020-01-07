<!-- edit record page -->
<html>

<meta name="viewport" charset="utf-8"
	content="width=device-width, initial-scale=1.0">

<head>
<meta charset="utf-8">
<title>edit your record</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/CreateRecordWindow.css" rel="stylesheet" type="text/css" />
<script src="../js/editValidation.js" type="text/javascript"></script>
<script src="../js/back.js" type="text/javascript"></script>
</head>
<body>
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

<?php
require_once ("../model/Record.php");
require_once ("../controller/DBController.php");
require_once ("../controller/RecordController.php");

$recordID = $_COOKIE["rid"];

$rc = new RecordController();
$record = $rc->selectRecord($recordID);

?>



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

		<!-- <h1>Edit your Landscape!</h1> -->
		<!-- <button><i class='fa fa-arrow-circle-left fa-lg' id='back' onclick=back() aria-hidden='true'></i></button> -->
		<div id="main">



			<form method="post" action="../controller/RecordController.php"
				enctype="multipart/form-data" onsubmit="return check()">
				
				<input type="hidden" value="<?php echo $recordID; ?>" name="edit_id"
					id="edit_id"> <label>country: </label> <input type="text"
					name="edit_country" value="<?php echo $record->getCountry(); ?>">
					<p id="hint1"></p>
				<label>city: </label> <input type="text" name="edit_city"
					value="<?php echo $record->getCity(); ?>">
					<p id="hint2"></p>
					<label>click button to choose your picture</label>
					<input type="hidden" name="MAX_FILE_SIZE" value="2000000"> 
					<input type="file" name="edit_picture" id="chooseImage" size="25" maxlength="100"> <br>

				<div id="imagePreview">
				
				<?php
    $imageURL = '../uploads/RecordImage/' . $record->getPicture();
    echo "<img src=$imageURL id='editImage'></img>";
    ?>
					
					
					
				</div>
				 <p id="hint4"></p> <br>

				<div id="commentDiv">
					<label>your comment: </label>
					<textarea rows="10" cols="30" name="edit_comment" id="comment"><?php echo $record->getComment(); ?></textarea>
					<p id="hint3"></p>
					<br>
				</div>

				<div id="starDiv">
					<label>recommendation:</label> <input type="hidden"
						value=<?php echo $record->getStar(); ?> name="edit_star" id="star">
					<span class="starScore"> <span title="1" id="1" class></span> <span
						title="2" id="2" class></span> <span title="3" id="3" class></span>
						<span title="4" id="4" class></span> <span title="5" id="5" class></span>
					</span>
				</div>

				<br> <input type="submit" id="submit">

			</form>
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
	
	for(var i=0;i<stars.length;i++){
	    stars[i].addEventListener("mouseover",function(){
	        var rating = event.target.id; // get the id of the star
	        for(var j=0;j<rating;j++){
	            if(stars[j].className!="select"){
	            stars[j].setAttribute("class", "active");

	            }
	        }
	    })

	    stars[i].addEventListener("mouseleave",function(){
	        var rating = event.target.id; 
	        for(var j=0;j<rating;j++){
	            if(stars[j].className!="select"){
	                            stars[j].setAttribute("class", "");

	            }
	        }
	    })

	    stars[i].addEventListener("click",function(){
	        var rating = event.target.id; 
	        $('#star').val(rating);
	        for(var j=0;j<rating;j++){
	            stars[j].setAttribute("class", "select");
	        }
	        for(var k=rating;k<stars.length;k++){
	            stars[k].setAttribute("class","");
	        }

	    })
	}
		

	
	//show the selected picture
	$('#chooseImage').on('change', function() {
		 var filePath = $(this).val(), 
		 fileFormat = filePath.substring(filePath.lastIndexOf(".")).toLowerCase(),
		 src = window.URL.createObjectURL(this.files[0]); 
		
		 if(!fileFormat.match(/.png|.jpg|.jpeg|.pdf/)) {

		 //filter the file type
		 alert('please upload one png/jpg/jpeg/pdf file');
		 return;
		 }else{//adjust the size of the picture
		 $('#editImage').css('display','block');
		 $('#editImage').css('max-height','350px');
		 $('#editImage').css('max-width','250px');
		 $('#editImage').attr('src', src); 
		 } 
		});
			
	</script>
</body>
</html>
