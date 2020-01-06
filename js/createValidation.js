function check(){
	var form=document.forms[0];
	var error="";
	var country=form.create_country.value;
	document.getElementById("hint1").innerHTML="";
	document.getElementById("hint2").innerHTML="";
	document.getElementById("hint3").innerHTML="";
	if(country==""){
//		error=error+"you have not fill in the country!\n";
		document.getElementById("hint1").innerHTML="<font color='red'>you have not fill in the country!\n</font>";
	}
	if(/^[a-zA-Z]+$/.test(country)){}
	else{
//		error=error+"the country name is not correct!\n";
		document.getElementById("hint1").innerHTML="<font color='red'>the country name is not correct!\n</font>";
		error=".";
		}
	
	var city=form.create_city.value;
	
	if(city==""){
		document.getElementById("hint2").innerHTML="<font color='red'>you have not fill in the city!\n</font>";
//		error=error+"you have not fill in the city!\n";
		error=".";
	}
	
	if(/^[a-zA-Z]+$/.test(city)){}
	else{
//		error=error+"the city name is not correct!\n";
		document.getElementById("hint2").innerHTML="<font color='red'>the city name is not correct!\n</font>";
		error=".";
	}

	var comments=form.create_comment.value;
	if(comments==""){
//		error=error+"you need to fill in the comments!\n";
		document.getElementById("hint3").innerHTML="<font color='red'>you need to fill in the comments!\n</font>";
		error=".";
	}
//		  var len = 0;  
//		  for (var i=0; i<comments.length; i++) {  
//		    if (comments.charCodeAt(i)>127 || comments.charCodeAt(i)==94) {  
//		       len += 2;  
//		     } else {  
//		       len ++;  
//		     }  
//		   }  
	if(comments.length>500){
//		error=error+"the lenth of the comments can not be longer than 500 words.\n";
		document.getElementById("hint3").innerHTML="<font color='red'>the length of the comments can not be longer than 500 words.\n</font>";
		error=".";
	}
    
	if (error != "") {
//		
//		var errorText = "You forgot to fill in following fields:\n";
//		errorText = errorText + error;
//		window.alert(errorText);
		return false;
		}
}