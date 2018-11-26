<?php

ob_start();

include_once("../admin/require/webconfig.inc.php");

include_once("../admin/require/sessions.inc.php");

include_once("../admin/lib/connection-manager-mysql.class.php");

include_once("../admin/lib/query-builder-mysql.class.php");

include_once("../admin/lib/images.class.php");

include_once("../admin/lib/db.class.php");

include_once("../admin/lib/controller.class.php");

include_once("../admin/lib/MySQLPagedResults.class.php");

include_once("../admin/fckeditor/fckeditor.php");

include_once("../includes/common.inc.php");







$objQryBuilder 	= new QueryBuilder();

$objConMgr 		= new ConnectionMgr();

$db 			= new db();

$objController  = new Controller();



$displayMessage = "";

$File_Type_Error = false;



$module = (isset($_REQUEST['module']) ? $_REQUEST['module'] : "");

$menuId = (isset($_REQUEST['menuId']) ? $_REQUEST['menuId'] : "");

$fname  = (isset($_REQUEST['fname']) ? $_REQUEST['fname'] : "");

$_newsid 	= (isset($_REQUEST['newsid']) ? $_REQUEST['newsid'] : "");

$ctg_id 	= (isset($_REQUEST['ctgid']) ? $_REQUEST['ctgid'] : "1");



?>



