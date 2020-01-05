<?php
require_once "DBController.php";
require_once (dirname(dirname(__FILE__)) . "\model\Record.php");

// controller to control the user search behavior
class SearchController
{

    // var $user;
    var $db;

    var $outJson;

    function searchRecords($keyword, $pageNum = 1)
    {
        // $records = $this->db->getRecords();
        // find records which fulfill the keywords
        $allRecords = $this->db->searchRecordsWithKeyword($keyword);

        // get the records of specific page number
        $records = array_slice($allRecords, ($pageNum - 1) * 6, 6);

        $outputStr = "";
        $outArray = array();

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

            $outputStr .= "      <li class='post-item grid-item'>
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
        $outArray["content"] = $outputStr;

        $navInfo = "";
        $leftOmitFlag = false;
        $rightOmitFlag = false;
        $AllPagesNum = ceil(count($allRecords) / 6);
        
        if($pageNum!=1){
            $prevPage = $pageNum -1;
            $navInfo .= "<a class='extend prev' rel='prev' onclick=searchByPage($prevPage)>Prev</a>";
        }

        for ($k = 1; $k <= $AllPagesNum; $k ++) {
            // if the page is not current page then emphasize it
            if($k==$pageNum){
                $navInfo .= "<span class='page-number current'>$k</span>";

            } 
            else if(($k>=$pageNum-1&& $k<=$pageNum+1)||$k==1||$k==$AllPagesNum){ 
                $navInfo .= "<a class='page-number' onclick=searchByPage($k)>$k</a>";
            }
            else if(!$leftOmitFlag&&$k<$pageNum){
                $navInfo .= "...";
                $leftOmitFlag = true;
            }
            else if(!$rightOmitFlag&&$k>$pageNum){
                $navInfo .= "...";
                $rightOmitFlag = true;
            }
            // $navInfo .= "<a class='page-number' onclick='searchByPage($k)'>$k</a>";
        }

        if(($pageNum!=$AllPagesNum)&&$AllPagesNum!=1&&$AllPagesNum!=0){
            $nextPage = $pageNum +1;
            $navInfo .= "<a class='extend next' rel='next' onclick=searchByPage($nextPage)>Next</a>";
        }

        $outArray["navInfo"] = $navInfo;

        echo json_encode($outArray);
    }
}

$keyword = $_POST['content'];

// echo($keyword);

$sc = new SearchController();
$sc->db = new DBController();
$sc->db->connect();
// $rc->createUser($_POST["userName"],$_POST["password"],$_POST["confirmPassword"],$_FILES['myPicture']['name']);

// $rc->displayUserInfo($rc->registerID);
// if(isset($pageNum)){
// get selected page and return the six records
$pageNum = $_POST['pageNum'];
$sc->searchRecords($keyword, $pageNum);
// }
// else{
// always start at the first page
// $sc->searchRecords($keyword, 1);
// }

$sc->db->disconnect();

?>