<?php
include_once ("includes/includes.inc.php");
$mtp_id = 6;
include_once("includes/header.php");

if(isset($_POST) && (isset($_POST['frmappointment']) == 2))
{
	#print_arr($_POST);
	$quotefrm	= array($_POST);
	$emailObj = &new eMail();
	if(isset($_POST['app_email']) && $_POST['app_email']!="")
	{
		$whereCondition = ""; 
		$serviceExistsql = $objQryBuilder->selectQry('*','tbl_appointments',$whereCondition);
		$serviceExistresult = $objConMgr->DML_executeQry($serviceExistsql);
	
		$txtName			= prepearString(trim($_POST['app_name']));
		$txtPhone			= prepearString(trim($_POST['app_phone']));
		$txtEmail			= prepearString(trim($_POST['app_email']));
		
		$house_no			= prepearString(trim($_POST['house_no']));
		$area				= prepearString(trim($_POST['area']));
		$city				= prepearString(trim($_POST['city']));
		
		$postal_code		= prepearString(trim($_POST['postal_code']));
		$computer_type		= prepearString(trim($_POST['computer_type']));
		$problem_desc		= prepearString(trim($_POST['problem_desc']));
		$date				= prepearString(trim($_POST['date']));
		$month				= prepearString(trim($_POST['month']));
		$hours				= prepearString(trim($_POST['hours']));
		$minutes			= prepearString(trim($_POST['minutes']));
		
		$values = "$txtName, $txtPhone, $txtEmail, $house_no, $area, $city, $postal_code, $computer_type, $problem_desc, $date, $month, $hours, $minutes";
		$fieldsNames = "name, phone, email, house_no, area, city, postal_code, computer_type, problem_desc, date, month, hours, minutes";
				
		$insertQuery = $objQryBuilder->insertQry("tbl_appointments",$fieldsNames,$values);

		$insertResult = $objConMgr->DDL_executeQry($insertQuery); 
		$emailBody 	= appointmentFrm($quotefrm);
		$semail	   	= $quotefrm[0]['app_email'];
		
	}
	
	$message = $message;
		$subject="Query from Appointment page";
		$semail = 'Neil <neil@wewillfixyourpc.co.uk>';

		$bcc = 'wewillfixyourpc@gmail.com';
		$cc = 'neil@cardifftec.co.uk';		// for testing again using cc and bcc
		$values = " Name: '$txtName' <br> Phone Number: '$txtPhone' <br> Email Address: '$txtEmail' <br> House No: '$house_no' <br> Area: '$area' <br> City: '$city' <br> Postal Code: '$postal_code' <br> Computer Type: '$computer_type' <br> Problem Desc: '$problem_desc' <br> Date: '$date' <br> Month: '$month' <br> Hours: '$hours' <br> minutes: '$minutes'";
		$message = "Thank you. Your Request has been sent. We will be in touch shortly with your quote. If urgent, then please call us now on 02920 766039.";
	
		$to = "wewillfixyourpc@gmail.com";
		$body = $values;


		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
		/*
		$headers .= 'From: '.$txtName.' <'. $txtEmail.'>' . "\r\n";
		$headers .= 'Cc: '.$cc. "\r\n";       // just comment this linke if you dont want to use it 
		$headers .= 'Bcc: '.$cc . "\r\n";    // just comment this linke if you dont want to use it 
		*/

		// Mail it
		mail($to, $subject, $body, $headers);	
	
	
		//echo $message;exit;	
		$contactusMessage = "Your Comments has been sent";		
	
}
?>
<form class="formValidation" id="frmappointment" name="frmappointment" method="post" action="" onsubmit="javascript: return AppFrmValidation();">
  <input type="hidden" name="frmappointment" id="frmappointment" value="2" />

<div class="form">
  <div class="maindiv">
    <div class="fleft" style="border-right:1px dashed #484848; margin-bottom:15px;">
      <div class="fhead">
        <div class="fhead1"> Book an Appointment </div>
        <span style="color:#FF9D2E;"><?=$contactusMessage?></span>
        <div class="maindiv">
          <div class="name"> Your Name<div class="mandatory1">* </div>
          </div>
          <div class="formbg">
            <input id="app_name" name="app_name" type="text" class="forminput"/>
          </div>
        </div>
        <div class="maindiv">
          <div class="name"> Phone Number<div class="mandatory1">* </div>
          </div>
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
          <div class="name"> House Number and Street Name </div>
          <div class="formbg">
            <input id="house_no" name="house_no" type="text" class="forminput"/>
          </div>
        </div>
        <div class="maindiv">
          <div class="name" style="width:100%;"> Area<br/>
          </div>
          <div class="formbg">
            <input id="area" name="area" type="text" class="forminput" value="e.g. Whitchurch" onclick="this.value='';" />
          </div>
        </div>
        <div class="maindiv">
          <div class="name" style="width:100%;"> City </div>
          <div class="formbg">
            <input id="city" name="city" type="text" class="forminput" value="Cardiff" onclick="this.value='';"/>
          </div>
        </div>
        <div class="maindiv">
          <div class="name" style="width:100%;"> Postcode </div>
          <div class="formbg">
            <input id="postal_code" name="postal_code" type="text" class="forminput" value=""/>
          </div>
        </div>
      </div>
    </div>
    <div class="fright">
      <div class="maindiv" style="height:300px;">
        <div class="fleft" style="width:371px;">
          <div class="fhead">
            <div class="fhead2"> Your computer </div>
            <div class="maindiv">
              <div class="name"> Select the type of computer from the drop down list. </div>
              <div class="formbg2">
                <select id="computer_type" name="computer_type" tabindex="12"  class="forminput3">
                  <option value="Desktop">Desktop</option>
                  <option value="Laptop">Laptop</option>
                  <option value="Netbook">Netbook</option>
                  <option value="Others">Other</option>
                </select>
              </div>
            </div>
            <div class="maindiv">
              <div class="name" style="width:100%;"> Problem Description </div>
              <div class="formbg1">
                <textarea id="problem_desc" name="problem_desc" class="forminput6" rows="1" cols="1"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="maindiv">
        <div class="fleft" style="width:371px;">
          <div class="fhead" style="border-bottom:0px;">
            <div class="fhead3" > When is good for you </div>
            <div class="maindiv">
              <div class="tleft">
                <div class="name" style="width:100%; margin-top:0px; margin-bottom:0px;"> Which day
                  <div class="maindiv">
                    <div class="formbg4">
                      <select id="date" name="date" tabindex="12"  class="forminput4">
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                      </select>
                      <span class="left" style="margin-top:8px; margin-left:3px;">&nbsp;Date</span> </div>
                    <span class="left" style="margin-top:10px;">/</span>
                    <div class="formbg5">
                      <select name="month" id="month" tabindex="12"  class="forminput5">
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                      </select>
                      <br/>
                      <span class="left" style="margin-top:8px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Month</span> </div>
                  </div>
                </div>
              </div>
              <div class="tleft">
                <div class="name" style="width:100%; margin-top:0px; margin-bottom:0px;"> What Time
                  <div class="maindiv">
                    <div class="time">
                      <select id="hours" name="hours" tabindex="12"  class="forminputt">
                        <option value="01">1</option>
                        <option value="02">2</option>
                        <option value="03">3</option>
                        <option value="04">4</option>
                        <option value="05">5</option>
                        <option value="06">6</option>
                        <option value="07">7</option>
                        <option value="08">8</option>
                        <option value="09">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                      </select>
                      <span class="left" style="margin-top:8px;">&nbsp;&nbsp;&nbsp;&nbsp;Hour</span> </div>
                    <span class="left" style="margin-top:10px;">/</span>
                    <div class="time">
                      <select id="minutes" name="minutes" tabindex="12" class="forminputt">
                        <option value="00">00</option>
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="45">45</option>
                      </select>
                      <span class="left" style="margin-top:8px;">&nbsp;&nbsp;&nbsp;Minute</span> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="book"> <input type="image" src="images/book.jpg"  /></div>
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

      <a href="contactus.php"><img src="upload/images/rightpanel/no_appointment.gif" alt="" class="right" style="margin-top:25px;"/></a>
      <a href="contactus.php"><img src="upload/images/rightpanel/free_collection2.jpg" alt="" class="right" style="margin-top:25px;"/></a>

  <?php } } ?>
</div>
</div>
<?php
### Getting Quote for this Page
$quote = $db->select("SELECT * FROM tbl_feedback WHERE status='1' AND id='6' LIMIT 0,1");
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
	if(document.getElementById("app_name").value=="")
	{
		alert("Please enter Name.");
		document.getElementById("app_name").focus();
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
								  <td colspan="4" align="center" class="Title">We Will Fix Your PC [Appointment] </td>
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
								  <td colspan="3" class="regular12gray">'.$quotefrm[0]['problem_desc'].'</td>
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
								  <td class="regular12gray" colspan="4"><span class="Bold12Darkyellow"><b>House Number and Street Name:</b></span>&nbsp;&nbsp;&nbsp;&nbsp;'.$quotefrm[0]['house_no'].'</td>
								</tr>
                                <tr>
								  <td></td>
								  <td class="regular12gray" colspan="4"><span class="Bold12Darkyellow"><b>Area:</b></span>&nbsp;&nbsp;&nbsp;&nbsp;'.$quotefrm[0]['area'].'</td>
								</tr>
                                <tr>
								  <td></td>
								  <td class="regular12gray" colspan="4"><span class="Bold12Darkyellow"><b>City:</b></span>&nbsp;&nbsp;&nbsp;&nbsp;'.$quotefrm[0]['city'].'</td>
								</tr>
                                <tr>
								  <td></td>
								  <td class="regular12gray" colspan="4"><span class="Bold12Darkyellow"><b>Postal / Zip Code:</b></span>&nbsp;&nbsp;&nbsp;&nbsp;'.$quotefrm[0]['postal_code'].'</td>
								</tr>
                                <tr>
								  <td></td>
								  <td class="regular12gray" colspan="4"><span class="Bold12Darkyellow"><b>Computer Type:</b></span>&nbsp;&nbsp;&nbsp;&nbsp;'.$quotefrm[0]['computer_type'].'</td>
								</tr>
                                <tr>
								  <td></td>
								  <td class="regular12gray" colspan="4"><span class="Bold12Darkyellow"><b>Date:</b></span>&nbsp;&nbsp;&nbsp;&nbsp;'.$quotefrm[0]['date'].'&nbsp;-&nbsp;'.$quotefrm[0]['month'].'</td>
								</tr>                                <tr>
								  <td></td>
								  <td class="regular12gray" colspan="4"><span class="Bold12Darkyellow"><b>Time:</b></span>&nbsp;&nbsp;&nbsp;&nbsp;'.$quotefrm[0]['hours'].':'.$quotefrm[0]['minutes'].'</td>
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