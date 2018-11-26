<?php



include_once("admin/require/webconfig.inc.php");

include_once("admin/lib/connection-manager-mysql.class.php");

include_once("admin/lib/query-builder-mysql.class.php");

//include_once("admin/lib/Showpagecontents.class.php");

include_once("admin/lib/MySQLPagedResults.class.php");

include_once("admin/lib/db.class.php");

include_once("includes/common.inc.php");

include_once("includes/mail.class.php");



$objQryBuilder = new QueryBuilder();

$objConMgr	   = new ConnectionMgr();	



$db = new db();

?>