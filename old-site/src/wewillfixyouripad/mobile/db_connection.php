<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db = getenv('DB_NAME_IPAD');

$conn = mysql_connect($host, $user, $pass);
if(!$conn){
	echo "could not connect";
}

$db_select = mysql_select_db($db);

if(!$db){
	echo "no database";
}

?>