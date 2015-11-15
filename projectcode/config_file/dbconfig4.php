<?
include("../php/link.php");
$query = "USE 12132031d";
$result = mysql_query($query);
if($result) echo "select schema success";
else echo "select schema fail";
echo "<br>";

$query = "SELECT * FROM restloc r where lat='';";
$result = mysql_query($query);
if(!$result){
	echo "fail2";
	//die():
}
for($counter=0;$row=mysql_fetch_row($result);$counter++){
	echo $counter." : ".$row[0]."\n";
	$q = "DELETE FROM restloc WHERE id=$row[0]";
	$r = mysql_query($q);
	if(!$r){
	echo "fail2";
	//die():
	}
	$q = "DELETE FROM restaurant WHERE id=$row[0]";
	$r = mysql_query($q);
	if(!$r){
	echo "fail3";
	//die():
	}
}
?>