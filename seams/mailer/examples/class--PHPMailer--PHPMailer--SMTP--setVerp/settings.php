<?php
// Its settings have getters and setters.
$smtp = new PHPMailer\PHPMailer\SMTP();
$smtp->setVerp( true );
$smtp->setSMTPUTF8( true );
$smtp->setTimeout( 15 );
$smtp->setDebugLevel( PHPMailer\PHPMailer\SMTP::DEBUG_CONNECTION );
return array( $smtp->getVerp(), $smtp->getSMTPUTF8(), $smtp->getTimeout(), $smtp->getDebugLevel() );
