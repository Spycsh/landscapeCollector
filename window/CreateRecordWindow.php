<!-- create record page -->
<html>
<meta name="viewport" charset="utf-8"
	content="width=device-width, initial-scale=1.0">
<title>create your record</title>
<head>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/CreateRecordWindow.css" rel="stylesheet" type="text/css" />
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script src="../js/createValidation.js" type="text/javascript"></script>
<script src="../js/back.js" type="text/javascript"></script>
</head>

<body>

<?php

require_once "../controller/DBController.php";
$db = new DBController();
$db->connect();

// verify if the user has login
session_start();
// if session is empty then go to login window
if (! isset($_SESSION['userName'])) {
    echo ($_SESSION['userName']);
    // header("Location:login_process.php");
    header("Location:../window/login.html");
    exit();
}
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

		<h1>Share your Landscape!</h1>

		<div id="main">
			<div id="backDiv">
				<i class="fa fa-arrow-circle-left fa-lg" id="back" onclick=back()></i>
			</div>


			<form method="post" action="../controller/RecordController.php"
				enctype="multipart/form-data" onsubmit="return check()">

				<label>country: </label> <input type="text" name="create_country" required>
				<p id="hint1"></p>
				<label>city: </label> <input type="text" name="create_city" required>
				<p id="hint2"></p>
				<label>click button to choose your picture</label>
					 <br> 
					<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
					 <input type="file"
					name="create_picture" id="chooseImage" size="25" maxlength="100" required> <br>



				<div id="imagePreview">
					<img src="#" id="image">
				</div>

               <p id="hint4"></p> <br>

				<div id="commentDiv">
					<label>your comment: </label>
					<textarea rows="10" cols="30" name="create_comment" id="comment"></textarea>
					<p id="hint3"></p>
					<br>
				</div>

				<div id="starDiv">
					<label>recommendation:</label> <input type="hidden" value=""
						name="create_star" id="star" required> <span class="starScore"> <span
						title="1" id="1" class></span> <span title="2" id="2" class></span>
						<span title="3" id="3" class></span> <span title="4" id="4" class></span>
						<span title="5" id="5" class></span>
					</span>
				</div>

				<br> <input type="submit" id="submit">

			</form>
		</div>

	</div>

	<script src="../js/jquery.min.js"></script>
	<script type="text/javascript">
	var stars = $(".starScore")[0].children;
	
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
		
		
		 if(!fileFormat.match(/.png|.jpg|.jpeg/)) {
		 //filter the file type
		 alert('please upload one png/jpg/jpeg file');
		$(this).val("");
		 
		 return;
		 }else{//adjust the size of the picture
		 $('#image').css('display','block');
		 $('#image').css('max-height','350px');
		 $('#image').css('max-width','250px');
		 $('#image').attr('src', src); 
		 } 
		});
			
	</script>

</body>


</html>
