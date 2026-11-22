<?php
// Sets an HTML body and, from it, a plain text alternative.
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->msgHTML( '<h1>Hi</h1><p>there</p>' );
return array( $mail->ContentType, trim( $mail->AltBody ) );
