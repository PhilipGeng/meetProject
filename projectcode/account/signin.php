<?php
	include("../php/link.php");
	$account = $_REQUEST['account'];
	$password = $_REQUEST['pwd'];
	if(isset($_SESSION['ACCOUNT'])){
		echo "already login";
		die();
	}
	$query = "USE 12132031d";
	$result = mysql_query($query);
	if(!$result){
		echo "fail";
		die();
	} 
	
	$query = "SELECT * FROM user WHERE username='".$account."';";//change the SQL here
	$result = mysql_query($query);
	if(!$result){
		echo "fail";
        header("Location:signin.html");
	} 

	$row = mysql_fetch_row($result);
	if(strcmp($row[1],$password)==0&&strlen($password)>0){
		session_start();
		echo "success";
		$_SESSION['ACCOUNT'] = $account;
		$_SESSION['NATIONALITY'] = $row[2];
		$_SESSION['SCORE'] = $row[3];
        header("Location:../home.html");
	}
    else{
		echo "fail";
        session_destroy();
        header("Location:signin.html");
    }

?>