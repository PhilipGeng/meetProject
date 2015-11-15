<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php

include("../php/link.php");
$query = "USE 12132031d";
$result = mysql_query($query);
if($result) echo "select schema success";
else echo "select schema fail";
echo "<br>";

$query = "CREATE TABLE dinner(
	id INT(5) NOT NULL auto_increment,
	title VARCHAR(150) DEFAULT '' NOT NULL,
	initiator VARCHAR(32) DEFAULT'' NOT NULL,
	restaurant VARCHAR(10) NOT NULL,
	time datetime DEFAULT '0000-00-00 00:00:00',
	description VARCHAR(300) DEFAULT 'description',
	PRIMARY KEY (id)
);";
$result = mysql_query($query);
if($result) echo "create dinner table success";
else echo "create dinner table fail";
echo "<br>";

$query = "INSERT INTO dinner VALUES
(NULL,'test dinner 1','admin1','3715038319','2014-12-16 20:00:00','description'),
(NULL,'test dinner 2','admin2','3711800024','2014-12-17 20:00:00','description'),
(NULL,'test dinner 3','admin3','3113138901','2014-12-18 20:00:00','description'),
(NULL,'test dinner 4','admin1','3118803062','2014-12-19 20:00:00','description'),
(NULL,'test dinner 5','admin2','3118803521','2014-12-20 20:00:00','description'),
(NULL,'test dinner 6','admin3','3118804029','2014-12-21 20:00:00','description'),
(NULL,'test dinner 7','admin1','3118805314','2014-12-22 20:00:00','description'),
(NULL,'test dinner 8','admin2','3152179374','2014-12-23 20:00:00','description'),
(NULL,'test dinner 9','admin3','3152800896','2014-12-24 20:00:00','description'),
(NULL,'test dinner 10','admin1','3194001608','2014-12-25 20:00:00','description'),
(NULL,'test dinner 11','admin2','3194800801','2014-12-26 20:00:00','description'),
(NULL,'test dinner 12','admin3','3996800511','2014-12-27 20:00:00','description'),
(NULL,'test dinner 13','admin1','3195800738','2014-12-28 20:00:00','description'),
(NULL,'test dinner 14','admin2','3162802770','2014-12-29 20:00:00','description');
";
$result = mysql_query($query);
if($result) echo "insert success";
else echo "insert fail";
echo "<br>";

$query = "CREATE TABLE attend(
	dinner_id INT(5) NOT NULL,
	participant VARCHAR(32) DEFAULT'' NOT NULL,
	mark INT(5) DEFAULT'0'
);";
$result = mysql_query($query);
if($result) echo "create attend table success";
else echo "create attend table fail";
echo "<br>";

$query = "INSERT INTO attend VALUES
(1,'admin1','0'),
(2,'admin2','0'),
(3,'admin3','0'),
(4,'admin1','1'),
(5,'admin2','0'),
(6,'admin3','0'),
(7,'admin1','2'),
(8,'admin2','0'),
(9,'admin3','0'),
(10,'admin1','3'),
(11,'admin2','0'),
(12,'admin3','0'),
(13,'admin1','5'),
(14,'admin2','0');
";
$result = mysql_query($query);
if($result) echo "insert success";
else echo "insert fail";
echo "<br>";

?>
</html>	