//send information to the search controller by ajax
function searchByPage(pageNum=1){
    var keyword = document.getElementById("inputBox").value;
    // alert(pageNum);
    $.ajax({
        url: '../controller/searchController.php',
        type: 'post',
        data: {"content":keyword,"pageNum":pageNum},
        dataType: 'JSON',
        success: function(data){
            document.getElementById("recordList").innerHTML = data['content'];
            // alert(data);
            document.getElementById("page-nav").innerHTML = data['navInfo'];
        }
    });
    
}
