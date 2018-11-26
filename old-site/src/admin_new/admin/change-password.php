<?php

	ob_start();

	include_once("require/webconfig.inc.php");

	include_once("require/sessions.inc.php");  

	include_once("lib/controller.class.php");

	include_once("lib/authentication.class.php");

	require_once('parser/xml_domit_include.php');

	include_once("lib/connection-manager-mysql.class.php");

	include_once("lib/query-builder-mysql.class.php");

	

	$controller = new Controller();

	$objQryBuilder = new QueryBuilder();

	$objConMgr = new ConnectionMgr();

	

	$displayMessage = "";

	if($_POST)

	{		

			

			

			$oldPassword = trim($_POST['txtOldPassword']);

			$newPassword = trim($_POST['txtNewPassword']);

			

		#################### Checking if oldPassword and newPassword are set and not equal to null ############

		if($controller->CheckIsSet($oldPassword) == 1 && $controller->CheckIsSet($newPassword) == 1)

		{

			####################### Creating authentication object  

			$AuthenticateObj = new Authentication();   

			$displayMessage = $AuthenticateObj->ActionForChangePassword("tbl_admin_users",$oldPassword,$newPassword,$_SESSION['userId']);

			

			############### Selecting proper message according to return value  		

					switch ($displayMessage) 

						{

								case 0:

									$displayMessage = WRONGOLDPASSWORD ;

									break;

								case 1:

									$displayMessage = UPDATEPASWORD ;

									break;

							   case -4:

									$displayMessage = UPDATEPASSWORDERROR ; 

									break;

       							

						}

						

		}

		

	}

	$userDetailWhereCondition = "userId =".$_SESSION['userId'];

	$userDetailSelectSql = $objQryBuilder->selectQry('*','tbl_admin_users',$userDetailWhereCondition );

	$userDetailSelectResult = $objConMgr->DML_executeQry($userDetailSelectSql);

	$userDetailRS = mysql_fetch_object($userDetailSelectResult);

?>

<html>

<head>

<title><?php echo ucfirst(WEBSITE_NAME); ?>-Change Password</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link href="css/style.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="css/menu.css" />

<script src="jvs/functions.js"></script>

<script type="text/javascript"  src="jvs/menu.js"></script>

</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<table width="998" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td><?php include("require/cms-top-header.inc.php");?></td>

  </tr>

  <tr>

    <td><table width="998" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td width="15" background="images/img-incent_left.jpg">&nbsp;</td>

        <td width="968"><table width="968" border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td width="282" style="padding-top:10px;" valign="top"><?php include("require/left-menu.inc.php"); ?></td>

            <td width="686" valign="top"><table width="700" border="0" align="center" cellpadding="0" cellspacing="0">

                <tr>

                  <td width="25"><img src="images/img-outop_left.jpg" width="25" height="25"></td>

                  <td width="671" background="images/img-outop_cent.jpg">&nbsp;</td>

                  <td width="10"><img src="images/img-outop_right.jpg" width="30" height="25"></td>

                </tr>

                <tr>

                  <td background="images/img-oucent_left.jpg">&nbsp;</td>

                  <td><table width="100%" border="0" cellspacing="0" cellpadding="2" class="tblborder">

			<form name="frmChangePassword" id="frmChangePassword" action="change-password.php" method="post" onSubmit="javascript: return validatePasswordChangeform();"> 

  

  <tr>

    <td height="32" colspan="4" class="conetntmenutxt" valign="middle">&nbsp;&nbsp;<strong>Change Password</strong> </td>

    </tr>

	

  <tr>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td height="35" class="manidatory">

      <font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif"><?php echo $displayMessage;?></font>

    </td>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td width="12%">&nbsp;</td>

    <td width="27%" class="cptxt">Username:</td>

    <td width="46%" class="cptxt"><?=$userDetailRS->userName?></td>

    <td width="15%">&nbsp;</td>

  </tr>

   <tr>

    <td>&nbsp;</td>

    <td class="cptxt"> Old Password:</td>

    <td><input name="txtOldPassword" type="password" class="textfields" id="txtOldPassword" size="30" maxlength="20" />	<span class="cptxt"><span class="manidatory" style="vertical-align:top; ">*</span></span></td>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td>&nbsp;</td>

    <td class="cptxt">New Password:</td>

    <td><input name="txtNewPassword" type="password" class="textfields" id="txtNewPassword" size="30" maxlength="20">

      <span class="cptxt"><span class="manidatory" style="vertical-align:top; ">*</span></span>	</td>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td>&nbsp;</td>

    <td class="cptxt">Confirm New Password:</td>

    <td><input name="txtConfirmNewPassword" type="password" class="textfields" id="txtConfirmNewPassword" size="30" maxlength="20">

      <span class="cptxt"><span class="manidatory" style="vertical-align:top ">*</span></span>	</td>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td height="35">&nbsp;</td>

    <td height="35" class="cptxt">&nbsp;</td>

    <td height="35"><input type="image" src="images/cmdUpdate.gif"></td>

    <td height="35">&nbsp;</td>

  </tr>

  

  <tr>

    <td height="35" colspan="4" align="center">&nbsp;</td>

    </tr>

  </form>

</table></td>

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

    <td><?php include("require/footer.inc.php"); ?></td>

  </tr>

</table>

</body>

</html>

