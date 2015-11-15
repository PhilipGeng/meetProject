<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
include("./php/link.php");
$query = "USE 12132031d";
$result = mysql_query($query);
if($result) echo "select schema success";
else echo "select schema fail";
echo "<br>";

$query = "CREATE TABLE user(
	username CHAR(32) DEFAULT'' NOT NULL,
	password CHAR(32) DEFAULT'' NOT NULL,
	nationality CHAR(32) DEFAULT'HONGKONG' NOT NULL,
	score INT(5) DEFAULT '0' NOT NULL,
	PRIMARY KEY (username)
);";
$result = mysql_query($query);
if($result) echo "create user table success";
else echo "create user table fail";
echo "<br>";

$query = "INSERT INTO user VALUES
('admin1','12345','HONGKONG',10),
('admin2','12345','MAINLAND',25),
('admin3','12345','FOREIGNER',55);
";
$result = mysql_query($query);
if($result) echo "insert success";
else echo "insert fail";
echo "<br>";

$query = "CREATE TABLE restaurant(
	id CHAR(10) DEFAULT '0000000000' NOT NULL,
	name VARCHAR(32) DEFAULT'' NOT NULL,
	location VARCHAR(150) DEFAULT'' NOT NULL,
	PRIMARY KEY (id)
);";
$result = mysql_query($query);
if($result) echo "create restaurant table success";
else echo "create restaurant table fail";
echo "<br>";

$cnt=0;
$xmlDoc = new DOMDocument();
$xmlDoc->load("http://www.fehd.gov.hk/english/licensing/license/text/LP_Restaurants_EN.XML");
$x = $xmlDoc->documentElement;
foreach ($x->childNodes AS $item){
	foreach ($item->childNodes AS $items){
		if($items instanceof DOMELement && strcmp($items->nodeName,"LP")==0){
			foreach ($items->childNodes AS $items){
				if(strcmp($items->nodeName,"TYPE")==0)
					$type = $items->nodeValue;
				if(strcmp($items->nodeName,"LICNO")==0)
					$id = $items->nodeValue;
				if(strcmp($items->nodeName,"SS")==0)
					$name = $items->nodeValue;
				if(strcmp($items->nodeName,"ADR")==0)
					$location = $items->nodeValue;
			}
			$location = str_replace(","," ",$location);
			if(strlen($name)==mb_strlen($name,'utf-8')&&strcmp($type,"RL")){
				echo $id.",".$name.",".$location."<br>";
				$query = "INSERT INTO restaurant VALUES ($id,'$name','$location');";
				$result = mysql_query($query);
				if($result) $cnt++;
			}

		}
	}
}
echo $cnt." restaurant records inserted";
?>
</html>	