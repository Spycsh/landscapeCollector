/**
 * check if user really want to delete the record and back to main page
 */
function deleteRecord(id){
	
	 var del=confirm("Are your sure to delete this record?");
	    if(del==true){
	         
	    }else{
	        return;
	    }
	    
	document.cookie="delete_rid="+id;

	window.location.href = '../window/mainPage.php';

}



