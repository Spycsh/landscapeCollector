<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/mainPage.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <?php
        // verify if the user has login
        session_start();

        // 如果session是空则跳转到login界面
        if(!isset($_SESSION['userName'])){
            echo($_SESSION['userName']);
            // header("Location:login_process.php");
            header("Location:index.html");
            exit();
        }
    ?>

    <header id="header" class="site-header">
        <span id="caption">Landscape Collector</span>
        <button id="logout" title="log out" onclick="location.href='logout.php'"></button>
    </header>

    <main id="main">

        <form name="searchform" style="text-align:center">
            
            <input type="text" id="inputBox" placeholder="search the landscape!">
            <button><i class="fa fa-search"></i></button>
        </form>

        <div class="page-header"></div>
        <ul class="post-list clearfix show">

            <li class="post-item grid-item">
                <a class="post-link" href="/simple-gulp-configuration-for-angular-applications/">
                    <div class="recordImage" style="background-image: url(css/img/1.jpg);">
                    </div>
                    <article>
                        <h1>景色名，推荐度</h1>
                        <p>用户头像，昵称，</p>
                        <span>2019/12/23</span>
                        <!-- <p style="text-align: right;"><button value="收藏">收藏</button></p> -->
                    </article>
                </a>

            </li>
            <li class="recordItem">
                <a class="post-link" href="/simple-gulp-configuration-for-angular-applications/">
                    aaa
                </a>

            </li>
            <li class="recordItem">
                <a class="post-link" href="/simple-gulp-configuration-for-angular-applications/">
                    aaa
                </a>

            </li>
            <li class="recordItem">
                <a class="post-link" href="/simple-gulp-configuration-for-angular-applications/">
                    aaa </a>

            </li>
            <li class="recordItem">
                <a class="post-link" href="/simple-gulp-configuration-for-angular-applications/">
                    aaa </a>

            </li>
            <li class="recordItem">
                <a class="post-link" href="/simple-gulp-configuration-for-angular-applications/">
                    aaa </a>

            </li>

            

        </ul>
        <nav id="page-nav" class="show">
            <span class="page-number current">1</span>
            <a class="page-number" href="/page/2/">2</a>
            <a class="extend next" rel="next" href="/page/2/">Next</a>
        </nav>
    </main>
</body>

</html>