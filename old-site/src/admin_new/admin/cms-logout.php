<?php

	ob_start();

	include_once("require/webconfig.inc.php");

	include_once("require/sessions.inc.php");

	

	$controller = new Controller();

	################# unregistering session variable for user logout 

	

	$controller->UnregisterSession("sessionId");

	$controller->UnregisterSession("userId");

	$controller->UnregisterSession("userType");

	################# redirect to login page 

	session_destroy();

	$controller->Redirect("index.php");

?>

