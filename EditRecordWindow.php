
<html>

<meta name="viewport" charset="utf-8"
	content="width=device-width, initial-scale=1.0">
	
<head>
<meta charset="utf-8">
<title>edit your record</title>
<link href="./CreateRecordWindow.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?php
require_once ("Record.php");
require_once ("DBController.php");
require_once ("RecordController.php");

// session_start();
// $record = $_SESSION['$selectRecord'];
$db = new DBController();

$db->connect();

//change
$record = $db->selectRecord("Germany");
$db->disconnect();

?>


<div id="content">

		<h1>Share your Landscape!</h1>

		<div id="main">



			<form method="post" action="RecordController.php">
				<label> your name: </label> 
				<input type="text" name="edit_name" value="<?php echo $record->getUserID(); ?>"> <br>
				
				 <label>country: </label> 
				 <input type="text" name="edit_country" value="<?php echo $record->getCountry(); ?>"> <br> 
				 <label>city: </label> 
				 <input type="text" name="edit_city" value="<?php echo $record->getCity(); ?>"> <br>


					<label>click button to choose your picture</label> <br> 
					<input type="file" name="edit_picture"  id="chooseImage"> <br>
				
				<div id="imagePreview">
					<img src="#" id="image">
				</div>


				<div id="commentDiv">
				<label>your comment: </label> 
				<textarea rows="10" cols="30" name="edit_comment" 
					id="comment" ><?php echo $record->getComment(); ?></textarea> <br> 
				</div>	
				
					<div id="starDiv">
					<label>recommendation:</label> 
					
					<input type="hidden" value=<?php echo $record->getStar(); ?> name="edit_star" id="star">
						<span class="starScore">
					      <span title="1" id="1" class></span>
					      <span title="2" id="2" class></span>
					      <span title="3" id="3" class></span>
					      <span title="4" id="4" class></span>
					      <span title="5" id="5" class></span>
					    </span>
					</div>
					
					<br>
					<input type="submit" id="submit">
					
			</form>
		</div>

	</div>

	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
		
		 if(!fileFormat.match(/.png|.jpg|.jpeg/)) {

		 //filter the file type
		 alert('please upload one png/jpg/jpeg file');
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