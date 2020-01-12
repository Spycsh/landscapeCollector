/**
 * go back functions used for different pages
 */
function back(){
	window.location.href = '../window/mainPage.php'; 
	// set the back button invisible
	if(document.getElementById("backBtn")!=null){
		document.getElementById("backBtn").style.display = "none";
	}
}



function backToShowRecordWindow(){
	window.location.href = 'ShowRecordWindow.php';
}