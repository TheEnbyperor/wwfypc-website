<?php
$host = "db777070300.hosting-data.io";
$user = "dbo777070300";
$pass= "39l4mb0urn3";
$db="db777070300";

$conn = mysql_connect($host, $user, $pass);
if(!$conn){
	echo "could not connect";
}

$db_select = mysql_select_db($db);

if(!$db){
	echo "no database";
}

?>
