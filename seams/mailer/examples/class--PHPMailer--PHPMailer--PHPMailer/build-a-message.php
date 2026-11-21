<?php
// Builds a message without sending it: preSend() assembles the headers and body that send() would hand over.
$mail = new PHPMailer\PHPMailer\PHPMailer( true );
$mail->setFrom( 'from@example.org', 'Sender' );
$mail->addAddress( 'to@example.org' );
$mail->Subject = 'Hello';
$mail->Body = 'Hi there';
$mail->preSend();
$message = $mail->getSentMIMEMessage();
return array( str_contains( $message, "To: to@example.org" ), str_contains( $message, 'Subject: Hello' ), str_contains( $message, 'From: Sender <from@example.org>' ), $mail->ContentType );
