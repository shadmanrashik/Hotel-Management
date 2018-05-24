<?php
ob_start();
session_start();
$fileName = $_SERVER['SCRIPT_NAME']; //RETURNS THE ADDRESS OF THE CURRENT PAGE

$userNameRecover;
$securityQuestion;
$info = FALSE;
$alert = FALSE;
$recovery = FALSE;
$GLOBALS['infoType']=0;
date_default_timezone_set("Asia/Dhaka");
$today = date("Y-m-d");
//if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
//    $httpReferer = $_SERVER['HTTP_REFERER'];
//}

function loggedin() {   //checks the current session
    if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
        return true;
    } else {
        return false;
    }
}

function getUserName() {    //returns username for current session
    $query = "SELECT username FROM users where id = '".$_SESSION['userid']."'";
    $queryRun = mysql_query($query);
    echo $userName = mysql_result($queryRun, 0, 'username');
}

function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}