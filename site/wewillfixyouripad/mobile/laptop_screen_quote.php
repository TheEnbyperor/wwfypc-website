<?php
session_start();
include("db_connection.php");

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
	
	$txtName			= trim($_POST['app_name']);
	$txtPhone			= trim($_POST['app_phone']);
	$txtEmail			= trim($_POST['app_email']);
	$laptop_maker		= trim($_POST['computer_type']);
	$laptop_model		= trim($_POST['computer_type']);
	
			
	$values 		= "'$txtName', '$txtPhone', '$txtEmail', '$laptop_maker', '$laptop_model' ";
	$fieldsNames 	= "name, phone, email, laptop_maker, laptop_model";
			
		$insertQuery = $objQryBuilder->insertQry("tbl_laptop_appointments",$fieldsNames,$values);
		//echo $insertQuery;exit;
		$insertResult = $objConMgr->DDL_executeQry($insertQuery); 
		//echo $insertResult;exit;
		//$emailBody 	= appointmentFrm($quotefrm);
		//$semail	   	= $quotefrm[0]['app_email'];
		//echo $semail;exit;
		
	}
	
	$emailBody 	= appointmentFrm($quotefrm);
	$semail	   	= $quotefrm[0]['app_email'];
	
	$emailInfo = GetContactusEmailInfo();
	//echo $emailInfo;exit;
	$subject="Laptop Screen Quote";
		//echo "<br /><br /><br />".$emailBody ; die();
	if($semail == '')
	{
		$semail = 'neil@wewillfixyourpc.co.uk';
	}
	//$emailObj->SendEmail($semail, $emailInfo->email , $subject , $emailBody, "");
	//echo $semail;exit;
	if ($emailObj->SendEmail($semail, $emailInfo->email , $subject , $emailBody, ""))
	{
		$message = "Your Request has been sent.";
	}
	else
	{
		$semail = 'neil@wewillfixyourpc.co.uk';
		$emailObj->SendEmail($semail, $emailInfo->email , $subject , $emailBody, "");
		$message = "Your Request has been sent..";
		//$message = "Error sending please re-try.";			
	}
}
## Get Page Content ##
$rsPage = $db->select("SELECT * FROM tbl_pages WHERE pageId='100' LIMIT 1");
#print_arr ($rsPage); die();
if (!empty($rsPage)) {
	$page_content		= $rsPage[0];
} else {
    $errorMessage = "Page not exist. Please try later";
}

#####
?>

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
<meta http-equiv="cache-control" content="max-age=200" />
<link href="style.css" media="handheld, screen" rel="stylesheet" type="text/css" />
<title>Wewillfixyourpc</title>
<div class="mainwrapper" style="background:#FFFFFF;">
	
	<div id="content">
		<div class="min-width" style="background:#FFFFFF;">
		<div class="box3" style="border-top:1px solid #999; border-left: solid 1px #999999; border-right: 1px solid #999999;">
				<div class="corner-left-bottom" style="background:#FFFFFF;">
					<div class="indent" style="background:#FFFFFF; text-align:center;" >
						<img alt="" src="images/waplogo.jpg" />
					</div>
				</div>
			</div>
			
			<div class="box3" style="background:#e46c0a;">
				<div class="corner-left-bottom">
					<div id="phone-div" class="indent" >
						<a href="tel:02920758299" >02920 758299</a><br /><br />
						<a href="tel:07999056096">07999 056096 </a>
					</div>
				</div>
			</div>
			<div class="box3">
				<div class="indent" style="background:#FFFFFF;">
                    <ul class="list">
                        <li><a href="services.php">Laptop Screen Quote</a>
                          <blockquote>
                            <h5>Please use our form bellow to get a<br /> quote for your replacement screen<br /> or call us today on 02920 758299</h5>
                            
                          </blockquote>
                        </li>
                    </ul>
                </div>
			</div>
            <div class="box3">
              	<div class="corner-left-bottom">
                	<div class="indent" style="background:#FFFFFF;">
						<form name="frmLappointment" action="" method="post">
                        <input type="hidden" name="frmLappointment" value="22" />
						  <label id="lapLbl">Name</label><br />
						  <input type="text" name="app_name" id="app_name" class="ContactFormMobile"/><br />
                          <label id="lapLbl">Phone Number</label><br />
						  <input type="text" name="app_phone" id="app_phone" class="ContactFormMobile"/><br />
                          <label id="lapLbl">Email Address</label><br />
						  <input type="text" name="app_email" id="app_email" class="ContactFormMobile"/><br />
                          <label id="lapLbl">Laptop Make & Model</label><br />
						  <input type="text" name="computer_type" id="computer_type" class="ContactFormMobile"/><br />
                          <input type="image" src="images/submit_button.jpg"  />
                        </form>
					</div>
				</div>
			</div>
            <div class="box3">
				<div class="corner-left-bottom">
					<div class="indent" style="background:#FFFFFF;">
						<ul class="list">
							<li><a href="contactUs.php">Contact us</a><h5>Where are we based?</h5></li>
						</ul>
					</div>
				</div>
			</div>
            <div class="box3">
				<div class="corner-left-bottom">
					<div class="indent" style="background:#FFFFFF;">
						<ul class="list">
							<li><a href="http://www.wewillfixyourpc.co.uk/index_fullsite.php" target="_blank">Full desktop website</a><br /><h5>Go to our full website.</h5></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="box3" style="border-bottom:1px solid #999; border-left: solid 1px #999999; border-right: 1px solid #999999;">
				<div class="corner-left-bottom">
					<div class="indent" style="background:#FFFFFF;text-align:center;">
						<h5 style="font-size:12px;">&copy; 2012 wewillfixyourpc.co.uk. All Rights Reserved.</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
</body>
</html>