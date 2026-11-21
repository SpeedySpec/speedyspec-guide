<?php
// WordPress's PHPMailer: its error messages go through WordPress's translation functions.
$mail = new WP_PHPMailer();
return array( $mail instanceof PHPMailer\PHPMailer\PHPMailer, $mail->Mailer );
