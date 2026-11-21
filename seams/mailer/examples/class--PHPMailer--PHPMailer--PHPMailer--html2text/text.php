<?php
// Turns HTML into plain text for the alternative body: tags removed, entities decoded, scripts and styles dropped.
$mail = new PHPMailer\PHPMailer\PHPMailer();
return $mail->html2text( '<style>p{}</style><p>Tom &amp; <b>Jerry</b></p>' );
