<?php
include_once ("includes/includes.inc.php");
$mtp_id = 102;
include_once("includes/header_laptop_screen_quote.php");

if(isset($_POST) && (isset($_POST['frmLappointment']) == 22))
{
	#print_arr($_POST);
	$quotefrm	= array($_POST);
	$emailObj = &new eMail();
	//if(isset($_POST['app_email']) && $_POST['app_email']!="")
	if($_POST['preferred'] == 'text' || $_POST['preferred'] == 'both')
	{
		//echo $_POST['preferred'];exit;
		$whereCondition = ""; 
		$serviceExistsql = $objQryBuilder->selectQry('*','tbl_laptop_appointments',$whereCondition);
		$serviceExistresult = $objConMgr->DML_executeQry($serviceExistsql);
	
		$txtName			= prepearString(trim($_POST['app_name']));
		$txtPhone			= prepearString(trim($_POST['app_phone']));
		$txtEmail			= prepearString(trim($_POST['app_email']));
		$laptop_maker		= prepearString(trim($_POST['laptop_maker']));
		$laptop_model		= prepearString(trim($_POST['laptop_model']));
		$problem_desc		= prepearString(trim($_POST['problem_desc']));
				
		$values 		= "$txtName, $txtPhone, $txtEmail, $laptop_maker, $laptop_model, $problem_desc";
		$fieldsNames 	= "name, phone, email, laptop_maker, laptop_model, problem_desc";
				
		$insertQuery = $objQryBuilder->insertQry("tbl_laptop_appointments",$fieldsNames,$values);
		//echo $insertQuery;exit;
		$insertResult = $objConMgr->DDL_executeQry($insertQuery); 
		//echo $insertResult;exit;
		//$emailBody 	= appointmentFrm($quotefrm);
		//$semail	   	= $quotefrm[0]['app_email'];
		//echo $semail;exit;
		
	}

	$to="wewillfixyourpc@gmail.com";
	
	$emailBody 	= appointmentFrm($quotefrm);
	$semail	   	= $quotefrm[0]['app_email'];
	
	$emailInfo = GetContactusEmailInfo();
	//echo $emailInfo;exit;
	$subject="Sell Your Laptop Quote";
		//echo "<br /><br /><br />".$emailBody ; die();
	/*if($semail == '')
	{
		$semail = 'neil@wewillfixyourpc.co.uk';
	}
	//$emailObj->SendEmail($semail, $emailInfo->email , $subject , $emailBody, "");
	//echo $semail;exit;
	if ($emailObj->SendEmail($semail, $emailInfo->email , $subject , $emailBody, ""))
	{
		$message = "Thank you. Your Request has been sent. We will be in touch shortly with your quote. If urgent, then please call us now on 02920 758299.";
	}
	else
	{
		$semail = 'neil@wewillfixyourpc.co.uk';
		$emailObj->SendEmail($semail, $emailInfo->email , $subject , $emailBody, "");
		$message = "Thank you. Your Request has been sent. We will be in touch shortly with your quote. If urgent, then please call us now on 02920 758299.";
		//$message = "Error sending please re-try.";			
	}*/
	$txtName			= prepearString(trim($_POST['app_name']));
$txtEmail			= prepearString(trim($_POST['app_email']));
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: '.$txtName." <noreply@noreply.wewillfixyourpc.co.uk>\r\n";
$headers .= 'Reply-to: '. $txtEmail."\r\n";
// Mail it
$mail=mail($to, $subject, $emailBody, $headers);

if($mail){
$message='Thank you. Your Request has been sent. We will be in touch shortly with your quote. If urgent, then please call us now on 02920 766039';
}
else {
$message= 'Error sending please re-try';
}
}
## Get Page Content ##
$rsPage = $db->select("SELECT * FROM tbl_pages WHERE pageId='102' LIMIT 1");
#print_arr ($rsPage); die();
if (!empty($rsPage)) {
	$page_content		= $rsPage[0];
} else {
    $errorMessage = "Page not exist. Please try later";
}

#####
?>
 <?=stripcslashes($page_content['pageText'])?>
 
<!--form class="formValidation" id="frmLappointment" name="frmLappointment" method="post" action="" onsubmit="javascript: return AppFrmValidation();"-->
<form class="formValidation" id="frmLappointment" name="frmLappointment" method="post" action="" >
  <input type="hidden" name="frmLappointment" id="frmLappointment" value="22" />

<div class="form">
	<div class="maindiv">
   	 <div class="fright" style="border-right:1px dashed #484848; margin-bottom:15px;">
      <div class="maindiv" style="height:420px;">
        <div class="fleft" style="width:371px;">
          <div class="fhead">
            <div class="fhead201"> Your Laptop </div>
            <div class="maindiv">
              <div class="name"> Laptop Make </div>
              <div class="formbg2">
                <input id="laptop_maker" name="laptop_maker" type="text" class="forminput"/>
              </div>
            </div>
            <div class="maindiv">
              <div class="name"> Laptop Model &nbsp;&nbsp;&nbsp;&nbsp;<a href="Find_Laptop_Model.html" onClick="return popup(this, 'notes')"><small>- need help?</small></A></div>
              <div class="formbg2">
                <input id="laptop_model" name="laptop_model" type="text" class="forminput"/>
              </div>
            </div>
            <div class="maindiv">
              <div class="name" style="width:100%;"> Comments </div>
              <div class="formbg1">
                <textarea id="problem_desc" name="problem_desc" class="forminput1" rows="1" cols="1"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    <div class="fleft" >
      <div class="fhead">
        <div class="fhead101"> Your Information </div>
        <span style="color:#FF9D2E;"><?=$message?></span>
        <div class="maindiv">
          <div class="name"> Your Name</div>
          <div class="formbg">
            <input id="app_name" name="app_name" type="text" class="forminput"/>
          </div>
        </div>
        <div class="maindiv">
          <div class="name"> Phone Number</div>
          <div class="formbg">
            <input id="app_phone" name="app_phone" type="text" class="forminput"/>
          </div>
        </div>
        <div class="maindiv">
          <div class="name"> Email Address </div>
          <div class="formbg">
            <input id="app_email" name="app_email" type="text" class="forminput"/>
          </div>
        </div>
        <div class="maindiv">
          <div class="name"> Preferred Contact </div>
          <div class="formbg10">
            <p>
              <label>
                <input type="radio" name="preferred" value="Email" id="preferred_0" />
                Email</label>
              <label>
                <input type="radio" name="preferred" value="Text" id="preferred_1" />
                Text</label>
              <label>
                <input type="radio" name="preferred" value="Both" id="preferred_2" checked />
                Both</label>
            </p>
          </div>
        </div>
      </div>
      <div class="book"> <input type="image" src="images/request_a_quote.png"  /></div>
    </div>
  </div>
</div>
</form>
</div>
<div class="rightpanel">
  <?php include_once("includes/contact.php"); ?>
  <?php
		### Getting rightpanel image for this Page
		$rightpanel_image = $db->select("SELECT * FROM tbl_rightpanel_images WHERE status='1' AND id IN (1) ORDER BY id ASC LIMIT 0,1");
		if($rightpanel_image)
		{
			$_total = count($rightpanel_image);
			for($i=0; $i<$_total; $i++){
		####
		?>

      <a href="Laptop_Overheating.php"><img src="upload/images/rightpanel/overheat.jpg" alt="" class="right" style="margin-top:25px;"/></a>
      <a href="laptop_screen_replacement_cardiff.php"><img src="upload/images/rightpanel/laptop_screen1.jpg" alt="" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/call_us_today.jpg" alt="" class="right" style="margin-top:25px;"/></a>

  <?php } } ?>
</div>
</div>
<?php
### Getting Quote for this Page
$quote = $db->select("SELECT * FROM tbl_feedback WHERE status='1' AND id='7' LIMIT 0,1");
if (!empty($quote)) {


?>
<div class="quote">
  <div class="maindiv">
    <div class="quoteimg"> <img src="upload/images/feedback/<?=$quote[0]['image']?>" alt=""/> </div>
    <div class="quotetext"> <span><img src="images/quote.jpg" alt=""/></span> <?=stripslashes($quote[0]['title'])?><span><img src="images/quoteb.jpg" alt=""/></span> </div>
  </div>
</div>
<?php }
####
?>
<?php include_once("includes/footer.php");?>
<script type="text/javascript" language="javascript">
function AppFrmValidation()
{	
/*
	if(document.getElementById("app_name").value=="")
	{
		alert("Please enter Name.");
		document.getElementById("app_name").focus();
		return false;
	}
	if(document.getElementById("laptop_maker").value=="")
	{
		alert("Please enter Maker.");
		document.getElementById("laptop_maker").focus();
		return false;
	}
	if(document.getElementById("laptop_model").value=="")
	{
		alert("Please enter Model.");
		document.getElementById("laptop_model").focus();
		return false;
	}
	if(document.getElementById("app_name").value != "") {
			var iChars = "0123456789!@#$%^&*()+=[];,'{}|<>??";
			for (var i = 0; i < document.getElementById("app_name").value.length; i++) {
				if (iChars.indexOf(document.getElementById("app_name").value.charAt(i)) != -1) {
				alert("Special characters and numbers are not allowed in Your Name.");
				document.getElementById("app_name").focus();
				return false;
			   }  // inner if statement
			 }  // for loop statement
		}
	
	if(document.getElementById("app_phone").value=="")
	{
		alert("Please enter Phone Number.");
		document.getElementById("app_phone").focus();
		return false;
	}
	
	if(Validate(document.getElementById('app_phone').value,"[^0-9]") == true)
	  {
	   alert("Please enter valid phone number. Only digits are allowed.");
	   document.getElementById('app_phone').focus();
	   return false;
	  }

	if(document.getElementById("app_email").value == "") {
		alert("Please enter your Email Address.");	
		document.getElementById("app_email").focus();
		return false;
	}	
	if(Validate(document.getElementById("app_email").value,"[A-Za-z0-9_\\.][A-Za-z]*@[A-Za-z]*\\.[A-Za-z0-9]") == false)
	{
		alert("Please enter valid Email Address.");
		document.getElementById("app_email").focus();
		return false;
	}
	*/
	return true;
	
}
function Validate(strToValidate,RegPattern)
{
	var expr = new RegExp(RegPattern);
	var result = expr.test(strToValidate);
	if(result==true){
		return true;
	}else{
		return false;
	}
}
</script>
<?php
function appointmentFrm($quotefrm)
{
	$emailBody = '<style>
						.Bold14gray {
							font-size:14px;
							font-weight:bold;
							font-family:Arial;
							color:#757575;
						}
						.regular12gray {
							font-size:12px;
							color:#757575;
							font-family:Arial;
						}
						.regular12yellow {
							font-size:12px;
							color:#690;
							font-family:Arial;
						}
						.Bold12Darkyellow {
							font-size:12px;
							color:#FF9D2E;
							font-weight:bold;
							font-family:Arial;
						}
						.regular12Darkyellow {
							font-family:Arial;
							font-size:12px;
							color:#690;
						}
						.Title {
							font-family:Verdana, Arial, Helvetica, sans-serif;
							font-size:18px;
							font-weight:bold;
							background-color:#FF9D2E;
							color:#FFFFFF;
						}
						</style>
						<table border=1 width="550">
						  <tr>
							<td><table width="100%" height="237" cellpadding="0" cellspacing="0">
								<tr>
								  <td colspan="4" align="center" class="Title">We Will Fix Your PC [Sell Your Laptop Quote] </td>
								</tr>
								<tr>
								  <td height="30" colspan="4"></td>
								</tr>
								<tr>
								  <td width="5%"></td>
								  <td class="regular12gray" colspan="3">Dear We Will Fix Your PC, </td>
								</tr>
								<tr>
								  <td height="30"></td>
								  <td class="regular12gray" colspan="3"></td>
								</tr>
								<tr>
								  <td></td>
								  <td class="regular12gray" colspan="3"></td>
								</tr>
								
								<tr>
								  <td></td>
								  <td class="regular12gray" colspan="3">&nbsp;</td>
								</tr>
								<tr>
								  <td></td>
								  <td class="regular12gray" colspan="4"><span class="Bold12Darkyellow"><b>Name:</b></span>&nbsp;&nbsp;&nbsp;'.$quotefrm[0]['app_name'].'</td>
								</tr>
								<tr>
								  <td></td>
								  <td class="regular12gray" colspan="4"><span class="Bold12Darkyellow"><b>Email:</b></span>&nbsp;&nbsp;&nbsp;'.$quotefrm[0]['app_email'].'</td>
								</tr>
								<tr>
								  <td></td>
								  <td class="regular12gray" colspan="4"><span class="Bold12Darkyellow"><b>Phone Number:</b></span>&nbsp;&nbsp;&nbsp;&nbsp;'.$quotefrm[0]['app_phone'].'</td>
								</tr>
                                <tr>
								  <td></td>
								  <td class="regular12gray" colspan="4"><span class="Bold12Darkyellow"><b>Laptop Maker:</b></span>&nbsp;&nbsp;&nbsp;&nbsp;'.$quotefrm[0]['laptop_maker'].'</td>
								</tr>
								<tr>
								  <td></td>
								  <td class="regular12gray" colspan="4"><span class="Bold12Darkyellow"><b>Model:</b></span>&nbsp;&nbsp;&nbsp;&nbsp;'.$quotefrm[0]['laptop_model'].'</td>
								</tr>
								<tr>
								  <td></td>
								  <td class="regular12gray" colspan="4"><span class="Bold12Darkyellow"><b>Comments:</b></span>&nbsp;&nbsp;&nbsp;&nbsp;'.$quotefrm[0]['problem_desc'].'</td>
								</tr>
								<tr>
								  <td></td>
								  <td class="regular12gray" colspan="4"><span class="Bold12Darkyellow"><b>Preferred Contact:</b></span>&nbsp;&nbsp;&nbsp;&nbsp;'.$quotefrm[0]['preferred'].'</td>
								</tr>
                                <tr>
							  </tr>
							 	<tr>
								  <td></td>
								  <td class="regular12gray" colspan="4">Regards</td>
							  </tr>
								<tr>
								  <td></td>
								  <td class="regular12gray" colspan="4">'.$quotefrm[0]['app_name'].'</td>
							  </tr>
								
							  </table></td>
						  </tr>
						</table>';	
				
	return $emailBody; }
?>