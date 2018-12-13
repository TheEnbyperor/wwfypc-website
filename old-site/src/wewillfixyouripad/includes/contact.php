<?php 
include_once("includes/includes.inc.php");

if(isset($_POST) && (isset($_POST['contactusfrm']) == 1))
{
	#print_arr($_POST);
	$quotefrm	= array($_POST);
	?>
	<?php /*?>$emailObj = &new eMail();
	if(isset($_POST['email']) && $_POST['email']!="")
	{
		$emailBody 	= contactUs($quotefrm);
		$semail	   	= $quotefrm[0]['email'];
		$contactus = $emailInfo->email;
	}
	
	$emailInfo = GetContactusEmailInfo();
	$subject="Contact Us";
		#echo "<br /><br /><br />".$emailBody ; die();
	if ($emailObj->SendEmail($semail, $emailInfo->email , $subject , $emailBody, "", $_POST['name']))
		$contactusMessage = "Your Comments has been sent.";
	else
		$contactusMessage = "Error sending please re-try.";	<?php */?>
       <?php 
        $txtName			= trim($_POST['name']);
	$txtPhone			= trim($_POST['phone']);
	$txtEmail			= trim($_POST['email']);
	$message		= trim($_POST['comments']);
	
	
			
	$values 		= "'$txtName', '$txtPhone', '$txtEmail', '$message' ";
	
	
		$message = $message;
		$subject="Query from home page";
		$semail = 'Neil <neil@wewillfixyourpc.co.uk>';

		$bcc = 'wewillfixyourpc@gmail.com';
		$cc = 'neil@cardifftec.co.uk';		// for testing again using cc and bcc
		$values = " Name: '$txtName' <br> Phone Number: '$txtPhone' <br> Email Address: '$txtEmail' <br> Message: '$message'";
		$message = "Thank you. Your Request has been sent. We will be in touch shortly with your quote. If urgent, then please call us now on 02920 766039.";
	
		$to = "neil@wewillfixyourpc.co.uk,wewillfixyourpc@gmail.com";
		$body = $values;


		$headers = "MIME-Version: 1.0\n" ;
	        $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
	        $headers .= "X-Priority: 1 (Highest)\n";
	        $headers .= "X-MSMail-Priority: High\n";
	        $headers .= "Importance: High\n";

		// Additional headers
		$headers .= 'From: '.$txtName." <noreply@noreply.wewillfixyourpc.co.uk>\r\n";
		$headers .= 'Reply-to: '. $txtEmail."\r\n";
		$headers .= 'Cc: '.$cc. "\r\n";       // just comment this line if you dont want to use it
		$headers .= 'Bcc: '.$cc . "\r\n";    // just comment this line if you dont want to use it

		// Mail it
		mail($to, $subject, $body, $headers);	
	
	
		//echo $message;exit;	
		$contactusMessage = "Your Comments has been sent";	
				
	
    ?>		
	
<?php }
?>

<form class="formValidation" id="frmContactus" name="frmContactus" method="post" action="" onsubmit="javascript: return FrmValidation();">
  <input type="hidden" name="contactusfrm" id="contactusfrm" value="1" />
  <div class="contactbg">
  	<span style="left: 20px; color: rgb(255, 255, 255); top: 26px; position: absolute;"><?=$contactusMessage?></span>
    
    <div class="cemail">
      <input id="name" name="name" type="text" class="cinput" value="Name" onfocus="this.value=''"/>
    </div>
    <div class="cemail1">
      <input id="phone" name="phone" type="text" class="cinput" value="Tel No" onfocus="this.value=''"/>
    </div>
    <div class="cemail2">
      <input id="email" name="email" type="text" class="cinput" value="Email" onfocus="this.value=''"/>
    </div>
    <div class="message">
      <textarea id="comments" name="comments" class="cinput1" style="overflow:hidden;" rows="1" cols="1" onfocus="this.value=''">Message</textarea>
    </div>
    <input type="image" src="images/submit.jpg" class="submitbtn" />
  </div>
</form>


<script type="text/javascript" language="javascript">
function FrmValidation()
{	
	if(document.getElementById("name").value=="")
	{
		alert("Please enter Name.");
		document.getElementById("name").focus();
		return false;
	}
	if(document.getElementById("name").value != "") {
			var iChars = "0123456789!@#$%^&*()+=[];,'{}|<>??";
			for (var i = 0; i < document.getElementById("name").value.length; i++) {
				if (iChars.indexOf(document.getElementById("name").value.charAt(i)) != -1) {
				alert("Special characters and numbers are not allowed in Name.");
				document.getElementById("name").focus();
				return false;
			   }  // inner if statement
			 }  // for loop statement
		}
	if(document.getElementById("phone").value=="")
	{
		alert("Please enter Phone Number.");
		document.getElementById("phone").focus();
		return false;
	}
	if(Validate(document.getElementById('phone').value,"[^0-9]") == true)
	  {
	   alert("Please enter valid Phone Number. Only digits are allowed.");
	   document.getElementById('phone').focus();
	   return false;
	  }
	if(document.getElementById("email").value == "") {
		alert("Please enter your Email Address.");	
		document.getElementById("email").focus();
		return false;
	}	
	if(Validate(document.getElementById("email").value,"[A-Za-z0-9_\\.][A-Za-z]*@[A-Za-z]*\\.[A-Za-z0-9]") == false)
	{
		alert("Please enter valid Email Address.");
		document.getElementById("email").focus();
		return false;
	}
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
function contactUs($quotefrm)
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
								  <td colspan="4" align="center" class="Title">We Will Fix Your PC [Contact Us] </td>
								</tr>
								<tr>
								  <td height="30" colspan="4"></td>
								</tr>
								<tr>
								  <td width="5%"></td>
								  <td class="regular12gray" colspan="3">Dear admin, </td>
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
								  <td height="20"></td>
								  <td colspan="3" class="regular12gray">'.$quotefrm[0]['comments'].'</td>
								</tr>
								<tr>
								  <td></td>
								  <td class="regular12gray" colspan="3">&nbsp;</td>
								</tr>
								<tr>
								  <td></td>
								  <td class="regular12gray" colspan="4"><span class="Bold12Darkyellow"><b>Name:</b></span>&nbsp;&nbsp;&nbsp;'.$quotefrm[0]['name'].'</td>
								</tr>
								<tr>
								  <td></td>
								  <td class="regular12gray" colspan="4"><span class="Bold12Darkyellow"><b>Email:</b></span>&nbsp;&nbsp;&nbsp;'.$quotefrm[0]['email'].'</td>
								</tr>
								<tr>
								  <td></td>
								  <td class="regular12gray" colspan="4"><span class="Bold12Darkyellow"><b>Tel:</b></span>&nbsp;&nbsp;&nbsp;&nbsp;'.$quotefrm[0]['phone'].'</td>
								</tr>
								<tr>
							  </tr>
							 	<tr>
								  <td></td>
								  <td class="regular12gray" colspan="4">Regards</td>
							  </tr>
								<tr>
								  <td></td>
								  <td class="regular12gray" colspan="4">'.$quotefrm[0]['name'].'</td>
							  </tr>
								
							  </table></td>
						  </tr>
						</table>';	
				
	return $emailBody; }
?>