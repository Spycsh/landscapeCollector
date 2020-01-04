//send page information to controller
function changePage(pageNum){
    // var page = document.getElementById("inputBox").value;
    // alert(pageNum);
    var pageNum = pageNum;
    // document.getElementsByClassName('page-number')[pageNum].className = "page-number current";

    $.ajax({
        url: '../controller/ChangePageController.php',
        type: "POST",
        data: {"content":pageNum},
        dataType: 'JSON',
        success: function(data){
            //  echo(data['recordHTML']);
            document.getElementById("recordList").innerHTML = data['recordHTML'];
            document.getElementById("page-nav").innerHTML = data['navHTML'];
        }
    });
    // alert(document.getElementsByClassName('page-number')[pageNum-1]);
}