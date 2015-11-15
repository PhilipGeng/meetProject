<?
include("../php/link.php");
$query = "USE 12132031d";
$result = mysql_query($query);
if($result) echo "select schema success";
else echo "select schema fail";
echo "<br>";

class geocoder{
    static private $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=";

    static public function getLocation($address){
        $url = self::$url.urlencode($address);
        
        $resp_json = self::curl_file_get_contents($url);
        $resp = json_decode($resp_json, true);

        if($resp['status']='OK'){
            return $resp['results'][0]['geometry']['location'];
        }else{
            return false;
        }
    }


    static private function curl_file_get_contents($URL){
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $URL);
        $contents = curl_exec($c);
        curl_close($c);

        if ($contents) return $contents;
            else return FALSE;
    }
}

$query = "CREATE TABLE restloc(
	id CHAR(10) DEFAULT'' NOT NULL,
	lat VARCHAR(15) NOT NULL,
	lng VARCHAR(15) NOT NULL,
	PRIMARY KEY (id)
);";
$result = mysql_query($query);
if(!$result){
	echo "fail1";
	//die():
}

$query = "SELECT * FROM restaurant ;";
$result = mysql_query($query);
if(!$result){
	echo "fail2";
	//die():
}
for($counter = 0; $row = mysql_fetch_row($result);$counter++){
	$address=urlencode($row[2]);
	$loc = geocoder::getLocation($address);
	$q = "INSERT INTO restloc VALUES ('".$row[0]."','".$loc['lat']."','".$loc['lng']."');"; 
	$r = mysql_query($q);
	if(!$r){
		echo "fail3";
	//	die():
	}
}
echo "success";

?>