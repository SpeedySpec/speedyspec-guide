<?php
// Adds a header; a value with a line break is refused, so headers can't be injected.
$mail = new PHPMailer\PHPMailer\PHPMailer();
return array( $mail->addCustomHeader( 'X-Tag', 'one' ), $mail->addCustomHeader( 'X-Bad', "a\r\nBcc: x@example.org" ), $mail->getCustomHeaders() );
