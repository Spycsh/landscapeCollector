function check(){
	var form=document.forms[0];
	var error="";
	document.getElementById("hint").innerHTML="";
	document.getElementById("hint2").innerHTML="";
	document.getElementById("hint3").innerHTML="";
	var str=form.password.value;
	if(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}$/.test(str)){	}
	else{
		document.getElementById("hint").innerHTML="<font color='red'>The password does not comply with the standard.\n</font>";
		document.getElementById("hint2").innerHTML="<font color='red'>The password does not comply with the standard.\n</font>";
		document.getElementById("password").value="";
		document.getElementById("confirmPassword").value="";	
		error="false";
//		error="the password does not comply with the standard.\n";
		}
	var fileId="headPicture";
	var img=document.getElementById(fileId);
	var imgSize=img.files[0].size;
	var size=imgSize/1024;
	if(size>200000){
		document.getElementById("hint3").innerHTML="<font color='red'>The picture need to smaller than 200M.\n</font>";
		error="false";
	}
	
	if (error != "") {
//
//		var errorText = "Your problem is:\n";
//		errorText = errorText + error;
//		window.alert(errorText);
		return false;
		}
}