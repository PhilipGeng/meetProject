<?
include("../php/link.php");
session_start();
if(!isset($_SESSION['ACCOUNT'])){
	$_SESSION['ACCOUNT'] = "admin1";
	$_SESSION['NATIONALITY'] = "HONGKONG";
}
$query = "USE 12132031d";
$result = mysql_query($query);
if($result) echo "select schema success"; 
else echo "select schema fail";  
echo "<br>"; 

$query = "SELECT * FROM attend a where participant = '".$_SESSION['ACCOUNT']."' ";
$result = mysql_query($query);
if($result) echo "data query success";    
else echo "data query fail";    
echo "<br>";    
	
 	$mark_res = array(0,0,0,0,0);
	for($counter = 0;$row = mysql_fetch_row($result);$counter++){
		if($row[2]==0) continue;
		$mark_res[$row[2]-1]++;
	}
	print_r($mark_res);

$query = "select b.participant, count(b.participant) from attend a,attend b where a.dinner_id=b.dinner_id and a.participant!=b.participant and a.participant='".$_SESSION['ACCOUNT']."' group by participant
";
$result = mysql_query($query);

$mark = array();
for($counter = 0;$row = mysql_fetch_row($result);$counter++){
    array_push($mark,$row);
}
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year','number of dinner'],
          ['1 mark',<? echo $mark_res[0]; ?>],
          ['2 mark',<? echo $mark_res[1]; ?>],
          ['3 mark',<? echo $mark_res[2]; ?>],
          ['4 mark',<? echo $mark_res[3]; ?>],
          ['5 mark',<? echo $mark_res[4]; ?>]
        ]);

        var options = {
          title: 'Personal marks for <? echo $_SESSION['ACCOUNT']; ?>'
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

        chart.draw(data, options);
          
        
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>