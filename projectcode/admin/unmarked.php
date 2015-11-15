<?
include("../php/link.php");
session_start();
if(!isset($_SESSION['ACCOUNT'])){
	$login = 0; // haven't login
	$_SESSION['ACCOUNT'] = 'admin1';
}
$query = "USE 12132031d";
$result = mysql_query($query);

$query = "SELECT count(*) from dinner d,attend a,attend b,restaurant r where a.dinner_id=b.dinner_id and d.id = a.dinner_id and a.participant!=b.participant and d.restaurant = r.id and b.mark=0 and a.participant = '".$_SESSION['ACCOUNT']."'";
$result = mysql_query($query);
$row = mysql_fetch_row($result);
echo $row[0];
?>