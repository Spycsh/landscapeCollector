function check(){
	var form=document.forms[0];
	var error="";
	var str=form.password.value;
	if(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}$/.test(str)){}
	else{
		error="the password does not comply with the standard.\n";
		}
	
	if (error != "") {
		
		var errorText = "Your problem is:\n";
		errorText = errorText + error;
		window.alert(errorText);
		return false;
		}
}