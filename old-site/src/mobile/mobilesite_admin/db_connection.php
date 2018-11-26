<?php
$host = "localhost";
$user = "wewillfi_wewillf";
$pass = "d+Q,37@?AicB=c6";
$db = "wewillfi_sabritech";

$conn = mysql_connect($host, $user, $pass);
if(!$conn){
	echo "could not connect";
}

$db_select = mysql_select_db($db);

if(!$db){
	echo "no database";
}

?>