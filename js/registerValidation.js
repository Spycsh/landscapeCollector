function check(){
	var form=document.forms[0];
	var error="";
	document.getElementById("hint").innerHTML="";
	document.getElementById("hint1").innerHTML="";
	document.getElementById("hint2").innerHTML="";
	document.getElementById("hint3").innerHTML="";

	var name=form.userName.value;
	$.ajax({
		type:"post",
		url:'../controller/RegisterController.php',
		async:false,	//must be set since the variable error will never change to "false" because ajax is default asynchronize
	    data: {"name":name},
	    dataType: 'text',
		success:function(data){
			if(data=='false'){
				
				document.getElementById("hint1").innerHTML="<font color='red'>The name has been used.\n</font>";
	    		document.body.scrollTop = 0;
				error="false";
				
			}
		
		}
	});

	
	
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
    		document.body.scrollTop = 0;
			error="false";
		}
		else{
	        var con2=confirm("are you sure to use the picture?");
	        if(con2==true){
	        	
	        }
	        else{
	        	return false;
	        }
		}
    }


	
	
	var str=form.password.value;
	var str2=form.confirmPassword.value;
	
	if(str===str2){
		
	}
	else{
		document.getElementById("hint2").innerHTML="<font color='red'>The passwords are not the same.\n</font>";
		document.body.scrollTop = 0;
		return false;
	}
	
	
	if(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{8,10}$/.test(str)){	}
	else{
		document.getElementById("hint").innerHTML="<font color='red'>The password does not comply with the standard.\n</font>";
		document.getElementById("hint2").innerHTML="<font color='red'>The password does not comply with the standard.\n</font>";
		document.getElementById("password").value="";
		document.getElementById("confirmPassword").value="";
		document.body.scrollTop = 0;
		error="false";
		}
	

	if (error != "") {
		alert("22");
		return false;
		}
}



