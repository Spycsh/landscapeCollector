//send page information to controller
function changePage(pageNum){
    // var page = document.getElementById("inputBox").value;
    // alert(pageNum);
    var pageNum = pageNum;
    $.ajax({
        url: '../controller/ChangePageController.php',
        type: "POST",
        data: {"content":pageNum},
        dataType: 'text',
        success: function(data){
        	 
            document.getElementById("recordList").innerHTML = data;
           
        }
    });
}