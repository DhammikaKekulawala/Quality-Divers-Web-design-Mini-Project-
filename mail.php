<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once('./mail/vendor/autoload.php');

function sendMail($email, $name,$id)
{
	$mail = new PHPMailer();
	try {
		//Server settings
		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'mail.postale.io';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'slqualitydivers@gmail.com';                     //SMTP username
		$mail->Password   = '@abcd1234';                               //SMTP password
		$mail->SMTPSecure = "tls";        //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		$mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		//Recipients
		$mail->setFrom('slqualitydivers@gmail.com', 'Mailer');
		$mail->addAddress($email, $name);     //Add a recipient
		//$mail->addAddress('ellen@example.com');               //Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//Attachments
	//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
		
		$url = 'http://qd.test/update_password.php?i='.$id.'&code='.md5($email);

		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = 'Reset your password | Quality diver';
		$mail->Body    = '<p> Hello '.$name.',</p><p> Please click on below link to reset your password.</p><p><a style="color:red;" href='.$url.'>Reset Passowrd</p>';
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
		
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
}




?>