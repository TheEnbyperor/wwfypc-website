<?php
	
	include_once("admin/phpmailer/class.phpmailer.php");
	include_once("admin/require/webconfig.inc.php");
	
class eMail
{
	function eMail()
	{
	}

	function SendEmail($from, $to, $subject, $body, $bcc)
	{
		$mail = &new PHPMailer();
		$mail->IsSMTP(); // send via SMTP
		$mail->Host		=  SMTP_SERVER; // SMTP servers
		$mail->Mailer   = MAILER;
		$mail->IsHTML(true);
		$mail->From     = $from;
		$mail->FromName     = WEBSITE_NAME." Administrator";
		$mail->Subject  = $subject;
		$mail->Body 	= $body;
		//$mail->AddAttachment("images/logo.jpg", "logo.jpg");
		//$mail->AddAddress($to, WEBSITE_NAME);
		$mail->AddAddress($to, $to);
		
		if($mail->Send())
			return true;
		else 
			return false;
	}

		
}

?>