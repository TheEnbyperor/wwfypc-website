<?
	ob_start();
	include_once("require/webconfig.inc.php");
	include_once("require/sessions.inc.php");  
	include_once("lib/controller.class.php");
	include_once("lib/authentication.class.php");
	require_once('parser/xml_domit_include.php');
	require("lib/class.phpmailer.php");
	$controller = new Controller();
	$displayMessage = "";
	if($_POST)
	{		
			if($controller->CheckIsSet($_POST['txtClientName']) && $controller->CheckIsSet($_POST['txtEmail']))
			{
			 $message = "";
			// $to  = "info@titledevelopments.com";
			 $to  = "mrehman@titledevelopments.pk";
			 $subject = $_POST['txtSubject'];
			 /*
			 $headers  = "From: Title Clients <". $_POST['txtEmail'] .">  \r\n";
			 $headers .= "Content-type: text/html; charset=iso-8859-1  ";
			 $headers .= "MIME-Version: 1.0 ";
			 */
			 $message .= '<table width="702" border="0" cellspacing="5" cellpadding="0" class="tblborder">
			 
  <tr>
    <td width="15%" height="26">&nbsp;</td>
    <td width="18%" height="26">&nbsp;</td>
    <td width="58%" height="26">&nbsp;</td>
    <td width="9%" height="26">&nbsp;</td>
  </tr>
  <tr height="30">
    <td height="31">&nbsp;</td>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#383a3c;" valign="top"><strong>Client Name  :</strong></td>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; color:#383a3c;" valign="top">'.$_POST['txtClientName'].'</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="30">
    <td height="169">&nbsp;</td>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#383a3c;" valign="top"><strong>Message:</strong></td>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; color:#383a3c;" valign="top">'.nl2br($_POST['txtMessage']).'</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#383a3c;">&nbsp;</td>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#383a3c;">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td height="35" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#383a3c;">&nbsp;</td>
    <td height="35" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#383a3c;"></td>
    <td height="35">&nbsp;</td>
  </tr>
  <tr>
    <td height="35" colspan="4" align="center"style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#383a3c;">&nbsp;</td>
  </tr>
</table>
';		

		
					$mail = new PHPMailer();
					$mail->IsSMTP();                                   // send via SMTP
					//$mail->Host     = "192.168.1.5"; // SMTP servers
					//$mail->Mailer   = "smtp";
					$mail->AddReplyTo("info@titledevelopments.com","Sales");
					$mail->WordWrap = 50;                              // set word wrap
					$mail->IsHTML(true);                               // send as HTML
					$mail->From     = "info@titledevelopments.com";
					$mail->FromName = "Support Form";
					$mail->Subject  = $subject;				
					
					$mail->Body    = $message;
					$mail->AddAddress($to, "Sales");
					if(!$mail->Send())
						{ 
							$displayMessage = MAILERRORMESSAGE;				 
						}
						else
						{
							$displayMessage = MAILSUCCESSRMESSAGE;						
						}
					
					// Clear all addresses and attachments for next loop
					$mail->ClearAddresses();
					$mail->ClearAttachments();
			/*
			if(mail($to,$subject,$message,$headers))
			{
				$displayMessage = MAILSUCCESSRMESSAGE;
			}
			else
			{
				$displayMessage = MAILERRORMESSAGE;
			 }
			*/
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title><? echo ucfirst(WEBSITE_NAME); ?>-Help & Support </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<link href="css/style.css" rel="stylesheet" type="text/css"></head><body class="body">
<script src="jvs/functions.js"></script>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="954">
  <tbody><tr>
    <td align="left" valign="top"><? include("require/cms-top-header.inc.php");?></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table id="Table_2" border="0" cellpadding="0" cellspacing="0" height="103" width="954">
  <tbody>
    <tr>
      <td><img src="images/content_header_img.jpg" alt="" height="103" width="91" /></td>
      <td><img src="images/content_header_img2.jpg" alt="" height="103" width="463" /></td>
      <td width="275" height="103" valign="top"><table width="100%" height="103" border="0" cellpadding="0" cellspacing="0" background="images/content_header_img3 copy.jpg">
        <tr>
          <td height="38" colspan="2" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td width="16%" height="22" align="left" valign="top">&nbsp;</td>
          <td width="84%" align="left" valign="top" class="BoldHeading"><?=WEBSITE_NAME?> Administrator</td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="top" height="40">&nbsp;</td>
        </tr>
      </table></td>
      <td><img src="images/content_header_img4.jpg" alt="" height="103" width="125" /></td>
    </tr>
  </tbody>
</table></td>
  </tr>
  <tr>
    <td><table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td align="left" valign="top"><table id="Table_4" border="0" cellpadding="0" cellspacing="0" height="414" width="47">
          <tbody><tr>
            <td rowspan="2" align="left" valign="top" width="47"><img src="images/mainv2_19.jpg" alt="" height="125" width="47"></td>
          </tr>
          <tr> </tr>
          <tr>
            <td rowspan="5">&nbsp;</td>
          </tr>
        </tbody></table></td>
        <td align="left" valign="top"><? include("require/left-menu.inc.php"); ?></td>
        <td align="left" valign="top"><table id="Table_7" border="0" cellpadding="0" cellspacing="0" height="53" width="13">
          <tbody><tr>
            <td rowspan="4" align="left" valign="top" width="10"><img src="images/body_horz_img.jpg" alt="" height="2" width="10"></td>
          </tr>
          <tr> </tr>
          <tr> </tr>
          <tr> </tr>
          <tr>
            <td rowspan="3" align="left" valign="top"><img src="images/body_horz_img.jpg" alt="" height="2" width="10"></td>
          </tr>
          <tr> </tr>
          <tr> </tr>
        </tbody></table></td>
        <td align="left" valign="top"><table border="0" cellpadding="0" cellspacing="0">
          <tbody><tr>
            <td align="left" valign="top" height="516"><table width="702" border="0" cellspacing="2" cellpadding="0" class="tblborder">
			<form name="frmHelpSupport" id="frmHelpSupport" action="help-support.php" method="post" onsubmit="javascript: return validatehelpsupportform();"> 
  <tr>
    <td height="26" colspan="4" class="conetntmenutxt"><strong>&nbsp;&nbsp;Contact to Development Center</strong></td>
    </tr>
  <tr>
    <td width="10%" height="26">&nbsp;</td>
    <td width="13%" height="26">&nbsp;</td>
    <td height="26" colspan="2"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><?=$displayMessage?></font></td>
    </tr>
  <tr height="30">
    <td>&nbsp;</td>
    <td class="cptxt"><span class="manidatory">*</span>&nbsp;Your Name:</td>
    <td width="52%" class="cptxt"><input name="txtClientName" type="text" class="textfields" id="txtClientName" size="40" maxlength="70"></td>
    <td width="25%">&nbsp;</td>
  </tr>
   <tr height="30">
    <td>&nbsp;</td>
    <td class="cptxt"><span class="manidatory">*</span>&nbsp;Your Email:</td>
    <td><input name="txtEmail" type="text" class="textfields" id="txtEmail" size="40" maxlength="100" /></td>
    <td>&nbsp;</td>
  </tr>
   <tr height="30">
    <td>&nbsp;</td>
    <td class="cptxt"><span class="manidatory">*</span>&nbsp;Subject:</td>
    <td><input name="txtSubject" type="text" class="textfields" id="txtSubject" size="40" maxlength="200" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="30">
    <td>&nbsp;</td>
    <td class="cptxt" valign="top">&nbsp;&nbsp;&nbsp;Message:</td>
    <td><textarea name="txtMessage" cols="40" rows="4" class="textfields" id="txtMessage"></textarea></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td height="35">&nbsp;</td>
    <td height="35" class="cptxt">&nbsp;</td>
    <td height="35"><input type="image" src="images/CMS_Button_send.gif"></td>
    <td height="35">&nbsp;</td>
  </tr>
  <tr>
    <td height="35" colspan="4" align="center" class="cptxt">&nbsp;</td>
    </tr>
  </form>
</table></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table id="Table_11" border="0" cellpadding="0" cellspacing="0" height="27" width="719">
              <tbody><tr>
                <td colspan="8" height="27"><img src="images/mainv2_33.jpg" alt="" height="27" width="601"></td>
                <td colspan="2"><a href="cms-logout.php"><img src="images/mainv2_34.jpg" alt="" height="27" width="76" border="0" align="Logout"></a></td>
                <td width="43">&nbsp;</td>
              </tr>
            </tbody></table></td>
          </tr>
          <tr>
            <td align="left" valign="top"><? include("require/footer.inc.php"); ?></td>
          </tr>
        </tbody></table></td>
      </tr>
      <tr>
        <td colspan="4"><img src="images/mainv2_40.jpg" alt="" height="32" width="954"></td>
      </tr>
    </tbody></table></td>
  </tr>
</tbody></table>
</body>
</html>
