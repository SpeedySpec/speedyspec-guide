<?php
// Splits an address list into addresses and names.
return PHPMailer\PHPMailer\PHPMailer::parseAddresses( 'Joe <joe@example.org>, jane@example.org' );
