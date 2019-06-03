<?php
	require 'PHPMailerAutoload.php';

    $mail = new PHPMailer;
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->SMTPAutoTLS = false;
    $mail->Username   = 'donasojib1215@gmail.com';
    $mail->Password   = 'sojib1215';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('mdmiton321@gmail.com', 'Miton');
    $mail->addAddress('mdmiton321@yahoo.com', 'MHmiton');
    $mail->addReplyTo('mdmiton321@gmail.com', 'Miton');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
?>