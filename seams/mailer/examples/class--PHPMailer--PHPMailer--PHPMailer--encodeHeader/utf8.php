<?php
// Encodes a header value with non-ASCII bytes as an RFC 2047 encoded word: base64 when more than a third of its bytes need encoding, quoted-printable otherwise.
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->CharSet = PHPMailer\PHPMailer\PHPMailer::CHARSET_UTF8;
return array( $mail->encodeHeader( 'Plain' ), $mail->encodeHeader( 'Café' ), $mail->encodeHeader( 'Café au lait' ) );
