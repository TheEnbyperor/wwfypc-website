<?php
	
	include_once("admin/phpmailer/PHPMailerAutoload.php");
	include_once("admin/require/webconfig.inc.php");
	
class eMail
{
	function eMail()
	{
	}

	function SendEmail($from, $to, $subject, $body, $bcc, $from_name = NULL)
	{
		$mail = &new PHPMailer();
		$mail->IsSMTP(); // send via SMTP
		$mail->SMTPSecure = 'ssl';
		$mail->Host = 'wewillfixyourpc.co.uk';
		$mail->Port = 465;
		$mail->SMTPAuth = true;
		$mail->Username = "webmaster@wewillfixyourpc.co.uk";
		$mail->Password = "d3f3nd3r";   
		$mail->IsHTML(true);
		$mail->From     = $from;
		if( !empty($from_name) ){
		$mail->FromName     = $from_name;
		}
		else{
		$mail->FromName     = WEBSITE_NAME." Administrator";
		}
		
		$mail->Subject  = $subject;
		$mail->Body 	= $body;
		//$mail->AddAttachment("images/logo.jpg", "logo.jpg");
		//$mail->AddAddress($to, WEBSITE_NAME);
		$mail->AddAddress('wewillfixyourpc@gmail.com', WEBSITE_NAME);
		$mail->AddCC('neil@wewillfixyourpc.co.uk', WEBSITE_NAME);
		
		if($mail->Send())
			return true;
		else 
			return $mail->ErrorInfo;
	}

		
}

?>