<?php

ob_start();

include_once("../admin/require/webconfig.inc_2.php");

include_once("../admin/require/sessions.inc_2.php");

include_once("../admin/lib/connection-manager-mysql.class_2.php");

include_once("../admin/lib/query-builder-mysql.class_2.php");

include_once("../admin/lib/images.class_2.php");

include_once("../admin/lib/db.class_2.php");

include_once("../admin/lib/controller.class_2.php");

include_once("../admin/lib/MySQLPagedResults.class_2.php");

include_once("../admin/fckeditor/fckeditor.php");

include_once("../includes/common.inc_2.php");







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



