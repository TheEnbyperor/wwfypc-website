<?php
$host = "db777070300.hosting-data.io";
$user = "dbo777070300";
$pass = "d3f3nd3r";
$db = "db777070300";

$conn = mysql_connect($host, $user, $pass);
if(!$conn){
	echo "could not connect";
}

$db_select = mysql_select_db($db);

if(!$db){
	echo "no database";
}

?>