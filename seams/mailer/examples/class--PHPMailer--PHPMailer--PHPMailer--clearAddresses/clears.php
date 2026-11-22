<?php
// Each clear* method empties one list of recipients.
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->addAddress( 'a@example.org' );
$mail->addBCC( 'b@example.org' );
$mail->clearAddresses();
return array( count( $mail->getToAddresses() ), count( $mail->getBccAddresses() ) );
