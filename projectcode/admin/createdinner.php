<?
include("../php/link.php");
session_start();
if(!isset($_SESSION['ACCOUNT'])){//set session variables here since login function is not implemented
	$_SESSION['ACCOUNT'] = 'admin1';
	echo "haven't login";
//	die();
}
$query = "USE 12132031d";
$result = mysql_query($query);

$query = "INSERT INTO dinner VALUES
(NULL,'".$_REQUEST['title']."','".$_SESSION['ACCOUNT']."','".$_REQUEST['restid']."','".$_REQUEST['date']."','".$_REQUEST['description']."')
";
$result = mysql_query($query);
if(!$result){
	echo "fail";
	die();
}
else{
	$id = mysql_insert_id();
}
$query = "INSERT INTO attend VALUES
('".$id."','".$_SESSION['ACCOUNT']."',0)
";
$result = mysql_query($query);
if(!$result){
	echo "fail";
	die();
}
echo "success";
header("Location:forms.php");
?>
