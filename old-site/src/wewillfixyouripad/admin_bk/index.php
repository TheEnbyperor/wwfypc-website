<?
include_once ("require/webconfig.inc.php");
include_once ("lib/controller.class.php");
include_once ("lib/authentication.class.php");

$controller = &new Controller();

if ($_POST)
{
    $displayMessage = "";
    $userName = trim($_POST['txtUsername']);
    $password = trim($_POST['txtPassword']);

    #################### Checking if username and password are set and not equal to null ############
    if ($controller->CheckIsSet($userName) == 1 && $controller->CheckIsSet($password) == 1)
    {
        ####################### Creating authentication object perform login
        $AuthenticateObj = new Authentication();
        $returnStatus = $AuthenticateObj->ActionForLogin($userName, $password);

        if ($returnStatus == 1)
        {
            $_SESSION['sessionId'] = session_id();
            $controller->Redirect("control-panel.php");
        } elseif ($returnStatus == 0)
        {
            $displayMessage = LOGINERRORMESSAGE;

        } elseif ($returnStatus == -1)
        {
            $displayMessage = CONNECTIONERROR;

        } elseif ($returnStatus == -2)
        {
            $displayMessage = DBSELECTIONERROR;
        }
    }
} else
{
    $displayMessage = "";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><? echo ucfirst(WEBSITE_NAME); ?>-Login</title>
<link href="css/style_login.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
function validateLoginform()
{					
	if(document.getElementById("txtUsername").value == "")
	{
	 alert("Please enter a Username.");
	 document.getElementById("txtUsername").focus();
	 return false;
	}
	if(document.getElementById("txtPassword").value == "")
	{			
	 alert("Please enter a Password.");
	 document.getElementById("txtPassword").focus();
	 return false;
	}
	 return true;
   
}
</script>
</head>
<body>
<div id="topheader">
  <div class="logo">
    <div class="content_managemt">Content Management System</div>
  </div>
</div>
<div id="body_area">
  <div class="body_area1">
    <div class="mid">
      <div class="body_mid">Administrator Login</div>
    </div>
    <form name="frmUserLogin" id="frmUserLogin" action="index.php" method="post" onSubmit="javascript: return validateLoginform();">
      <table width="100%" border="0" cellpadding="0" cellspacing="2">
        <tr>
          <td height="40" colspan="2" align="center" style="color:#FF0000; padding-top:15px;"><? if($controller->CheckIsSet($displayMessage) == 1) echo $displayMessage; ?>
          </td>
        </tr>
        <tr>
          <td width="219" height="18">&nbsp;</td>
          <td width="303">&nbsp;</td>
        </tr>
        <tr>
          <td class="login" valign="middle" >Username:</td>
          <td valign="middle"><input name="txtUsername" type="text" class="logintextbox" id="txtUsername" value="" maxlength="100" /></td>
        </tr>
        <tr>
          <td class="password" valign="middle" >Password:</td>
          <td valign="middle"><input name="txtPassword" type="password" class="logintextbox" id="txtPassword" value="" maxlength="60" /></td>
        </tr>
        <tr>
          <td height="3" colspan="2"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="image" src="images/login.jpg" width="94" height="61"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>
  </div>
</div>
<div class="body_areabackground">&copy; All Rights Reserved to <a href="http://www.sabritech.com" target="_blank" style="text-decoration:none; "><b>Sabritech</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
</body>
</html>