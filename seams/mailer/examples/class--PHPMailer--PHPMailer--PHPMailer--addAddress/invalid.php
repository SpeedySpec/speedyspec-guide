<?php
// An invalid address isn't added: addAddress() returns false and the error is in ErrorInfo.
$mail = new PHPMailer\PHPMailer\PHPMailer();
return array( $mail->addAddress( 'bad' ), $mail->addAddress( 'Ok@Example.org', 'Ok' ), $mail->getToAddresses(), $mail->ErrorInfo );
