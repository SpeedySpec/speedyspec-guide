<?php
// PHPMailer's POP3 client, for POP-before-SMTP; with nothing to connect to, it reports errors instead.
$pop = new PHPMailer\PHPMailer\POP3();
return array( $pop->login( 'user', 'pass' ), $pop->getErrors() );
