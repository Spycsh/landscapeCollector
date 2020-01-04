/**
 * set record id in the cookie and go to show record window
 */
function showRecord(id){    
//    var rid = id;
//    window.location.replace("../window/ShowRecordWindow.php");
//    window.location.href = '../window/ShowRecordWindow.php';    
//    $.ajax({
//        url: '../window/ShowRecordWindow.php',
//        type: 'post',
//        data: {"rid":rid},
//        async: false,
   //     contentType : ' application/x-www-form-urlencoded',
     //   dataType: 'text',
//        traditional:true,
//        success: function(msg){
//        	alert(msg);
//        	window.location = '../window/ShowRecordWindow.php';
//            alert(window.location);    
//        	document.getElementById("test").innerHTML = "aaa";
//        }
//    });
    
//    return false;
	
//	 sessionStorage.setItem("rid", id);
	
	
	//put rid in the cookie
	document.cookie="rid="+id;

	 window.location.href = '../window/ShowRecordWindow.php'; 
}



