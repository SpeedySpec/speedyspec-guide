<?php
// Accepts host names, IPv4 addresses and bracketed IPv6 addresses.
use PHPMailer\PHPMailer\PHPMailer;
return array( PHPMailer::isValidHost( 'mail.example.org' ), PHPMailer::isValidHost( '192.0.2.1' ), PHPMailer::isValidHost( '[::1]' ), PHPMailer::isValidHost( 'bad host' ) );
