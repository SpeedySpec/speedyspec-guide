<?php
// Each is* method picks the transport send() uses.
$mail = new PHPMailer\PHPMailer\PHPMailer();
$out = array( $mail->Mailer );
$mail->isSMTP();
$out[] = $mail->Mailer;
$mail->isMail();
$out[] = $mail->Mailer;
return $out;
