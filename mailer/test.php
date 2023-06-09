<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$mail = new PHPMailer(true);
try {
	$mail->SMTPDebug = 3;									
	$mail->isSMTP();										
	$mail->Host	 = 'smtp.laposte.net;';				
	$mail->SMTPAuth = true;							
	$mail->Username = 'jeune-6.4';				
	$mail->Password = '20/20Minimum';					
	$mail->SMTPSecure = 'ssl';							
	$mail->Port	 = 465;

	$mail->setFrom('jeune-6.4@laposte.net', 'Jeune-6.4');		
	$mail->addAddress('zinedinebenzoua@gmail.com');
	
	$mail->isHTML(true);								
	$mail->Subject = 'lezgoçamarche';
	$mail->Body = 'Texte en <b>HTML</b> ';
	$mail->AltBody = 'Texte si html pas supporté';
	$mail->send();
	echo "Mail has been sent successfully!";
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>