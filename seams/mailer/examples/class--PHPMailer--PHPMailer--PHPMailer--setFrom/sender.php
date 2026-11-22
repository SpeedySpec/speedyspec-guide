<?php
// Sets From and, with $auto, the envelope sender too.
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->setFrom( 'me@example.org', 'Me' );
return array( $mail->From, $mail->FromName, $mail->Sender );
