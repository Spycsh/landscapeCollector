<!-- main page & search page -->

<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<link href="../css/font-awesome.min.css" rel="stylesheet"
	type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/mainPage.css" rel="stylesheet" type="text/css"
	charset="utf-8" />
<!-- <link href="css/star.css"rel="stylesheet" type="text/css" /> -->
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/search.js"></script>
<script src="../js/changePage.js"></script>
<script src="../js/showRecord.js"></script>

</head>

<body>
    <?php
    require_once "../controller/DBController.php";
    $db = new DBController();
    $db->connect();
    // verify if the user has login
    session_start();
    // if session is empty, then go to login
    if (! isset($_SESSION['userName'])) {
        echo ($_SESSION['userName']);
        // header("Location:login_process.php");
        header("Location:../window/login.html");
        exit();
    }
    // print_r($_COOKIE);
    //if delete_rid exists, then delete the record in the database
    if (isset($_COOKIE["delete_rid"])) {
        $RID = $_COOKIE["delete_rid"];
        $db->deleteRecord($RID);
    }
    ?>
    

    <header id="header" class="site-header">
    <div class='logoDiv'>
		<img id="logo" src = '../css/img/logo.png'></img>
	</div>
	<div class='caption'>
		<h1 id="caption">LANDSCAPE COLLECTOR</h1>
	</div>
		<button id="logout" title="log out"
			onclick="location.href='../controller/logout.php'"></button>
		<span class="space"></span>
        <?php
        // get profile of current user
        $curID = $_SESSION['userID'];
        $curUser = $db->getUserInfoById($curID);
        if ($curUser['image'] != '') {
            $userProfileURL = '../uploads/userProfile/' . $curUser['image'];
        } else {
            $userProfileURL = '../uploads/userProfile/' . "default.jpg";
        }
        $db->disconnect();
        echo "<img src=$userProfileURL class='curProfile'></img>"?>
        
        
    </header>
	<div class="operation">
		<div id="search" style="text-align: center;">



			<input type="text" id="inputBox"
				placeholder="search a city, country or a user!">
			<button>
				<i class="fa fa-search" onclick="searchByPage(1)"></i>
			</button>


		</div>
		<button class="addBtn"
			onclick="location.href='../window/createRecordWindow.php'">
			<i class="fa fa-plus"></i>
		</button>
	</div>

	<main id="main">





	<div class="page-header"></div>
	<ul id="recordList" class="post-list clearfix show">
		<!-- display all records here -->

		<!-- require_once ("../controller/displayRecordsController.php"); -->

		<!-- change to current page, for the first time just change to first page -->
            <?php
            // session_start();
            if (! isset($_SESSION['curPageNum'])) {
                $_SESSION['curPageNum'] = 1;
            }
            echo ("<script>changePage(" . $_SESSION['curPageNum'] . ")</script>");
            ?>
            <!-- <script>changePage(1);</script> -->

		<li class="post-item grid-item"><a class="post-link">
				<div class="recordImage"
					style="background-image: url(../css/img/1.jpg);"></div>
				<article>
					<h1>name,recommend</h1>
					<!-- <p>user image,name</p> -->
					<!-- <div id="starDiv"> -->
					<label style="float: left"></label>

					<!-- <input type="hidden" value="" name="star" id="star"> -->
					<span class="star"></span> <span class="star"></span> <span
						class="star"></span> <span class="star"></span> <span
						class="noStar"></span>
					<!-- <span title="1" id="1" class="star"></span>
                                <span title="2" id="2" class="star"></span>
                                <span title="3" id="3" class="star"></span>
                                <span title="4" id="4" class="star"></span>
                                <span title="5" id="5" class="noStar"></span> -->
					<!-- </div> -->
					<br> <span id="authorInfo">2019/12/23
						</div> <!-- <p style="text-align: right;"><button value="Ã¦â€�Â¶Ã¨â€”ï¿½">Ã¦â€�Â¶Ã¨â€”ï¿½</button></p> -->
				
				</article>
		</a></li>




	</ul>

	<nav id="page-nav" class="show">
		<!-- <span class="page-number current">1</span> -->
            <?php
            // require_once "../controller/DBController.php";
            // $db = new DBController();
            // $db->connect();
            // $pageNum = $db->getPageNum();
            // $db->disconnect();
            // for ($i = 1; $i <= $pageNum; $i ++) {
            //     echo "<a class='page-number' onclick=changePage($i)>$i</a>";
            // }
            ?>
            <!-- <a class="page-number" onclick=changePage(1)>1</a>
            <a class="page-number" onclick=changePage(2)>2</a>
            <a class="page-number" onclick=changePage(3)>3</a> -->
		<!-- <a class="extend next" rel="next" href="/page/2/">Next</a> -->
	</nav>
	</main>
</body>

</html>