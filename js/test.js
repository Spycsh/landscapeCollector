// 用到jquery
var stars = $(".star_score")[0].children;
for(var i=0;i<stars.length;i++){
    stars[i].addEventListener("mouseover",function(){
        var rating = event.target.id; // 获取发生事件对象的id名
        for(var j=0;j<rating;j++){
            if(stars[j].className!="select"){
            stars[j].setAttribute("class", "active");

            }
        }
    })

    stars[i].addEventListener("mouseleave",function(){
        var rating = event.target.id; // 获取发生事件对象的id名
        for(var j=0;j<rating;j++){
            if(stars[j].className!="select"){
                            stars[j].setAttribute("class", "");

            }
        }
    })

    stars[i].addEventListener("click",function(){
        var rating = event.target.id; // 获取发生事件对象的id名
        for(var j=0;j<rating;j++){
            stars[j].setAttribute("class", "select");
        }
        for(var k=rating;k<stars.length;k++){
            stars[k].setAttribute("class","");
        }
    })
}
