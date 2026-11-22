<?php
// send() fails before sending when there is no recipient; with exceptions on it throws.
$mail = new PHPMailer\PHPMailer\PHPMailer( true );
try {
	$mail->send();
} catch ( PHPMailer\PHPMailer\Exception $e ) {
	return $e->getMessage();
}
