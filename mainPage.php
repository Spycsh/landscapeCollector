<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/mainPage.css" rel="stylesheet" type="text/css" />
    </head>






    <body>
        <?php
        // verify if the user has login
        session_start();
        // echo($_SESSION['userName']);
        if(!isset($_SESSION['userName'])){
            header("Location:login_process.php");
            exit();
        }
        ?>
        <!-- <header class="Header" role="banner"></header> -->
        <header class="Header"><span id="user"><button onclick="location.href='logout.php'">登出</button></span></header>

            <ul class="recordList">

                <li class="recordItem">
                    <div class="recordImage" style="background-image: url(css/img/1.jpg);">
                    </div>
                    <article>
                        <h1>景色名，推荐度</h1>
                        <p>用户头像，昵称，</p>
                        <span>2019/12/23</span>
                        <!-- <p style="text-align: right;"><button value="收藏">收藏</button></p> -->
                    </article>
                </li>
                <li class="recordItem">
                    aaa
                </li>
                <li class="recordItem">
                    aaa
                </li>
                <li class="recordItem">
                    aaa
                </li>
                <li class="recordItem">
                    aaa
                </li>
                <li class="recordItem">
                    aaa
                </li>

            </ul>
       
    </body>
</html>