<?php
// Configures a PHPMailer from a DSN: here SMTP over TLS, with credentials and an option. Options from the query stay strings, except the flags it knows are boolean.
$mail = PHPMailer\PHPMailer\DSNConfigurator::mailer( 'smtps://user:secret@mail.example.org?Timeout=10' );
return array( $mail->Mailer, $mail->Host, $mail->Port, $mail->SMTPSecure, $mail->SMTPAuth, $mail->Username, $mail->Timeout );
