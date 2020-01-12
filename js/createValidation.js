function check(){
	var form=document.forms[0];
	var error="";
	var country=form.create_country.value;
	document.getElementById("hint1").innerHTML="";
	document.getElementById("hint2").innerHTML="";
	document.getElementById("hint3").innerHTML="";
	//check if the name of the country have not bern filled in
	if(country==""){
		document.getElementById("hint1").innerHTML="<font color='red'>you have not fill in the country!\n</font>";
	}
	// the name of the country need to full of words
	if(/^[a-zA-Z]+$/.test(country)){}
	else{
		document.getElementById("hint1").innerHTML="<font color='red'>the country name is not correct!\n</font>";
		error=".";
		}
	
	var city=form.create_city.value;
	//check if the name of the city is empty
	if(city==""){
		document.getElementById("hint2").innerHTML="<font color='red'>you have not fill in the city!\n</font>";
		error=".";
	}
	//check if the city name is a string
	if(/^[a-zA-Z]+$/.test(city)){}
	else{
		document.getElementById("hint2").innerHTML="<font color='red'>the city name is not correct!\n</font>";
		error=".";
	}

	var comments=form.create_comment.value;
	//check if the comment has been filled in
	if(comments==""){
		document.getElementById("hint3").innerHTML="<font color='red'>you need to fill in the comments!\n</font>";
		error=".";
	}
	//the comments can not be longer than 500 words
	if(comments.length>500){
//		error=error+"the lenth of the comments can not be longer than 500 words.\n";
		document.getElementById("hint3").innerHTML="<font color='red'>the length of the comments can not be longer than 500 words.\n</font>";
		error=".";
	}
	
	var fileId="chooseImage";
	var img=document.getElementById(fileId);
	var imgSize=img.files[0].size;
	var size=imgSize/1024;
	//the size of the image need to be less than 200M
	if(size>200000){
		document.getElementById("hint4").innerHTML="<font color='red'>The picture need to smaller than 200M.\n</font>";
		error="false";
	}
    //if there are any error, the form will not be submitted
	if (error != "") {
		return false;
		}
}