<!DOCTYPE html>

<html>
<meta name="viewport" charset="utf-8"
	content="width=device-width, initial-scale=1.0">
	<title>create your record</title>
<head>
<link href="./CreateRecordWindow.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="content">

		<h1>Share your Landscape!</h1>

		<div id="main">



			<form method="post" action="RecordController.php">
				<label> your name: </label> 
				<input type="text" name="create_name"> <br>
				 <label>country: </label> 
				 <input type="text" name="create_country"> <br> 
				 <label>city: </label> 
				 <input type="text" name="create_city"> <br>


					<label>click button to choose your picture</label> <br> 
					<input type="file" name="create_picture" id="chooseImage"> <br>
					
					
			
				<div id="imagePreview">
					<img src="#" id="image">
				</div>

			

				<div id="commentDiv">
				<label>your comment: </label> <textarea rows="10" cols="30" name="create_comment"
					id="comment" ></textarea> <br> 
				</div>	
				
					<div id="starDiv">
					<label>recommendation:</label> 
					
					
					<input type="hidden" value="" name="create_star" id="star">
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