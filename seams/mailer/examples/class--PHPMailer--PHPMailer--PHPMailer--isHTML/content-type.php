<?php
// Switches the message between text/html and text/plain.
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isHTML();
$html = $mail->ContentType;
$mail->isHTML( false );
return array( $html, $mail->ContentType );
