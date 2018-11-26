<?php

	ob_start();


	include_once("require/webconfig.inc_2.php");

	include_once("require/sessions.inc_2.php");

	include_once("lib/controller.class_2.php");

	############## including parser for xml file read  

	require_once('parser/xml_domit_include_2.php');


	

	$controller = new Controller();

	//print_r($_REQUEST);

?>



<html>

<head>

<title><?php echo ucfirst(WEBSITE_NAME); ?> Control-Panel</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">



<script type='text/javascript' src='calendar/utils/zapatec.js'></script>

<script type="text/javascript" src="calendar/src/calendar.js"></script>

<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>



<link href="calendar/website/css/zpcal.css" rel="stylesheet" type="text/css">

<link href="calendar/website/css/template.css" rel="stylesheet" type="text/css">

<link href="calendar/themes/forest.css" rel="stylesheet" type="text/css">

<link href="css/style.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="css/menu.css" />



<script type="text/javascript"  src="jvs/menu.js"></script>

<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>

</head>



<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<script language="JavaScript"> var mode = "<?php echo $_REQUEST['DetailMode']?>";</script>

<table width="998" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td><?php include("require/cms-top-header.inc_2.php"); ?></td>

  </tr>

  <tr>

    <td><table width="998" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td width="15" background="images/img-incent_left.jpg">&nbsp;</td>

        <td width="968"><table width="968" border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td width="282" style="padding-top:10px;" valign="top"><?php include("require/left-menu.inc_2.php");  ?></td>

            <td width="686" valign="top"><table width="700" border="0" align="center" cellpadding="0" cellspacing="0">

                <tr>

                  <td width="25"><img src="images/img-outop_left.jpg" width="25" height="25"></td>

                  <td width="671" background="images/img-outop_cent.jpg">&nbsp;</td>

                  <td width="10"><img src="images/img-outop_right.jpg" width="30" height="25"></td>

                </tr>

                <tr>

                  <td background="images/img-oucent_left.jpg">&nbsp;</td>

                  <td><?php 

				if(isset($_REQUEST['module']) && isset($_REQUEST['fname']))

				{

					$fileSource = "../" . $_REQUEST['module'] . "/" .$_REQUEST['fname'];

					if(file_exists($fileSource))

					{

						include_once($fileSource);						

					}

				}

				else

				{

					include_once("../Manage Content Items/welcome_2.php");

				}

			?></td>

                  <td background="images/img-oucent_right.jpg">&nbsp;</td>

                </tr>

                <tr>

                  <td><img src="images/img-oubot_left.jpg" width="25" height="25"></td>

                  <td background="images/img-oubot_cent.jpg">&nbsp;</td>

                  <td><img src="images/img-oubot_right.jpg" width="30" height="25"></td>

                </tr>

            </table></td>

          </tr>

        </table></td>

        <td width="15" background="images/img-incent_right.jpg">&nbsp;</td>

      </tr>

      <tr>

        <td colspan="3">

		<table width="998" border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td width="15"><img src="images/img-inbot_left.jpg" width="15" height="15" /></td>

    <td background="images/img-inbot_cent.jpg" width="968" height="15"></td>

    <td width="15"><img src="images/img-inbot_right.jpg" width="15" height="15" /></td>

  </tr>

</table>

		</td>

      </tr>

    </table></td>

  </tr>

  <tr>

    <td><?php include("require/footer.inc_2.php"); ?></td>

  </tr>

</table>

</body>

</html>

