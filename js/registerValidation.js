function check(){
	var form=document.forms[0];
	var error="";
	document.getElementById("hint").innerHTML="";
	document.getElementById("hint2").innerHTML="";
	var str=form.password.value;
	if(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}$/.test(str)){	}
	else{
		document.getElementById("hint").innerHTML="<font color='red'>The password does not comply with the standard.\n</font>";
		document.getElementById("hint2").innerHTML="<font color='red'>The password does not comply with the standard.\n</font>";
		document.getElementById("password").value="";
		document.getElementById("confirmPassword").value="";
		return false;
//		error="the password does not comply with the standard.\n";
		}
	
//	if (error != "") {
//
//		var errorText = "Your problem is:\n";
//		errorText = errorText + error;
//		window.alert(errorText);
//		return false;
//		}
}