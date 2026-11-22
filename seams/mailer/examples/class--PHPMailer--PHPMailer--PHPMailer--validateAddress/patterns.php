<?php
// Checks an address with the default pattern, PHP's filter_var() check.
use PHPMailer\PHPMailer\PHPMailer;
return array( PHPMailer::validateAddress( 'user@example.org' ), PHPMailer::validateAddress( 'not an address' ), PHPMailer::validateAddress( 'user@localhost' ) );
