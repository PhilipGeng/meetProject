<?php
include("../php/link.php");
session_start();
if(!isset($_SESSION['ACCOUNT'])){//set session variables here since login function is not implemented
	echo "haven't login";
//	die();
}
$query = "UPDATE attend SET mark = '".$_REQUEST['mark']."' WHERE dinner_id='".$_REQUEST['dinnerid']."' and participant = '".$_REQUEST['user']."';";
$result = mysql_query($query);
if(!$result){
	echo $query;
	echo "fail";
	die();
}
$query = "SELECT score FROM `user` WHERE username = '".$_REQUEST['user']."';";
$result = mysql_query($query);
if(!$result){
	echo "fail";
	die();
}
$row = mysql_fetch_row($result);
$mark = $_REQUEST['mark']+$row[0];
$query = "UPDATE `user` SET score = '".$mark."' WHERE username = '".$_REQUEST['user']."';";
$result = mysql_query($query);
if(!$result){
	echo "fail";
	die();
}
echo "success";
header("Location:marks.php");
?>
