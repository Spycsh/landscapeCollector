<?php
require_once "DBController.php";
require_once (dirname(dirname(__FILE__)) . "\model\Record.php");

// control change page behavior
class ChangePageController
{

    // var $user;
    var $db;

    var $recordList;

    function changePage($pageNum)
    {
        // $records = $this->db->getRecords();
        // the records which fulfill the requirements
        $records = $this->db->searchRecordsByPage($pageNum);

        $ourArray = array();
        $recordHTML = "";
        $navHTML = "";

        // echo count($records);
        for ($i = 0; $i < count($records); $i ++) {

            $country = $records[$i]['country'];
            $city = $records[$i]['city'];
            $picture = $records[$i]['picture'];
            $comment = $records[$i]['comment'];
            $star = $records[$i]['star'];
            $iduser = $records[$i]['iduser'];
            $idrecord = $records[$i]['idrecord'];

            // picture
            $pictureURL = '../uploads/RecordImage/' . $picture;

            // recommend star
            $starStr = '';
            for ($k = 0; $k < $star; $k ++) {
                $starStr .= '<span class="star"></span>';
            }
            for ($j = $star; $j < 5; $j ++) {
                $starStr .= '<span class="noStar"></span>';
            }

            // userName and picture
            $user = $this->db->getUserInfoById($iduser);
            $name = $user['name'];

            if ($user['image'] != '') {
                $userProfileURL = '../uploads/userProfile/' . $user['image'];
            } else {
                $userProfileURL = '../uploads/userProfile/' . "default.jpg";
            }

            // echo($name);
            // echo($userProfile);

            $recordHTML .= "      <li class='post-item grid-item' >
                                <a class='post-link' onclick=showRecord($idrecord)>
                                    <div class='recordImage' style='background-image: url($pictureURL);'>
                                    </div>
                                    <article>
                                        <h1>$country,$city</h1>
                                        <label style='float:left'></label>
                                        $starStr
                                        <br>
                                            <span class='authorInfo'>$name</span>
                                            <span class='space'></span>
                                            <img src='$userProfileURL' class='userProfile'>
                                        
                                    </article>
                                </a>

                                </li>
                        ";
            
            

        }
        $ourArray["recordHTML"] = $recordHTML;
        

        $AllPagesNum = $this->db->getPageNum();
        // set the navigation section html
        // should be like [1]...[5][6][7]...[11]
        // [1] is the first page, [11] is the last page, [6] is the current page
        $leftOmitFlag = false;
        $rightOmitFlag = false;

        if($pageNum!=1){
            $prevPage = $pageNum -1;
            $navHTML .= "<a class='extend prev' rel='prev' onclick=changePage($prevPage)>Prev</a>";
        }

        for($j=1;$j<=$AllPagesNum;$j++){           
            // if the page is not current page then emphasize it
            if($j==$pageNum){
                $navHTML .= "<span class='page-number current'>$j</span>";
            } 
            else if(($j>=$pageNum-1&& $j<=$pageNum+1)||$j==1||$j==$AllPagesNum){ 
                $navHTML .= "<a class='page-number' onclick=changePage($j)>$j</a>";
            }
            else if(!$leftOmitFlag&&$j<$pageNum){
                $navHTML .= "...";
                $leftOmitFlag = true;
            }
            else if(!$rightOmitFlag&&$j>$pageNum){
                $navHTML .= "...";
                $rightOmitFlag = true;
            }
        }
    
        if(($pageNum!=$AllPagesNum)&&$AllPagesNum!=1){
            $nextPage = $pageNum +1;
            $navHTML .= "<a class='extend next' rel='next' onclick=changePage($nextPage)>Next</a>";
        }

        $ourArray["navHTML"] = $navHTML;

        echo json_encode($ourArray);
    }
}

// get the pagenum from ajax
$pageNum = $_POST['content'];
// echo $pageNum;

// store current page number, so that user can return to current page
session_start();
$_SESSION['curPageNum'] = $pageNum;


$cpc = new ChangePageController();
$cpc->db = new DBController();
$cpc->db->connect();
// $rc->createUser($_POST["userName"],$_POST["password"],$_POST["confirmPassword"],$_FILES['myPicture']['name']);

// $rc->displayUserInfo($rc->registerID);

$cpc->changePage($pageNum);



$cpc->db->disconnect();

?>
