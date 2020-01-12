function check(){

	
	var form=document.forms[0];
	var error="";
	document.getElementById("hint1").innerHTML="";
	document.getElementById("hint2").innerHTML="";
	document.getElementById("hint3").innerHTML="";
	var country=form.edit_country.value;
	//check if the name of the country is empty
	if(country==""){
		document.getElementById("hint1").innerHTML="<font color='red'>you have not fill in the country!\n</font>";
		error="false";
	}
	//the country name should be a string
	if(/^[a-zA-Z]+$/.test(country)){}
	else{
		document.getElementById("hint1").innerHTML="<font color='red'>the country name is not correct!\n</font>";
		error="false";
		}
	var city=form.edit_city.value;
	//check if the name of the city is empty
	if(city==""){
		document.getElementById("hint2").innerHTML="<font color='red'>you have not fill in the city!\n</font>";
		error="false";
	}
	//the name of the city need to be a string
	if(/^[a-zA-Z]+$/.test(city)){}
	else{
		document.getElementById("hint2").innerHTML="<font color='red'>the city name is not correct!\n</font>";
		error="false";
	}
	
	var comments=form.edit_comment.value;
	//check if the comment have been filled in
	if(comments==""){
		document.getElementById("hint3").innerHTML="<font color='red'>you need to fill in the comments!\n</font>";
		error="false";
	} 
	//the limited of comments is 500 words
	if(comments.length>500){
		document.getElementById("hint3").innerHTML="<font color='red'>the length of the comments can not be longer than 500 words.\n</font>";
		error="false";

	}
	
	var select = document.getElementById('chooseImage').value;  // identify the user has changed the image
	//check if the user have upload a new picture
    if(select=='') {
    	if (error!="") {
    		document.body.scrollTop = 0;
    		return false;
    		}
    }
    else{
    	//if the user upload a new picture, the size need to be checked.
    	var fileId="chooseImage";
    	var img=document.getElementById(fileId);
    	var imgSize=img.files[0].size;
    	var size=imgSize/1024;
    	if(size>200000){
    		document.getElementById("hint4").innerHTML="<font color='red'>The picture need to smaller than 200M.\n</font>";
    		error="false";
    	}
//if there are any error, the form will not be uploaded
    	if (error!="") {
    		document.body.scrollTop = 0;
    		return false;
    		}
    }
	

	

}