<?
include("../php/link.php");
session_start();
if(!isset($_SESSION['ACCOUNT'])){
	$login = 0; // haven't login
	$_SESSION['ACCOUNT'] = 'admin1';
}
$query = "USE 12132031d";
$result = mysql_query($query);

$query = "SELECT count(*) from attend a,dinner d where a.participant = '".$_SESSION['ACCOUNT']."' and a.dinner_id=d.id and a.mark=0 and d.`time`>now()";
$result = mysql_query($query);
$row = mysql_fetch_row($result);
echo $row[0];
?>