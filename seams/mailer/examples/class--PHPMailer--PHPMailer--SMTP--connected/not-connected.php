<?php
// A new SMTP client has no connection; commands fail with an error saying so.
$smtp = new PHPMailer\PHPMailer\SMTP();
return array( $smtp->connected(), $smtp->mail( 'a@example.org' ), $smtp->getError()['error'] );
