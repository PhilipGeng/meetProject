<?php
	include("../php/link.php");
	$account = $_REQUEST['account'];
	$password = $_REQUEST['pwd'];
	$nationality = $_REQUEST['nationality'];
	session_start();
	$_SESSION['ACCOUNT'] = $account;
	$_SESSION['NATIONALITY'] = $nationality;
	$_SESSION['SCORE'] = 0;

$query = "USE 12132031d";
$result = mysql_query($query);
if(!$result){
	echo "fail";
    session_destroy();
	header("Location:signup.html");
}
$query = "INSERT INTO user VALUES
('".$account."','".$password."','".$nationality."',0);
";
$result = mysql_query($query);
if(!$result){
	echo "fail";
    session_destroy();
	header("Location:signup.html");
}
else{
	echo "success";
    header("Location:../home.html");
}
?>