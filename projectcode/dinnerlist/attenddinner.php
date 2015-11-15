<?
include("../php/link.php");
session_start();
if(!isset($_SESSION['ACCOUNT'])){//set session variables here since login function is not implemented
	echo "haven't login";
//	die();
}
$query = "INSERT INTO attend VALUES
('".$_REQUEST['id']."','".$_SESSION['ACCOUNT']."',0)
";
$result = mysql_query($query);
if(!$result){
	echo "You have participated this";
	die();
}
header("Location:dinnerlist.php");
?>
