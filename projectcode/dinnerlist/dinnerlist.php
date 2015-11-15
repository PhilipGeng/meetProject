<?
include("../php/link.php");
session_start();
$login = 1; // login
if(!isset($_SESSION['ACCOUNT'])){
	$login = 0; // haven't login
}
$query = "USE 12132031d";
$result = mysql_query($query);

$query = "select d.id,d.title,d.`time`,d.description,r.id,d.initiator,u.nationality,u.score,r.name,r.location,a.participant,a.mark,l.lat,l.lng from `user` u, dinner d, attend a, restaurant r,restloc l where a.dinner_id = d.id and d.restaurant = r.id and d.initiator = u.username and r.id=l.id;";
$result = mysql_query($query);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<link href="bootstrap.min.css" rel="stylesheet">
<link href="bootstrap.css" rel="stylesheet">
<link href="dinnerlist.css" rel="stylesheet">

    <title>Geocoding service</title>
    <style>
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script>
	var resset = new Array();
	var now = new Date();
	/* 
	[0] dinner id
	[1] dinner title		
	[2] dinner time
	[3] dinner description
	[4] restaurant id
	[5] dinner initiator account/username/id
	[6] initiator nationality
	[7] initiator score
	[8] restaurant name
	[9] restaurant location
	[10] participant account/username/id
	[11] participant mark from this dinner(1-5), 0 means pending
	[12] lat
	[13] lng
	*/

	<? 
	for($counter = 0;$row = mysql_fetch_row($result);$counter++){   // please refer to your mysql browser to determine the result set	
		echo "resset[$counter] = new Array();\n";
		for($cnt = 0;$cnt<14;$cnt++)
			echo "resset[$counter][$cnt] = '$row[$cnt]';\n ";
	}
	?>
	
	function removeExpire(arr){
		res = new Array();
		for(var i=0;i<arr.length;i++){
			var date = new Date(arr[i][2]);
			if(date.getTime()>now.getTime())
				res.push(arr[i]);
		}
		return res;
	}

	function removeFuture(arr){
		res = new Array();
		for(var i=0;i<arr.length;i++){
			var date = new Date(arr[i][2]);
			if(date.getTime()<now.getTime())
				res.push(arr[i]);
		}
		return res;
	}

	function removeMarked(arr){
		res = new Array();
		for(var i=0;i<arr.length;i++){
			if(arr[i][11]==0)
				res.push(arr[i]);
		}
		return res;
	}

	function removeUnmarked(arr){
		res = new Array();
		for(var i=0;i<arr.length;i++){
			if(arr[i][11]!=0)
				res.push(arr[i]);
		}
		return res;

	}
	function part_arr(arr,name){
		res = new Array();
		for(var i=0;i<arr.length;i++){
			if(arr[i][10]==name)
				res.push(arr[i]);
		}
		return res;

	}

	function init_arr(arr,name){
		res = new Array();
		for(var i=0;i<arr.length;i++){
            if(arr[i][5]==name)
				res.push(arr[i]);
		}
		return res;

	}
    function removePart(arr){
        res = new Array();
        var name="<?php echo $_SESSION['ACCOUNT']; ?>";
        for(var i=0;i<arr.length;i++){
            if(arr[i][5]!=name){
                res.push(arr[i]);
            }
        }
        return res;
    }
	function distinct(arr){
		arr = arr.sort();
		res = new Array();
		res.push(arr[0]);
		for(var i=1;i<arr.length;i++){
			if(arr[i][0]>arr[i-1][0])
				res.push(arr[i]);
		}
		return res;
	}
	function display(arr){
		var content = "";
		if(document.getElementById("cb").checked)
			arr = distinct(arr);
		for(var i=0;i<arr.length;i++){
			//content+=arr[i][1];
			//content+="<br>";
            content+="<div class='col-md-10 blogShort'><div class='mapholder' id='maph"+i+"'></div><h1>"+arr[i][1]+"</h1><em>Initiator:"+arr[i][5]+" "+arr[i][6]+" "+arr[i][7]+"<br/>Date&Time:"+arr[i][2]+"<br/>Restaurant:"+arr[i][8]+" "+arr[i][9]+"</em><article><h3>"+arr[i][3]+"</h3></article><a class='btn btn-blog pull-right marginBottom10' id='"+arr[i][0]+"' href='attenddinner.php?id="+arr[i][0]+"'>Participate</a></div>";
		}
		document.getElementById("result").innerHTML = content;
		for(var i=0;i<arr.length;i++){
			initmap(arr[i][12],arr[i][13],i)
		}
	
	}

	function future(){
		var tmp = resset;
		tmp = removeExpire(tmp);
        tmp = removePart(tmp);
		display(tmp);
	}
	function expired(){
		var tmp = resset;
		tmp = removeFuture(tmp);
        tmp = removePart(tmp);
		display(tmp);
	}
	function marked(){
		var tmp = resset;
		tmp = removeUnmarked(tmp);
		display(tmp);
	}
	function unmarked(){
		var tmp = resset;
		tmp = removeMarked(tmp);
		display(tmp);
	}
	function participated(name){
		var tmp = resset;
		tmp = part_arr(tmp,name);
		display(tmp);
	}
	function initiated(name){
		var tmp = resset;
        tmp = init_arr(tmp,name);
		display(tmp);
	}
	function cblistener(){
		var obj = document.getElementById("cb");
		var prompt = document.getElementById("cmt");
		if(obj.checked){
			prompt.innerHTML = "distinct dinner only";
		}
		else{
			prompt.innerHTML = "all records";
		}
	}

function initmap(lat,lng,index) {
	var latlng = new google.maps.LatLng(lat,lng);
	var mapOptions = {
		zoom: 13,
		center: latlng
	}
	mapid = "maph"+index;
	map = new google.maps.Map(document.getElementById(mapid), mapOptions);
	var marker = new google.maps.Marker({
		map: map,
		position: latlng
	});
}

    </script>
  </head>
  <body>
    <div class="btn-group btn-group-justified" role="group">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-primary" id = "future" onclick = "future()">Future</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-success" id = "expired" onclick = "expired()">Expired</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-info" id = "pendingformark" onclick = "unmarked()">Pending</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-warning" id = "marked" onclick = "marked()">Marked</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-danger" id = "displayall" onclick = "participated('<? echo $_SESSION['ACCOUNT']; ?>')">Participated</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default" id = "displayall" onclick = "initiated('<? echo $_SESSION['ACCOUNT']; ?>')">My Dinner</button>
            </div>
	</div>
    </br>
    <input type="checkbox" id="cb" onclick="cblistener()" style="margin-left:auto;margin-right:auto;"> Distinct Dinner:</input><span id="cmt">all records</span>
	<div id="result"></div>
  </body>
</html>





