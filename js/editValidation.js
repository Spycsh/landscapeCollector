function check(){
	var form=document.forms[0];
	var error="";
	document.getElementById("hint1").innerHTML="";
	document.getElementById("hint2").innerHTML="";
	document.getElementById("hint3").innerHTML="";
	var country=form.edit_country.value;
	if(country==""){
		document.getElementById("hint1").innerHTML="<font color='red'>you have not fill in the country!\n</font>";
	}
	if(/^[a-zA-Z]+$/.test(country)){}
	else{
		document.getElementById("hint1").innerHTML="<font color='red'>the country name is not correct!\n</font>";
		error="false";
		}
	var city=form.edit_city.value;
	if(city==""){
		document.getElementById("hint2").innerHTML="<font color='red'>you have not fill in the city!\n</font>";
		error="false";
	}
	
	if(/^[a-zA-Z]+$/.test(city)){}
	else{
		document.getElementById("hint2").innerHTML="<font color='red'>the city name is not correct!\n</font>";
		error="false";


	}
	
	var comments=form.edit_comment.value;
	if(comments==""){
		document.getElementById("hint3").innerHTML="<font color='red'>you need to fill in the comments!\n</font>";
		error="false";
	} 
	if(comments.length>500){
		document.getElementById("hint3").innerHTML="<font color='red'>the length of the comments can not be longer than 500 words.\n</font>";
		error="false";

	}

	if (error != "") {

		return false;
		}
	

}