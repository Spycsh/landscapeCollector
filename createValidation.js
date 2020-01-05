function check(){
	var form=document.forms[0];
	var error="";
	var country=form.create_country.value;
	if(country==""){
		error=error+"you have not fill in the country!\n";	
	}
	if(/^[a-zA-Z]+$/.test(country)){}
	else{
		error=error+"the country name is not correct!\n";
		}
	
	var city=form.create_city.value;
	
	if(city==""){
		error=error+"you have not fill in the city!\n";
	}
	
	if(/^[a-zA-Z]+$/.test(city)){}
	else{
		error=error+"the city name is not correct!\n";
	}

	var comments=form.create_comment.value;
	if(comments==""){
		error=error+"you need to fill in the comments!\n";
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
		error=error+"the lenth of the comments can not be longer than 500 words.\n"
	}
    
	if (error != "") {
		
		var errorText = "You forgot to fill in following fields:\n";
		errorText = errorText + error;
		window.alert(errorText);
		return false;
		}
}