function check(){
	var form=document.forms[0];
	var error="";
	document.getElementById("hint").innerHTML="";
	document.getElementById("hint1").innerHTML="";
	document.getElementById("hint2").innerHTML="";
	document.getElementById("hint3").innerHTML="";
//
//	function checkName(){
//		var name=form.userName.value;
//		$.ajax({
//			type="post",
//			url:'../controller/registerController.php',
//	        data: {"content":name},
//	        dataType: 'text',
//	        dataType: 'JSON',
//			success:function(data){
//				
//			}
//		})
//	}
	
	
	var str=form.password.value;
	var str2=form.confirmPassword.value;
	
	if(str===str2){
		
	}
	else{
		document.getElementById("hint2").innerHTML="<font color='red'>The passwords are not the same.\n</font>";
		return false;
	}
	
	
	if(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{8,10}$/.test(str)){	}
	else{
		document.getElementById("hint").innerHTML="<font color='red'>The password does not comply with the standard. Password need to contain uppercase,lowercase, number.The length need to be 8-10.\n</font>";
		document.getElementById("hint2").innerHTML="<font color='red'>The password does not comply with the standard.Password need to contain uppercase,lowercase, number.The length need to be 8-10.\n</font>";
		document.getElementById("password").value="";
		document.getElementById("confirmPassword").value="";	
		error="false";
//		error="the password does not comply with the standard.\n";
		}
	
	
	var select = document.getElementById('headPicture').value;
	
	    if(select=='') {
	        var con=confirm("You did not upload a image. Do you want to use the default user image?");
	        if(con==true){
	        	
	        }
	        else{
	        	return false;
	        }
	    }
	    else {
			var fileId="headPicture";
			var img=document.getElementById(fileId);
			var imgSize=img.files[0].size;
			var size=imgSize/1024;
			
		if(size>200000){
			document.getElementById("hint3").innerHTML="<font color='red'>The picture need to smaller than 200M.\n</font>";
			error="false";
		}
	    }

	
	
	
	if (error != "") {
//
//		var errorText = "Your problem is:\n";
//		errorText = errorText + error;
//		window.alert(errorText);
		return false;
		}
}