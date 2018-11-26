<?php

	include_once("lib/controller.class_2.php");

	

	if(!ValidateSession($_SESSION['sessionId']))

	{

		$controller = new Controller();

		################# unregistering session variable for user logout 

	

		$controller->UnregisterSession("sessionId");

	

		################# redirect to login page 

	

		$controller->Redirect("index.php");

		

	}

	function ValidateSession($sessionField1)

	{

		if(isset($sessionField1) && $sessionField1 != "")

		{			

			return 1;

		}

		if(!isset($sessionField1) || $sessionField1 == "")

		{

			return 0;

		}

	}

?>

