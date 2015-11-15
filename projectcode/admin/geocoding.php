<?
include("../php/link.php");
session_start();
if(!isset($_SESSION['ACCOUNT'])){//set session variables here since login function is not implemented
	$_SESSION['ACCOUNT'] = "admin1";
	$_SESSION['NATIONALITY'] = "HONGKONG";
}
$query = "USE 12132031d";
$result = mysql_query($query);

$query = "SELECT * FROM restaurant r,restloc l WHERE r.id=l.id and l.lat!='';";//change the SQL here
$result = mysql_query($query);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Geocoding service</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
      #panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: -180px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script>
var geocoder;
var map;
var cnt=0;
function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(22.31248, 114.174);
  var mapOptions = {
    zoom: 13,
    center: latlng
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
var cnt = 0;
	var resset = new Array();
	<? 
	for($counter = 0;$row = mysql_fetch_row($result);$counter++){   // please refer to your mysql browser to determine the result set
		echo "resset[$counter] = new Array();\n";
		echo "resset[$counter][0] = '$row[0]';\n ";
		echo "resset[$counter][1] = '$row[1]';\n ";
		echo "resset[$counter][2] = '$row[2]';\n ";
		echo "resset[$counter][3] = '$row[3]';\n ";
		echo "resset[$counter][4] = '$row[4]';\n ";
		echo "resset[$counter][5] = '$row[5]';\n ";
		echo "addmarkers(resset[$counter]);";
	}

	?>

}

function addmarkers(arr){
		cnt++;

			var geo_location = new google.maps.LatLng(arr[4],arr[5]);
      				var marker = new google.maps.Marker({
        					map: map,
        					position: geo_location
      				});
 			var contentString = '<div id="content">'+
			'<h1 id="firstHeading" class="firstHeading">'+arr[1]+'</h1>'+
			'<div id="bodyContent">'+
			'<p><b>location:</b>'+arr[2] +'</p>'+
			'</div>'+
			'</div>'; //arr[0]-restaurant id; 1-name; 2-location; 3-dinnerid; 4-lat;5-lng
				var infowindow = new google.maps.InfoWindow({
					content: contentString
				});
				google.maps.event.addListener(marker, 'click', function() {
                                              infowindow.open(map,marker);
                                              var xmlhttp;
                                              if (window.XMLHttpRequest)
                                              {// code for IE7+, Firefox, Chrome, Opera, Safari
                                              xmlhttp=new XMLHttpRequest();
                                              }
                                              else
                                              {// code for IE6, IE5
                                              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                                              }
                                              xmlhttp.onreadystatechange=function()
                                              {
                                              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                                              {
                                              }
                                              }
                                              var location=arr[2].replace("&","");
                                              xmlhttp.open("GET","setsession.php?location="+location+"&restid="+arr[0],true);
                                              xmlhttp.send();
				});
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
<div id="c"></div>
    <div id="map-canvas"></div>
  </body>
</html>